<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Cliente;
use App\Models\Proveedor;
use App\Http\Requests\ContratoRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ContratoController extends Controller
{
    // Países cercanos a Bolivia para filtrar proveedores internacionales
    const PAISES_CERCANOS = [
        'BOLIVIA', 'ARGENTINA', 'BRASIL', 'CHILE', 'PERU',
        'PARAGUAY', 'URUGUAY', 'COLOMBIA', 'ECUADOR', 'VENEZUELA',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contratos  = Contrato::with(['cliente', 'proveedor'])
                        ->whereNull('deleted_at')
                        ->orderByDesc('created_at')
                        ->get();

        $clientes   = Cliente::whereNull('deleted_at')->orderBy('nombre')->get();

        $proveedores = Proveedor::whereNull('deleted_at')
                        ->whereIn(\DB::raw('UPPER(pais)'), self::PAISES_CERCANOS)
                        ->orderBy('nombre')
                        ->get();

        $numeroSiguiente = Contrato::generarNumero();

        return view('contratos.index', compact('contratos', 'clientes', 'proveedores', 'numeroSiguiente'));
    }

    public function store(ContratoRequest $request)
    {
        Contrato::create($request->all());
        Alert::success('Registro', 'Contrato registrado con éxito.');
        return redirect()->route('contratos.index');
    }

    public function edit($uuid)
    {
        $contrato = Contrato::with(['cliente', 'proveedor'])
                        ->where('uuid', $uuid)->firstOrFail();
        return response()->json($contrato);
    }

    public function update(ContratoRequest $request, Contrato $contrato)
    {
        $contrato->update($request->all());
        Alert::success('Actualización', 'Contrato actualizado con éxito.');
        return redirect()->route('contratos.index');
    }

    public function destroy($uuid)
    {
        $contrato = Contrato::where('uuid', $uuid)->firstOrFail();
        $contrato->delete();
        Alert::success('Eliminación', 'Contrato eliminado con éxito.');
        return redirect()->route('contratos.index');
    }
}
