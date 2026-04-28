<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\ContratoCamion;
use App\Models\Tramo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContratoCamionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contrato_id'      => 'required|exists:contratos,id',
            'camion_id'        => 'required|exists:camiones,id',
            'conductor_id'     => 'required|exists:operadores_transporte,id',
            'fecha_asignacion' => 'required|date',
            'tipo_tramo'       => 'required|in:Internacional,Nacional',
            'origen'           => 'required|string|max:150',
            'destino'          => 'required|string|max:150',
            'peso_declarado'   => 'required|numeric|min:0.001',
            'observaciones'    => 'nullable|string|max:500',
        ], [
            'camion_id.required'        => 'Debe seleccionar un camión.',
            'conductor_id.required'     => 'Debe seleccionar un conductor.',
            'fecha_asignacion.required' => 'La fecha de salida es obligatoria.',
            'tipo_tramo.required'     => 'El tipo de tramo es obligatorio.',
            'origen.required'         => 'El origen es obligatorio.',
            'destino.required'        => 'El destino es obligatorio.',
            'peso_declarado.required' => 'El peso declarado por el proveedor es obligatorio.',
        ]);

        $contrato = Contrato::findOrFail($request->contrato_id);

        $cc = ContratoCamion::create([
            'contrato_id'      => $request->contrato_id,
            'camion_id'        => $request->camion_id,
            'conductor_id'     => $request->conductor_id,
            'toneladas'        => $request->peso_declarado,
            'fecha_asignacion' => $request->fecha_asignacion,
            'estado_entrega'   => 'Pendiente',
            'observaciones'    => $request->observaciones,
            'created_by'       => auth()->id(),
            'updated_by'       => auth()->id(),
        ]);

        // Crear el tramo raíz automáticamente
        Tramo::create([
            'contrato_camion_id' => $cc->id,
            'tramo_padre_id'     => null,
            'camion_id'          => $request->camion_id,
            'conductor_id'       => $request->conductor_id,
            'origen'             => $request->origen,
            'destino'            => $request->destino,
            'tipo_tramo'         => $request->tipo_tramo,
            'peso_declarado'     => $request->peso_declarado,
            'peso_salida'        => $request->peso_declarado,
            'fecha_salida'       => $request->fecha_asignacion,
            'estado'             => 'En tránsito',
            'observaciones'      => $request->observaciones,
            'created_by'         => auth()->id(),
            'updated_by'         => auth()->id(),
        ]);

        Alert::success('Éxito', 'Camión asignado al contrato con tramo inicial registrado.');
        return redirect()->route('contratos.camiones', $contrato->uuid);
    }

    public function destroy($uuid)
    {
        $item = ContratoCamion::where('uuid', $uuid)->firstOrFail();
        $contratoUuid = $item->contrato->uuid;

        if ($item->estado_entrega === 'Entregado') {
            Alert::error('No permitido', 'No se puede eliminar un camión cuya entrega ya fue confirmada.');
            return redirect()->route('contratos.camiones', $contratoUuid);
        }

        $item->delete();
        Alert::success('Éxito', 'Camión removido del contrato.');
        return redirect()->route('contratos.camiones', $contratoUuid);
    }
}
