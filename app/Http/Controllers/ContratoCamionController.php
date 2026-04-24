<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\ContratoCamion;
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
            'contrato_id'    => 'required|exists:contratos,id',
            'camion_id'      => 'required|exists:camiones,id',
            'toneladas'        => 'required|numeric|min:0.001',
            'fecha_asignacion' => 'required|date',
            'estado_entrega'   => 'required|in:Pendiente,Entregado',
            'conductor_id'   => 'required|exists:operadores_transporte,id',
            'observaciones'  => 'nullable|string|max:500',
        ], [
            'camion_id.required'        => 'Debe seleccionar un camión.',
            'toneladas.required'        => 'Las toneladas son obligatorias.',
            'toneladas.min'             => 'Las toneladas deben ser mayores a 0.',
            'fecha_asignacion.required' => 'La fecha de asignación es obligatoria.',
            'fecha_asignacion.date'     => 'La fecha de asignación no es válida.',
            'conductor_id.required'     => 'Debe seleccionar un conductor para este camión.',
        ]);

        $contrato = Contrato::findOrFail($request->contrato_id);
        $camion   = \App\Models\Camion::findOrFail($request->camion_id);

        // Validar contra capacidad del camión (capacidad_kg → toneladas)
        $capacidadTon = $camion->capacidad_kg / 1000;
        if ($request->toneladas > $capacidadTon) {
            Alert::error('Error', "Las toneladas asignadas ({$request->toneladas} t) superan la capacidad del camión ({$capacidadTon} t).");
            return redirect()->route('contratos.camiones', $contrato->uuid);
        }

        // Verificar que no se excedan las toneladas del contrato
        if ($contrato->toneladas_contrato) {
            $asignadas = $contrato->toneladas_asignadas;
            if (($asignadas + $request->toneladas) > $contrato->toneladas_contrato) {
                $disponibles = $contrato->toneladas_contrato - $asignadas;
                Alert::error('Error', "Se excede el límite del contrato. Toneladas disponibles: {$disponibles} t.");
                return redirect()->route('contratos.camiones', $contrato->uuid);
            }
        }

        ContratoCamion::create($request->all());
        Alert::success('Éxito', 'Camión agregado al contrato.');
        return redirect()->route('contratos.camiones', $contrato->uuid);
    }

    public function toggleEntrega($uuid)
    {
        $item = ContratoCamion::where('uuid', $uuid)->firstOrFail();

        if ($item->estado_entrega === 'Entregado') {
            Alert::error('No permitido', 'Una entrega confirmada no puede revertirse.');
            return redirect()->route('contratos.camiones', $item->contrato->uuid);
        }

        $item->estado_entrega = 'Entregado';
        $item->save();
        Alert::success('Entrega confirmada', 'El camión ' . $item->camion->placa . ' fue marcado como entregado.');
        return redirect()->route('contratos.camiones', $item->contrato->uuid);
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
