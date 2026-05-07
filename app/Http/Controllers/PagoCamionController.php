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
        // Todos los contrato_camiones que tienen monto_acordado registrado
        $asignaciones = ContratoCamion::with([
                'contrato',
                'camion',
                'conductor',
                'camion.propietario',
                'pagos',
            ])
            ->whereNotNull('monto_acordado')
            ->orderByDesc('created_at')
            ->get();

        // Cuentas de la empresa para cuenta origen
        $cuentasEmpresa = CuentaBancaria::with('banco')
            ->whereNull('deleted_at')
            ->where('tipo_titular', 'empresa')
            ->orderBy('alias')
            ->get();

        return view('pagos.camiones.index', compact('asignaciones', 'cuentasEmpresa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contrato_camion_id' => 'required|exists:contrato_camiones,id',
            'tipo_pago'          => 'required|in:adelanto,flete,pago_final',
            'monto'              => 'required|numeric|min:0.01',
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
        return redirect()->route('pagos.camiones.index');
    }

    public function destroy($uuid)
    {
        $pago = PagoCamion::where('uuid', $uuid)->firstOrFail();
        $pago->delete();
        Alert::success('Éxito', 'Pago eliminado.');
        return redirect()->route('pagos.camiones.index');
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
            ->map(fn($c) => [
                'id'    => $c->id,
                'label' => $c->banco->nombre . ' — ' . $c->numero_cuenta . ($c->alias ? ' (' . $c->alias . ')' : '') . ' [' . $c->moneda . ']',
            ]);

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
            'pagos',
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
            'pagos'            => $cc->pagos->map(fn($p) => [
                'uuid'       => $p->uuid,
                'tipo'       => $p->tipo_pago_label,
                'monto'      => $p->monto,
                'fecha'      => $p->fecha_pago->format('d/m/Y'),
                'metodo'     => $p->metodo_pago,
                'receptor'   => $p->nombre_receptor,
                'codigo'     => $p->codigo_seguimiento,
            ]),
        ]);
    }
}
