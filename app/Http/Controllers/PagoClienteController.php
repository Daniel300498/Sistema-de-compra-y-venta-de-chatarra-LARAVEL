<?php

namespace App\Http\Controllers;

use App\Models\Tramo;
use App\Models\PagoCliente;
use App\Models\CuentaBancaria;
use App\Models\Cliente;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class PagoClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Tramos entregados con precio registrado
        $tramos = Tramo::with([
                'cliente',
                'contratoCamion.contrato',
                'contratoCamion.camion',
                'pagosCliente',
            ])
            ->where('estado', 'Entregado')
            ->whereNotNull('cliente_id')
            ->orderByDesc('fecha_llegada')
            ->get();

        $clientes = Cliente::whereNull('deleted_at')->orderBy('nombre')->get();

        // Cuentas de empleados para cuenta destino (donde el cliente deposita)
        $cuentasEmpresa = CuentaBancaria::with(['banco', 'titular'])
            ->whereNull('deleted_at')
            ->where('tipo_titular', 'empleado')
            ->orderBy('alias')
            ->get();

        return view('pagos.clientes.index', compact('tramos', 'clientes', 'cuentasEmpresa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tramo_id'           => 'required|exists:tramos,id',
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
            'tramo_id.required'    => 'Debe seleccionar la entrega.',
            'tipo_pago.required'   => 'Debe indicar el tipo de pago.',
            'monto.required'       => 'El monto es obligatorio.',
            'monto.min'            => 'El monto debe ser mayor a cero.',
            'moneda_pago.required' => 'Debe indicar la moneda.',
            'tipo_cambio.required' => 'Debe indicar el tipo de cambio.',
            'fecha_pago.required'  => 'La fecha es obligatoria.',
            'metodo_pago.required' => 'Debe indicar el método de pago.',
        ]);

        PagoCliente::create([
            'tramo_id'           => $request->tramo_id,
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

        Alert::success('Éxito', 'Pago del cliente registrado correctamente.');
        return redirect()->route('pagos.clientes.index');
    }

    public function setPrecio(Request $request, $id)
    {
        $tramo = Tramo::findOrFail($id);
        $request->validate([
            'precio_por_tonelada' => 'required|numeric|min:0.0001',
            'moneda_venta'        => 'required|in:BOB,USD,EUR,BRL,ARS,PEN,CLP,PYG,COP',
        ], [
            'precio_por_tonelada.required' => 'El precio por tonelada es obligatorio.',
            'precio_por_tonelada.min'      => 'El precio debe ser mayor a cero.',
            'moneda_venta.required'        => 'La moneda es obligatoria.',
        ]);

        $tramo->update([
            'precio_por_tonelada' => $request->precio_por_tonelada,
            'moneda_venta'        => $request->moneda_venta,
            'updated_by'          => auth()->id(),
        ]);

        Alert::success('Éxito', 'Precio por tonelada registrado correctamente.');
        return redirect()->route('pagos.clientes.index');
    }

    public function destroy($uuid)
    {
        $pago = PagoCliente::where('uuid', $uuid)->firstOrFail();
        $pago->delete();
        Alert::success('Éxito', 'Pago eliminado.');
        return redirect()->route('pagos.clientes.index');
    }

    // API: detalle de una entrega (tramo) con sus pagos
    public function detalle($id)
    {
        $tramo = Tramo::with([
            'cliente',
            'contratoCamion.contrato',
            'contratoCamion.camion',
            'pagosCliente.cuentaOrigen.banco',
            'pagosCliente.cuentaDestino.titular',
        ])->findOrFail($id);

        return response()->json([
            'id'                  => $tramo->id,
            'cliente'             => $tramo->cliente->nombre ?? '—',
            'contrato'            => $tramo->contratoCamion->contrato->numero_contrato ?? '—',
            'camion'              => $tramo->contratoCamion->camion->placa ?? '—',
            'destino'             => $tramo->destino,
            'fecha_llegada'       => $tramo->fecha_llegada?->format('d/m/Y'),
            'peso_llegada'        => $tramo->peso_llegada,
            'precio_por_tonelada' => $tramo->precio_por_tonelada,
            'moneda_venta'        => $tramo->moneda_venta ?? 'BOB',
            'monto_deuda'         => $tramo->monto_deuda_cliente,
            'total_cobrado'       => $tramo->total_cobrado_cliente,
            'saldo'               => $tramo->saldo_cliente,
            'pagos'               => $tramo->pagosCliente->map(fn($p) => [
                'uuid'           => $p->uuid,
                'tipo'           => $p->tipo_pago_label,
                'monto'          => $p->monto,
                'moneda_pago'    => $p->moneda_pago,
                'tipo_cambio'    => $p->tipo_cambio,
                'fecha'          => $p->fecha_pago->format('d/m/Y'),
                'metodo'         => $p->metodo_pago,
                'codigo'         => $p->codigo_seguimiento,
                'cuenta_origen'  => $p->cuentaOrigen ? [
                    'banco'  => $p->cuentaOrigen->banco->nombre ?? '—',
                    'numero' => $p->cuentaOrigen->numero_cuenta,
                    'moneda' => $p->cuentaOrigen->moneda,
                    'alias'  => $p->cuentaOrigen->alias,
                    'titular_cuenta' => $p->cuentaOrigen->nombre_titular_cuenta,
                    'tipo_relacion'  => $p->cuentaOrigen->tipo_relacion,
                ] : null,
                'cuenta_destino' => $p->cuentaDestino ? [
                    'titular' => $p->cuentaDestino->titular?->nombre_completo ?? '—',
                    'alias'   => $p->cuentaDestino->alias,
                ] : null,
            ]),
        ]);
    }

    // API: cuentas bancarias del cliente para cuenta origen
    public function cuentasCliente(Request $request)
    {
        $clienteId = $request->cliente_id;
        if (!$clienteId) return response()->json([]);

        $cuentas = CuentaBancaria::with('banco')
            ->whereNull('deleted_at')
            ->where('titular_id', $clienteId)
            ->where('titular_type', 'App\Models\Cliente')
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
