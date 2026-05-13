<?php

namespace App\Http\Controllers;

use App\Models\Tramo;
use App\Models\Cliente;
use App\Models\CuentaBancaria;

class SeguimientoCargasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $base = Tramo::with([
            'camion',
            'conductor',
            'contratoCamion.contrato',
            'contratoCamion.pagos',
            'contratoCamion.camion.propietario',
        ])->whereNull('deleted_at');

        $enRuta        = (clone $base)->where('estado', 'En ruta')->orderBy('fecha_salida')->get();
        $transbordando = (clone $base)->where('estado', 'Transbordando')->orderBy('fecha_salida')->get();
        $transbordado  = (clone $base)->where('estado', 'Transbordado')->orderByDesc('fecha_llegada')->get();
        $entregados    = (clone $base)->with('cliente')->where('estado', 'Entregado')->orderByDesc('fecha_llegada')->limit(50)->get();

        $resumen = [
            'en_ruta'       => $enRuta->count(),
            'transbordando' => $transbordando->count(),
            'transbordado'  => $transbordado->count(),
            'entregado'     => Tramo::whereNull('deleted_at')->where('estado', 'Entregado')->count(),
        ];

        $clientes = Cliente::whereNull('deleted_at')->orderBy('nombre')->get();

        $cuentasEmpresa = CuentaBancaria::with(['banco', 'titular'])
            ->whereNull('deleted_at')
            ->where('tipo_titular', 'empleado')
            ->orderBy('alias')
            ->get();

        return view('seguimiento.index', compact('enRuta', 'transbordando', 'transbordado', 'entregados', 'resumen', 'clientes', 'cuentasEmpresa'));
    }
}
