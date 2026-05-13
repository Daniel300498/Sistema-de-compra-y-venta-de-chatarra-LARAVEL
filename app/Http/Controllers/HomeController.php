<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Proveedor;
use App\Models\GastoExtra;
use App\Models\CuentaBancaria;
use App\Models\PagoProveedor;
use App\Models\PagoCamion;
use App\Models\PagoCliente;
use App\Models\Tramo;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $finMes = Carbon::now()->endOfMonth();
        $contratosActivos = Contrato::whereNull('deleted_at')->count();
        $proveedoresRegistrados = Proveedor::whereNull('deleted_at')->count();
        $cuentasActivas = CuentaBancaria::whereNull('deleted_at')->count();
        $gastosExtrasPagadosMes = GastoExtra::whereNull('deleted_at')->where('estado', 'pagado')->whereBetween('fecha', [$inicioMes, $finMes])->sum('monto_bolivianos');
        $gastosExtrasPendientesMes = GastoExtra::whereNull('deleted_at')->where('estado', 'pendiente')->whereBetween('fecha', [$inicioMes, $finMes])->sum('monto_bolivianos');
        $gastosPendientesTotal = GastoExtra::whereNull('deleted_at')->where('estado', 'pendiente')->sum('monto_bolivianos');
        $pagosPendientesCantidad = GastoExtra::whereNull('deleted_at')->where('estado', 'pendiente')->count();
        $pagosProveedorPagadosMes = PagoProveedor::whereNull('deleted_at')->whereBetween('fecha_pago', [$inicioMes, $finMes])->get()->sum(function ($pago) {return $pago->moneda === 'BOB' ? $pago->monto : $pago->monto * $pago->tipo_cambio;});
        $pagosProveedorPendientesMes = PagoProveedor::whereNull('deleted_at')->whereBetween('fecha_pago', [$inicioMes, $finMes])->get()->sum(function ($pago) {return $pago->moneda === 'BOB' ? $pago->monto : $pago->monto * $pago->tipo_cambio;});
        $cobrosClientesPagadosMes = PagoCliente::whereNull('deleted_at')->whereBetween('fecha_pago', [$inicioMes, $finMes])->sum('monto');
        $cobrosClientesPendientesMes = PagoCliente::whereNull('deleted_at')->whereBetween('fecha_pago', [$inicioMes, $finMes])->sum('monto');
        $pagosCamionesPagadosMes = PagoCamion::whereNull('deleted_at')->whereBetween('fecha_pago', [$inicioMes, $finMes])->sum('monto');
        $pagosCamionesPendientesMes = PagoCamion::whereNull('deleted_at')->whereBetween('fecha_pago', [$inicioMes, $finMes])->sum('monto');
        $camionesPorEstado = Tramo::whereNull('deleted_at')->selectRaw('estado, COUNT(*) as total')->groupBy('estado')->pluck('total', 'estado');
        $camionesTransbordado = $camionesPorEstado['TRANSBORDADO'] ?? 0;
        $camionesEnRuta = $camionesPorEstado['EN RUTA'] ?? 0;
        $camionesDescargado = $camionesPorEstado['DESCARGADO'] ?? 0;
        $camionesPendiente = $camionesPorEstado['PENDIENTE'] ?? 0;
        $contratosRecientes = Contrato::with('proveedor')->whereNull('deleted_at')->latest()->take(5)->get();
        $pagosPendientes = GastoExtra::with('contrato.proveedor')->whereNull('deleted_at')->where('estado', 'pendiente')->orderBy('fecha', 'asc')->take(5)->get();
        $gastosPorCategoria = GastoExtra::whereNull('deleted_at')->where('estado', 'pagado')->selectRaw('categoria, SUM(monto_bolivianos) as total')->groupBy('categoria')->orderByDesc('total')->take(5)->get();
        $ultimosPagos = GastoExtra::with('contrato.proveedor')->whereNull('deleted_at')->where('estado', 'pagado')->latest()->take(5)->get();

        return view('home', compact('contratosActivos','proveedoresRegistrados','cuentasActivas','gastosExtrasPagadosMes','gastosExtrasPendientesMes','gastosPendientesTotal','pagosPendientesCantidad','pagosProveedorPagadosMes','pagosProveedorPendientesMes','cobrosClientesPagadosMes','cobrosClientesPendientesMes','pagosCamionesPagadosMes','pagosCamionesPendientesMes','camionesTransbordado','camionesEnRuta','camionesDescargado','camionesPendiente','contratosRecientes','pagosPendientes','gastosPorCategoria','ultimosPagos'
        ));
    }
}