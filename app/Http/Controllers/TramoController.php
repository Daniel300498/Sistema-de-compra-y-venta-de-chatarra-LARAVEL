<?php

namespace App\Http\Controllers;

use App\Models\Tramo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class TramoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Registrar llegada de un tramo y decidir qué pasa
    public function registrarLlegada(Request $request, $uuid)
    {
        $tramo = Tramo::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'peso_llegada'         => 'required|numeric|min:0.001|max:' . $tramo->peso_salida,
            'fecha_llegada'        => 'required|date|after_or_equal:' . $tramo->fecha_salida->format('Y-m-d'),
            'accion'               => 'required|in:entregado,frontera,transbordo',
            'cliente_id'           => 'required_if:accion,entregado|nullable|exists:clientes,id',
            'descuento_porcentaje' => 'nullable|numeric|min:0|max:60',
            'observaciones_llegada'=> 'nullable|string|max:500',
        ], [
            'peso_llegada.required'        => 'Debe ingresar el peso que llegó al destino.',
            'peso_llegada.min'             => 'El peso debe ser mayor a 0.',
            'peso_llegada.max'             => 'El peso de llegada (' . $request->peso_llegada . ' t) no puede ser mayor al peso de salida (' . $tramo->peso_salida . ' t). La carga no puede aumentar durante el transporte.',
            'fecha_llegada.required'       => 'Debe ingresar la fecha en que llegó la carga.',
            'fecha_llegada.after_or_equal' => 'La fecha de llegada no puede ser anterior a la fecha de salida (' . $tramo->fecha_salida->format('d/m/Y') . ').',
            'accion.required'              => 'Debe indicar qué ocurrió cuando llegó la carga.',
            'cliente_id.required_if'       => 'Debe seleccionar el cliente al que se entregó la carga.',
            'descuento_porcentaje.min'     => 'El descuento no puede ser negativo.',
            'descuento_porcentaje.max'     => 'El descuento no puede superar el 60%.',
        ]);

        $nuevoEstado = match($request->accion) {
            'entregado'  => 'Entregado',
            'frontera'   => 'En frontera',
            'transbordo' => 'Transbordando',
        };

        $tramo->update([
            'peso_llegada'         => $request->peso_llegada,
            'fecha_llegada'        => $request->fecha_llegada,
            'estado'               => $nuevoEstado,
            'cliente_id'           => $nuevoEstado === 'Entregado' ? $request->cliente_id : null,
            'descuento_porcentaje' => $request->descuento_porcentaje ?: null,
            'observaciones_llegada'=> $request->observaciones_llegada,
        ]);

        // Si fue entregado al cliente, actualizar el contrato_camion si todos los tramos finales están entregados
        if ($nuevoEstado === 'Entregado') {
            $cc = $tramo->contratoCamion;
            $todosEntregados = $cc->tramos()
                ->whereDoesntHave('tramosHijos')
                ->where('estado', '!=', 'Entregado')
                ->doesntExist();

            if ($todosEntregados) {
                $cc->update(['estado_entrega' => 'Entregado']);
            }

            Alert::success('Entregado', 'Carga entregada al cliente. Peso final: ' . $request->peso_llegada . ' t');
        } elseif ($nuevoEstado === 'En frontera') {
            Alert::success('En frontera', 'Llegada registrada. Ahora puedes agregar los camiones de transbordo.');
        } elseif ($nuevoEstado === 'Transbordando') {
            Alert::success('Transbordando', 'Llegada registrada. Agrega los camiones de transbordo.');
        }

        return redirect()->route('contratos.camiones', $tramo->contratoCamion->contrato->uuid);
    }

    // Crear tramo hijo (transbordo desde un tramo en frontera)
    public function store(Request $request)
    {
        $tramoPadre = Tramo::findOrFail($request->tramo_padre_id);

        $request->validate([
            'contrato_camion_id' => 'required|exists:contrato_camiones,id',
            'tramo_padre_id'     => 'required|exists:tramos,id',
            'camion_id'          => 'required|exists:camiones,id',
            'conductor_id'       => 'required|exists:operadores_transporte,id',
            'destino'            => 'required|string|max:150',
            'tipo_tramo'         => 'required|in:Internacional,Nacional',
            'peso_salida'        => 'required|numeric|min:0.001',
            'fecha_salida'       => 'required|date|after_or_equal:' . $tramoPadre->fecha_llegada->format('Y-m-d'),
            'observaciones'      => 'nullable|string|max:500',
        ], [
            'tramo_padre_id.required' => 'El tramo padre es obligatorio para un transbordo.',
            'camion_id.required'      => 'Debe seleccionar un camión.',
            'conductor_id.required'   => 'Debe seleccionar un conductor.',
            'destino.required'        => 'El destino es obligatorio.',
            'peso_salida.required'    => 'El peso de salida es obligatorio.',
            'fecha_salida.required'        => 'La fecha de salida es obligatoria.',
            'fecha_salida.after_or_equal'  => 'La fecha de salida del transbordo no puede ser anterior a la fecha en que llegó el camión anterior (' . $tramoPadre->fecha_llegada->format('d/m/Y') . ').',
        ]);

        if (!in_array($tramoPadre->estado, ['En frontera', 'Transbordando'])) {
            Alert::error('No permitido', 'Solo se puede agregar transbordo a un tramo que está en frontera o transbordando.');
            return redirect()->route('contratos.camiones', $tramoPadre->contratoCamion->contrato->uuid);
        }

        // Verificar que el total de transbordos activos no supere el peso que llegó al padre
        $yaAsignado   = (float) $tramoPadre->tramosHijos()->where('activo', true)->sum('peso_salida');
        $disponible   = (float) $tramoPadre->peso_llegada - $yaAsignado;
        $pesoSolicitado = (float) $request->peso_salida;

        if ($pesoSolicitado > $disponible) {
            Alert::error(
                'Peso excedido',
                "Solo quedan {$disponible} t disponibles para transbordo (llegaron {$tramoPadre->peso_llegada} t, ya asignadas {$yaAsignado} t). No puedes asignar {$pesoSolicitado} t a este camión."
            );
            return redirect()->route('contratos.camiones', $tramoPadre->contratoCamion->contrato->uuid);
        }

        Tramo::create([
            'contrato_camion_id' => $request->contrato_camion_id,
            'tramo_padre_id'     => $request->tramo_padre_id,
            'camion_id'          => $request->camion_id,
            'conductor_id'       => $request->conductor_id,
            'origen'             => $tramoPadre->destino,
            'destino'            => $request->destino,
            'tipo_tramo'         => $request->tipo_tramo,
            'peso_salida'        => $request->peso_salida,
            'fecha_salida'       => $request->fecha_salida,
            'estado'             => 'En tránsito',
            'observaciones'      => $request->observaciones,
            'created_by'         => auth()->id(),
            'updated_by'         => auth()->id(),
        ]);

        // Recalcular estado del padre y ancestros
        $this->recalcularEstadoPadre($tramoPadre->id);

        Alert::success('Éxito', 'Tramo de transbordo registrado.');
        return redirect()->route('contratos.camiones', $tramoPadre->contratoCamion->contrato->uuid);
    }

    public function notaEntrega($uuid)
    {
        $tramo = Tramo::with(['camion', 'conductor', 'contratoCamion.contrato.cliente'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        abort_if(!in_array($tramo->estado, ['Entregado', 'Transbordado']), 403, 'El tramo aún no ha sido completado.');

        $pdf = Pdf::loadView('contratos.partials.nota-entrega-pdf', compact('tramo'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('nota-entrega-' . $tramo->camion->placa . '-' . $tramo->fecha_llegada->format('Y-m-d') . '.pdf');
    }

    public function toggleActivo($uuid)
    {
        $tramo        = Tramo::where('uuid', $uuid)->firstOrFail();
        $contratoUuid = $tramo->contratoCamion->contrato->uuid;

        $tramo->update(['activo' => !$tramo->activo, 'updated_by' => auth()->id()]);

        // Recalcular estado hacia arriba en toda la cadena
        $this->recalcularEstadoPadre($tramo->tramo_padre_id);

        $msg = $tramo->activo ? 'Tramo desactivado. El registro se conserva en el historial.' : 'Tramo reactivado.';
        Alert::success('Listo', $msg);
        return redirect()->route('contratos.camiones', $contratoUuid);
    }

    // Recalcula recursivamente el estado de un tramo y sus ancestros
    private function recalcularEstadoPadre(?int $tramoPadreId): void
    {
        if (!$tramoPadreId) return;

        $padre = Tramo::find($tramoPadreId);
        if (!$padre) return;

        $hijosActivos = $padre->tramosHijos()->where('activo', true)->count();

        if ($hijosActivos === 0) {
            $padre->update(['estado' => 'En frontera']);
        } else {
            $disponible = round((float) $padre->peso_llegada - (float) $padre->tramosHijos()->where('activo', true)->sum('peso_salida'), 3);
            $padre->update(['estado' => $disponible <= 0 ? 'Transbordado' : 'Transbordando']);
        }

        // Subir al siguiente nivel
        $this->recalcularEstadoPadre($padre->tramo_padre_id);
    }
}
