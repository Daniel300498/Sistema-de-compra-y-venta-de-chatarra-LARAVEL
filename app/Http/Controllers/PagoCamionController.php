<?php

namespace App\Http\Controllers;

use App\Models\PagoCamion;
use App\Models\ContratoCamion;
use App\Models\CuentaBancaria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PagoCamionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pagos = PagoCamion::with([
                'contratoCamion.contrato',
                'contratoCamion.camion',
                'contratoCamion.conductor',
                'contratoCamion.camion.propietario',
                'cuentaOrigen.titular',
                'cuentaDestino.banco',
                'receptor',
            ])
            ->orderByDesc('fecha_pago')
            ->orderByDesc('created_at')
            ->get();

        return view('pagos.camiones.index', compact('pagos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contrato_camion_id' => 'required|exists:contrato_camiones,id',
            'tipo_pago'          => 'required|in:adelanto,flete,pago_final',
            'monto'              => 'required|numeric|min:0.01',
            'moneda_pago'        => 'required|in:BOB,USD,EUR,BRL,ARS,PEN,CLP,PYG,COP',
            'tipo_cambio'        => 'required|numeric|min:0.0001',
            'fecha_pago'         => 'required|date',
            'receptor_type'      => 'nullable|in:conductor,propietario',
            'receptor_id'        => 'nullable|integer',
            'cuenta_origen_id'   => 'nullable|exists:cuentas_bancarias,id',
            'cuenta_destino_id'  => 'nullable|exists:cuentas_bancarias,id',
            'metodo_pago'        => 'required|in:efectivo,transferencia,qr,cheque',
            'codigo_seguimiento' => 'nullable|string|max:100',
            'observaciones'      => 'nullable|string|max:500',
        ], [
            'contrato_camion_id.required' => 'Debe seleccionar la asignación.',
            'tipo_pago.required'          => 'Debe indicar el tipo de pago.',
            'monto.required'              => 'El monto es obligatorio.',
            'monto.min'                   => 'El monto debe ser mayor a cero.',
            'moneda_pago.required'        => 'Debe indicar la moneda del pago.',
            'tipo_cambio.required'        => 'Debe indicar el tipo de cambio.',
            'tipo_cambio.min'             => 'El tipo de cambio debe ser mayor a cero.',
            'fecha_pago.required'         => 'La fecha de pago es obligatoria.',
            'metodo_pago.required'        => 'Debe indicar el método de pago.',
        ]);

        $receptorType = null;
        if ($request->receptor_type === 'conductor') {
            $receptorType = 'App\Models\OperadorTransporte';
        } elseif ($request->receptor_type === 'propietario') {
            $receptorType = 'App\Models\OperadorTransporte';
        }

        PagoCamion::create([
            'contrato_camion_id' => $request->contrato_camion_id,
            'tipo_pago'          => $request->tipo_pago,
            'monto'              => $request->monto,
            'moneda_pago'        => $request->moneda_pago,
            'tipo_cambio'        => $request->tipo_cambio,
            'fecha_pago'         => $request->fecha_pago,
            'receptor_type'      => $receptorType,
            'receptor_id'        => $request->receptor_id ?: null,
            'cuenta_origen_id'   => $request->cuenta_origen_id ?: null,
            'cuenta_destino_id'  => $request->cuenta_destino_id ?: null,
            'metodo_pago'        => $request->metodo_pago,
            'codigo_seguimiento' => $request->codigo_seguimiento ?: null,
            'observaciones'      => $request->observaciones ?: null,
            'created_by'         => auth()->id(),
            'updated_by'         => auth()->id(),
        ]);

        Alert::success('Éxito', 'Pago registrado correctamente.');
        return redirect()->route('seguimiento.index');
    }

    public function update(Request $request, $uuid)
    {
        $pago = PagoCamion::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'tipo_pago'          => 'required|in:adelanto,flete,pago_final',
            'monto'              => 'required|numeric|min:0.01',
            'moneda_pago'        => 'required|in:BOB,USD,EUR,BRL,ARS,PEN,CLP,PYG,COP',
            'tipo_cambio'        => 'required|numeric|min:0.0001',
            'fecha_pago'         => 'required|date',
            'metodo_pago'        => 'required|in:efectivo,transferencia,qr,cheque',
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
        return redirect()->route('seguimiento.index');
    }

    public function destroy($uuid)
    {
        $pago = PagoCamion::where('uuid', $uuid)->firstOrFail();
        $pago->delete();
        Alert::success('Éxito', 'Pago eliminado.');
        return redirect()->route('seguimiento.index');
    }

    // API: cuentas del receptor para poblar el select de cuenta destino
    public function cuentasReceptor(Request $request)
    {
        $id = $request->receptor_id;
        if (!$id) return response()->json([]);

        $cuentas = CuentaBancaria::with('banco')
            ->whereNull('deleted_at')
            ->where('titular_id', $id)
            ->where('titular_type', 'App\Models\OperadorTransporte')
            ->get()
            ->map(function ($c) {
                $titular = $c->nombre_titular_cuenta
                    ? $c->nombre_titular_cuenta
                    : null;
                $label = '';
                if ($titular) $label .= '👤 ' . $titular . ' — ';
                $label .= $c->banco->nombre . ' ' . $c->numero_cuenta;
                if ($c->alias) $label .= ' (' . $c->alias . ')';
                $label .= ' [' . $c->moneda . ']';
                return ['id' => $c->id, 'label' => $label];
            });

        return response()->json($cuentas);
    }

    // API: detalle financiero de una asignación para el modal
    public function detalle($id)
    {
        $cc = ContratoCamion::with([
            'contrato',
            'camion',
            'conductor',
            'camion.propietario',
            'pagos.cuentaDestino.banco',
            'pagos.cuentaOrigen.titular',
            'tramos',
        ])->findOrFail($id);

        return response()->json([
            'id'               => $cc->id,
            'camion'           => $cc->camion->placa . ' ' . $cc->camion->marca,
            'contrato'         => $cc->contrato->numero_contrato ?? '—',
            'conductor'        => $cc->conductor?->nombre_completo ?? '—',
            'propietario'      => $cc->camion->propietario?->nombre_completo ?? '—',
            'monto_acordado'   => $cc->monto_acordado,
            'descuento_monto'  => $cc->descuento_monto,
            'monto_neto'       => $cc->monto_neto,
            'total_pagado'     => $cc->total_pagado,
            'saldo_pendiente'  => $cc->saldo_pendiente,
            'moneda_flete'     => $cc->moneda_flete,
            'pagos'            => $cc->pagos->map(fn($p) => [
                'uuid'        => $p->uuid,
                'tipo'        => $p->tipo_pago_label,
                'tipo_raw'    => $p->tipo_pago,
                'monto'       => $p->monto,
                'moneda_pago' => $p->moneda_pago,
                'tipo_cambio' => $p->tipo_cambio,
                'monto_bob'   => $p->monto_en_bob,
                'fecha'       => $p->fecha_pago->format('d/m/Y'),
                'fecha_raw'   => $p->fecha_pago->format('Y-m-d'),
                'metodo'      => ucfirst($p->metodo_pago),
                'metodo_raw'  => $p->metodo_pago,
                'receptor'        => $p->nombre_receptor,
                'codigo'          => $p->codigo_seguimiento,
                'cuenta_destino'  => $p->cuentaDestino ? [
                    'banco'          => $p->cuentaDestino->banco->nombre ?? '—',
                    'numero'         => $p->cuentaDestino->numero_cuenta,
                    'moneda'         => $p->cuentaDestino->moneda,
                    'alias'          => $p->cuentaDestino->alias,
                    'titular_cuenta' => $p->cuentaDestino->nombre_titular_cuenta,
                    'tipo_relacion'  => $p->cuentaDestino->tipo_relacion,
                ] : null,
                'cuenta_origen'   => $p->cuentaOrigen ? [
                    'titular'        => $p->cuentaOrigen->titular?->nombre_completo ?? '—',
                    'alias'          => $p->cuentaOrigen->alias,
                ] : null,
            ]),
        ]);
    }
}
