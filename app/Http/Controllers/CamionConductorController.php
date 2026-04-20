<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Models\CamionConductor;
use App\Models\OperadorTransporte;
use App\Http\Requests\CamionConductorRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CamionConductorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CamionConductorRequest $request)
    {
        CamionConductor::create($request->all());
        Alert::success('Asignación', 'Conductor asignado al camión con éxito.');
        return redirect()->route('camiones.index', ['tab' => 'conductores']);
    }

    public function finalizarAsignacion($uuid)
    {
        $asignacion = CamionConductor::where('uuid', $uuid)->firstOrFail();
        $asignacion->update(['fecha_fin' => now()->toDateString()]);
        Alert::success('Finalización', 'Asignación finalizada con éxito.');
        return redirect()->route('camiones.index', ['tab' => 'conductores']);
    }

    // Endpoint: camiones con propietario y conductor actual
    public function camionesConDetalle()
    {
        $camiones = Camion::with([
            'propietario',
            'conductorActual.conductor',
        ])->whereNull('deleted_at')->get()->map(function ($camion) {
            return [
                'uuid'             => $camion->uuid,
                'placa'            => $camion->placa,
                'tipo_vehiculo'    => $camion->tipo_vehiculo,
                'marca'            => $camion->marca,
                'modelo'           => $camion->modelo,
                'anio'             => $camion->anio,
                'capacidad_kg'     => $camion->capacidad_kg,
                'estado'           => $camion->estado,
                'propietario'      => $camion->propietario
                    ? $camion->propietario->nombre_completo
                    : null,
                'conductor_actual' => $camion->conductorActual
                    ? $camion->conductorActual->conductor->nombre_completo
                    : null,
            ];
        });

        return response()->json($camiones);
    }

    // Endpoint: historial de conductores por camión
    public function historialConductores($uuid)
    {
        $camion = Camion::where('uuid', $uuid)->firstOrFail();

        $historial = $camion->conductores()
            ->with('conductor')
            ->orderByDesc('fecha_inicio')
            ->get()
            ->map(function ($asig) {
                return [
                    'uuid'          => $asig->uuid,
                    'conductor'     => $asig->conductor->nombre_completo,
                    'licencia'      => $asig->conductor->licencia_numero,
                    'fecha_inicio'  => $asig->fecha_inicio?->format('d/m/Y'),
                    'fecha_fin'     => $asig->fecha_fin?->format('d/m/Y') ?? 'Activo',
                    'observaciones' => $asig->observaciones,
                ];
            });

        return response()->json([
            'camion'   => $camion->placa . ' - ' . $camion->marca . ' ' . $camion->modelo,
            'historial' => $historial,
        ]);
    }
}
