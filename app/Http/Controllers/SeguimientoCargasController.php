<?php

namespace App\Http\Controllers;

use App\Models\Tramo;

class SeguimientoCargasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $activos = Tramo::with([
                'camion',
                'conductor',
                'contratoCamion.contrato',
                'tramoPadre',
            ])
            ->whereIn('estado', ['En tránsito', 'En frontera', 'Transbordando', 'Transbordado'])
            ->whereNull('deleted_at')
            ->orderBy('estado')
            ->orderBy('fecha_salida')
            ->get();

        $entregados = Tramo::with([
                'camion',
                'conductor',
                'contratoCamion.contrato',
                'cliente',
            ])
            ->where('estado', 'Entregado')
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_llegada')
            ->limit(50)
            ->get();

        $resumen = [
            'en_transito'   => Tramo::whereNull('deleted_at')->where('estado', 'En tránsito')->count(),
            'en_frontera'   => Tramo::whereNull('deleted_at')->where('estado', 'En frontera')->count(),
            'transbordando' => Tramo::whereNull('deleted_at')->where('estado', 'Transbordando')->count(),
            'transbordado'  => Tramo::whereNull('deleted_at')->where('estado', 'Transbordado')->count(),
            'entregado'     => Tramo::whereNull('deleted_at')->where('estado', 'Entregado')->count(),
        ];

        return view('seguimiento.index', compact('activos', 'entregados', 'resumen'));
    }
}
