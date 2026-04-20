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
            'toneladas'      => 'required|numeric|min:0.001',
            'estado_entrega' => 'required|in:Pendiente,Entregado',
            'conductor_id'   => 'nullable|exists:operadores_transporte,id',
            'observaciones'  => 'nullable|string|max:500',
        ], [
            'camion_id.required'  => 'Debe seleccionar un camión.',
            'toneladas.required'  => 'Las toneladas son obligatorias.',
            'toneladas.min'       => 'Las toneladas deben ser mayores a 0.',
        ]);

        // Verificar que no se excedan las toneladas del contrato
        $contrato = Contrato::findOrFail($request->contrato_id);
        if ($contrato->toneladas_contrato) {
            $asignadas = $contrato->toneladas_asignadas;
            if (($asignadas + $request->toneladas) > $contrato->toneladas_contrato) {
                $disponibles = $contrato->toneladas_contrato - $asignadas;
                Alert::error('Error', "Se excede el límite del contrato. Toneladas disponibles: {$disponibles}");
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
        $item->estado_entrega = $item->estado_entrega === 'Pendiente' ? 'Entregado' : 'Pendiente';
        $item->save();
        Alert::success('Éxito', 'Estado de entrega actualizado a "' . $item->estado_entrega . '".');
        return redirect()->route('contratos.camiones', $item->contrato->uuid);
    }

    public function destroy($uuid)
    {
        $item = ContratoCamion::where('uuid', $uuid)->firstOrFail();
        $contratoUuid = $item->contrato->uuid;
        $item->delete();
        Alert::success('Éxito', 'Camión removido del contrato.');
        return redirect()->route('contratos.camiones', $contratoUuid);
    }
}
