<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Models\CamionConductor;
use App\Models\OperadorTransporte;
use App\Http\Requests\CamionRequest;
use RealRashid\SweetAlert\Facades\Alert;

class CamionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $camiones   = Camion::with(['propietario', 'conductorActual.conductor'])
                            ->whereNull('deleted_at')->get();
        $operadores = OperadorTransporte::whereNull('deleted_at')->orderBy('nombre')->get();
        $choferes   = OperadorTransporte::whereNull('deleted_at')
                            ->whereIn('tipo_operador', ['chofer', 'ambos'])
                            ->whereNotNull('licencia_numero')
                            ->orderBy('nombre')->get();
        $asignaciones = CamionConductor::with(['camion', 'conductor'])
                            ->orderByDesc('fecha_inicio')->get();

        return view('camiones.index', compact('camiones', 'operadores', 'choferes', 'asignaciones'));
    }

    public function store(CamionRequest $request)
    {
        Camion::create($request->all());
        Alert::success('Registro', 'Camión registrado con éxito.');
        return redirect()->route('camiones.index');
    }

    public function edit($uuid)
    {
        $camion = Camion::where('uuid', $uuid)->firstOrFail();
        return response()->json($camion);
    }

    public function update(CamionRequest $request, Camion $camion)
    {
        $camion->update($request->all());
        Alert::success('Actualización', 'Datos del camión actualizados con éxito.');
        return redirect()->route('camiones.index');
    }

    public function destroy($uuid)
    {
        $camion = Camion::where('uuid', $uuid)->firstOrFail();
        $camion->delete();
        Alert::success('Eliminación', 'Camión eliminado con éxito.');
        return redirect()->route('camiones.index');
    }
}
