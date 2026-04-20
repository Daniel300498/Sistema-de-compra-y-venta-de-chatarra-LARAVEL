<?php

namespace App\Http\Controllers;

use App\Models\OperadorTransporte;
use App\Http\Requests\OperadorTransporteRequest;
use RealRashid\SweetAlert\Facades\Alert;

class OperadorTransporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $operadores = OperadorTransporte::whereNull('deleted_at')->get();
        return view('camiones.index', compact('operadores'));
    }

    public function store(OperadorTransporteRequest $request)
    {
        OperadorTransporte::create($request->all());
        Alert::success('Registro', 'Operador registrado con éxito.');
        return redirect()->route('camiones.index', ['tab' => 'operadores']);
    }

    public function edit($uuid)
    {
        $operador = OperadorTransporte::where('uuid', $uuid)->firstOrFail();
        return response()->json($operador);
    }

    public function update(OperadorTransporteRequest $request, OperadorTransporte $operador)
    {
        $operador->update($request->all());
        Alert::success('Actualización', 'Operador actualizado con éxito.');
        return redirect()->route('camiones.index', ['tab' => 'operadores']);
    }

    public function destroy($uuid)
    {
        $operador = OperadorTransporte::where('uuid', $uuid)->firstOrFail();
        $operador->delete();
        Alert::success('Eliminación', 'Operador eliminado con éxito.');
        return redirect()->route('camiones.index', ['tab' => 'operadores']);
    }
}
