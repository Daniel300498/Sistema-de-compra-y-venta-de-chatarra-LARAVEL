<?php

namespace App\Http\Controllers;

use App\Models\Tramo;
use App\Models\ContratoCamion;
use Illuminate\Http\Request;
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
            'peso_llegada'  => 'required|numeric|min:0.001|max:' . $tramo->peso_salida,
            'fecha_llegada' => 'required|date|after_or_equal:' . $tramo->fecha_salida->format('Y-m-d'),
            'accion'        => 'required|in:entregado,frontera,transbordo',
        ], [
            'peso_llegada.required'      => 'Debe ingresar el peso que llegó al destino.',
            'peso_llegada.min'           => 'El peso debe ser mayor a 0.',
            'peso_llegada.max'           => 'El peso de llegada (' . $request->peso_llegada . ' t) no puede ser mayor al peso de salida (' . $tramo->peso_salida . ' t). La carga no puede aumentar durante el transporte.',
            'fecha_llegada.required'     => 'Debe ingresar la fecha en que llegó la carga.',
            'fecha_llegada.after_or_equal' => 'La fecha de llegada no puede ser anterior a la fecha de salida (' . $tramo->fecha_salida->format('d/m/Y') . ').',
            'accion.required'            => 'Debe indicar qué ocurrió cuando llegó la carga.',
        ]);

        $nuevoEstado = match($request->accion) {
            'entregado'  => 'Entregado',
            'frontera'   => 'En frontera',
            'transbordo' => 'En frontera',
        };

        $tramo->update([
            'peso_llegada'  => $request->peso_llegada,
            'fecha_llegada' => $request->fecha_llegada,
            'estado'        => $nuevoEstado,
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

        if ($tramoPadre->estado !== 'En frontera') {
            Alert::error('No permitido', 'Solo se puede agregar transbordo a un tramo que está en frontera.');
            return redirect()->route('contratos.camiones', $tramoPadre->contratoCamion->contrato->uuid);
        }

        // Verificar que el total de transbordos no supere el peso que llegó al padre
        $yaAsignado   = (float) $tramoPadre->tramosHijos()->sum('peso_salida');
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

        // Si ya no quedan toneladas disponibles, marcar padre como Transbordado
        $yaAsignadoTotal = (float) $tramoPadre->tramosHijos()->sum('peso_salida');
        $disponibleFinal = round((float) $tramoPadre->peso_llegada - $yaAsignadoTotal, 3);

        if ($disponibleFinal <= 0) {
            $tramoPadre->update(['estado' => 'Transbordado']);
        }

        Alert::success('Éxito', 'Tramo de transbordo registrado.');
        return redirect()->route('contratos.camiones', $tramoPadre->contratoCamion->contrato->uuid);
    }

    public function destroy($uuid)
    {
        $tramo = Tramo::where('uuid', $uuid)->firstOrFail();

        if (in_array($tramo->estado, ['Entregado', 'Transbordado'])) {
            Alert::error('No permitido', 'No se puede eliminar un tramo que ya fue entregado o transbordado.');
            return redirect()->route('contratos.camiones', $tramo->contratoCamion->contrato->uuid);
        }

        $contratoUuid = $tramo->contratoCamion->contrato->uuid;
        $tramo->delete();

        Alert::success('Éxito', 'Tramo eliminado.');
        return redirect()->route('contratos.camiones', $contratoUuid);
    }
}
