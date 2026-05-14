<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\PagoProveedor;
use App\Models\CuentaBancaria;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PagoProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contratos = Contrato::with(['proveedor', 'pagosProveedor', 'contratoCamiones.tramos'])
            ->whereNotNull('proveedor_id')
            ->whereNotNull('monto_total')
            ->orderByDesc('created_at')
            ->get();

        $proveedores = Proveedor::whereNull('deleted_at')->orderBy('nombre')->get();

        $cuentasEmpresa = CuentaBancaria::with(['banco', 'titular'])
            ->whereNull('deleted_at')
            ->where('tipo_titular', 'empleado')
            ->orderBy('alias')
            ->get();

        return view('pagos.proveedores.index', compact('contratos', 'proveedores', 'cuentasEmpresa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contrato_id'        => 'required|exists:contratos,id',
            'tipo_pago'          => 'required|in:adelanto,parcial,pago_final',
            'monto'              => 'required|numeric|min:0.01',
            'moneda_pago'        => 'required|in:BOB,USD,EUR,BRL,ARS,PEN,CLP,PYG,COP',
            'tipo_cambio'        => 'required|numeric|min:0.0001',
            'fecha_pago'         => 'required|date',
            'metodo_pago'        => 'required|in:efectivo,transferencia,qr,cheque',
            'codigo_seguimiento' => 'nullable|string|max:100',
            'cuenta_origen_id'   => 'nullable|exists:cuentas_bancarias,id',
            'cuenta_destino_id'  => 'nullable|exists:cuentas_bancarias,id',
            'observaciones'      => 'nullable|string|max:500',
        ], [
            'contrato_id.required' => 'Debe seleccionar el contrato.',
            'tipo_pago.required'   => 'Debe indicar el tipo de pago.',
            'monto.required'       => 'El monto es obligatorio.',
            'monto.min'            => 'El monto debe ser mayor a cero.',
            'moneda_pago.required' => 'Debe indicar la moneda del pago.',
            'tipo_cambio.required' => 'Debe indicar el tipo de cambio.',
            'tipo_cambio.min'      => 'El tipo de cambio debe ser mayor a cero.',
            'fecha_pago.required'  => 'La fecha de pago es obligatoria.',
            'metodo_pago.required' => 'Debe indicar el método de pago.',
        ]);

        PagoProveedor::create([
            'contrato_id'        => $request->contrato_id,
            'tipo_pago'          => $request->tipo_pago,
            'monto'              => $request->monto,
            'moneda_pago'        => $request->moneda_pago,
            'tipo_cambio'        => $request->tipo_cambio,
            'fecha_pago'         => $request->fecha_pago,
            'metodo_pago'        => $request->metodo_pago,
            'codigo_seguimiento' => $request->codigo_seguimiento ?: null,
            'cuenta_origen_id'   => $request->cuenta_origen_id ?: null,
            'cuenta_destino_id'  => $request->cuenta_destino_id ?: null,
            'observaciones'      => $request->observaciones ?: null,
            'created_by'         => auth()->id(),
            'updated_by'         => auth()->id(),
        ]);

        Alert::success('Éxito', 'Pago al proveedor registrado correctamente.');
        return redirect()->route('pagos.proveedores.index');
    }

    public function update(Request $request, $uuid)
    {
        $pago = PagoProveedor::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'tipo_pago'          => 'required|in:adelanto,pago_final',
            'monto'              => 'required|numeric|min:0.01',
            'moneda_pago'        => 'required|in:BOB,USD,EUR,BRL,ARS,PEN,CLP,PYG,COP',
            'tipo_cambio'        => 'required|numeric|min:0.0001',
            'fecha_pago'         => 'required|date',
            'metodo_pago'        => 'required|in:transferencia,qr,cheque',
            'codigo_seguimiento' => 'nullable|string|max:100',
        ]);

        $pago->update([
            'tipo_pago'          => $request->tipo_pago,
            'monto'              => $request->monto,
            'moneda_pago'        => $request->moneda_pago,
            'tipo_cambio'        => $request->tipo_cambio,
            'fecha_pago'         => $request->fecha_pago,
            'metodo_pago'        => $request->metodo_pago,
            'codigo_seguimiento' => $request->codigo_seguimiento ?: null,
            'updated_by'         => auth()->id(),
        ]);

        Alert::success('Éxito', 'Pago actualizado correctamente.');
        return redirect()->route('pagos.proveedores.index');
    }

    public function destroy($uuid)
    {
        $pago = PagoProveedor::where('uuid', $uuid)->firstOrFail();
        $pago->delete();
        Alert::success('Éxito', 'Pago eliminado.');
        return redirect()->route('pagos.proveedores.index');
    }

    // API: detalle financiero de un contrato para el modal
    public function detalle($id)
    {
        $contrato = Contrato::with([
            'proveedor',
            'pagosProveedor.cuentaDestino.banco',
            'pagosProveedor.cuentaOrigen.titular',
        ])->findOrFail($id);

        return response()->json([
            'id'              => $contrato->id,
            'numero'          => $contrato->numero_contrato,
            'proveedor'       => $contrato->proveedor->nombre ?? '—',
            'monto_total'     => $contrato->monto_total,
            'moneda'          => $contrato->moneda ?? 'BOB',
            'total_pagado'    => $contrato->total_pagado_proveedor,
            'saldo_pendiente' => $contrato->saldo_pendiente_proveedor,
            'pagos'           => $contrato->pagosProveedor->map(fn($p) => [
                'uuid'           => $p->uuid,
                'tipo'           => $p->tipo_pago_label,
                'monto'          => $p->monto,
                'moneda_pago'    => $p->moneda_pago,
                'tipo_cambio'    => $p->tipo_cambio,
                'fecha'          => $p->fecha_pago->format('d/m/Y'),
                'fecha_raw'      => $p->fecha_pago->format('Y-m-d'),
                'metodo'         => ucfirst($p->metodo_pago),
                'metodo_raw'     => $p->metodo_pago,
                'tipo_raw'       => $p->tipo_pago,
                'monto_bob'      => $p->monto_en_moneda_contrato,
                'codigo'         => $p->codigo_seguimiento,
                'cuenta_destino' => $p->cuentaDestino ? [
                    'banco'          => $p->cuentaDestino->banco->nombre ?? '—',
                    'numero'         => $p->cuentaDestino->numero_cuenta,
                    'moneda'         => $p->cuentaDestino->moneda,
                    'alias'          => $p->cuentaDestino->alias,
                    'titular_cuenta' => $p->cuentaDestino->nombre_titular_cuenta,
                    'tipo_relacion'  => $p->cuentaDestino->tipo_relacion,
                ] : null,
                'cuenta_origen'  => $p->cuentaOrigen ? [
                    'titular' => $p->cuentaOrigen->titular?->nombre_completo ?? '—',
                    'alias'   => $p->cuentaOrigen->alias,
                ] : null,
            ]),
        ]);
    }

    // API: cuentas bancarias del proveedor para cuenta destino
    public function cuentasProveedor(Request $request)
    {
        $proveedorId = $request->proveedor_id;
        if (!$proveedorId) return response()->json([]);

        $cuentas = CuentaBancaria::with('banco')
            ->whereNull('deleted_at')
            ->where('titular_id', $proveedorId)
            ->where('titular_type', 'App\Models\Proveedor')
            ->get()
            ->map(function ($c) {
                $label = '';
                if ($c->nombre_titular_cuenta) {
                    $rel    = $c->tipo_relacion ? " ({$c->tipo_relacion})" : '';
                    $label .= "👤 {$c->nombre_titular_cuenta}{$rel} — ";
                }
                $label .= $c->banco->nombre . ' ' . $c->numero_cuenta;
                if ($c->alias) $label .= " ({$c->alias})";
                $label .= " [{$c->moneda}]";
                return ['id' => $c->id, 'label' => $label];
            });

        return response()->json($cuentas);
    }
}
