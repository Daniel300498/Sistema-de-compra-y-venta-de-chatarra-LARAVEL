<table>
  <tr>
    <td colspan="7" style="background:#0f172a;color:#ffffff;text-align:center;font-weight:bold;font-size:22px;">REPORTE GENERAL DEL SISTEMA</td>
</tr>

<tr>
    <td colspan="7" style="text-align:center;color:#64748b;font-size:12px;">Desde {{ $fechaInicio }} hasta {{ $fechaFin }}</td>
</tr>

    <tr>
        <td colspan="7" style="text-align:center;font-size:12px;color:#475569;height:22px;">Sistema de Control de Compra y Venta de Chatarra</td>
    </tr>
    <tr><td colspan="7"></td></tr>

    <tr>
        <td colspan="2" style="font-weight:bold;background:#e2e8f0;">Fecha Inicio</td>
        <td colspan="2">{{ $fechaInicio }}</td>
        <td colspan="1" style="font-weight:bold;background:#e2e8f0;">Fecha Fin</td>
        <td colspan="2">{{ $fechaFin }}</td>
    </tr>

    <tr>
        <td colspan="2" style="font-weight:bold;background:#e2e8f0;">Proveedor</td>
        <td colspan="2">{{ $proveedorFiltro }}</td>
        <td colspan="1"style="font-weight:bold;background:#e2e8f0;">Cliente</td>
        <td colspan="2">{{ $clienteFiltro }}</td>
    </tr>

    <tr>
        <td colspan="2" style="font-weight:bold;background:#e2e8f0;">Tipo Contrato</td>
        <td colspan="5">{{ $tipoContratoFiltro }}</td>
    </tr>
    <tr><td colspan="7"></td></tr>
</table>
<table>

    <thead>
        <tr>
            <th colspan="7" style=" background:#1d4ed8;color:white;font-size:16px;font-weight:bold;height:28px;text-align:center;">PAGOS A PROVEEDORES</th>
        </tr>
        <tr style="background:#dbeafe;font-weight:bold;">
            <th>Fecha</th>
            <th>Contrato</th>
            <th>Proveedor</th>
            <th>Moneda</th>
            <th>Monto</th>
            <th>Estado</th>
            <th>Método</th>
        </tr>
    </thead>
    <tbody>
        @php $totalProveedor = 0; @endphp
        @foreach($pagosProveedor as $p)
            @php
                $totalProveedor += $p->monto;
            @endphp

            <tr>
                <td>{{ $p->fecha }}</td>
                <td>{{ $p->contrato->numero_contrato ?? '-' }}</td>
                <td>{{ $p->contrato->proveedor->nombre ?? '-' }}</td>
                <td>{{ $p->moneda }}</td>
                <td>{{ number_format($p->monto,2) }}</td>
                <td>{{ strtoupper($p->estado) }}</td>
                <td>{{ $p->metodo_pago ?? '-' }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" style=" font-weight:bold; background:#eff6ff;">TOTAL PAGOS PROVEEDORES</td>
            <td colspan="3" style="font-weight:bold;background:#eff6ff;">{{ number_format($totalProveedor,2) }}</td>
        </tr>
    </tbody>
</table>
<br><br>
<table>
    <thead>
        <tr>
            <th colspan="7" style="background:#15803d;color:white;font-size:16px;font-weight:bold;height:28px;text-align:center;">COBROS A CLIENTES</th>
        </tr>
        <tr style="background:#dcfce7;font-weight:bold;">
            <th>Fecha</th>
            <th>Contrato</th>
            <th>Cliente</th>
            <th>Moneda</th>
            <th>Monto</th>
            <th>Estado</th>
            <th>Método</th>
        </tr>
    </thead>
    <tbody>
        @php $totalClientes = 0; @endphp
        @foreach($cobrosCliente as $c)
            @php
                $totalClientes += $c->monto;
            @endphp
            <tr>
                <td>{{ $c->fecha }}</td>
                <td>{{ $c->contrato->numero_contrato ?? '-' }}</td>
                <td>{{ $c->contrato->cliente->nombre ?? '-' }}</td>
                <td>{{ $c->moneda ?? 'BOB' }}</td>
                <td>{{ number_format($c->monto,2) }}</td>
                <td>{{ strtoupper($c->estado) }}</td>
                <td>{{ $c->metodo_pago ?? '-' }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="4" style="font-weight:bold;background:#ecfdf5;">TOTAL COBROS CLIENTES</td>
            <td colspan="3"style="font-weight:bold;background:#ecfdf5;">{{ number_format($totalClientes,2) }}</td>
        </tr>
    </tbody>
</table>
<br><br>

<table>
    <thead>
        <tr>
            <th colspan="7" style="background:#9333ea;color:white;font-size:16px;font-weight:bold;height:28px;text-align:center;">GASTOS EXTRAS</th>
        </tr>

        <tr style="background:#f3e8ff;font-weight:bold;">
            <th>Fecha</th>
            <th>Contrato</th>
            <th>Categoría</th>
            <th>Concepto</th>
            <th>Monto BOB</th>
            <th>Estado</th>
            <th>Método</th>
        </tr>
    </thead>
    <tbody>
        @php $totalGastos = 0; @endphp
        @foreach($gastosExtras as $g)
            @php
                $totalGastos += $g->monto_bolivianos;
            @endphp
            <tr>
                <td>{{ $g->fecha }}</td>
                <td>{{ $g->contrato->numero_contrato ?? '-' }}</td>
                <td>{{ $g->categoria }}</td>
                <td>{{ $g->concepto }}</td>
                <td>{{ number_format($g->monto_bolivianos,2) }}</td>
                <td>{{ strtoupper($g->estado) }}</td>
                <td>{{ $g->metodo_pago ?? '-' }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="4"style="font-weight:bold;background:#faf5ff;">TOTAL GASTOS EXTRAS</td>
            <td colspan="3"style="font-weight:bold;background:#faf5ff;">{{ number_format($totalGastos,2) }}</td>
        </tr>
    </tbody>
</table>
<br><br>
<table>
    <thead>
        <tr>
            <th colspan="7" style="background:#ea580c;color:white;font-size:16px;font-weight:bold;height:28px;text-align:center;">PAGOS A CAMIONES</th>
        </tr>
        <tr style="background:#ffedd5;font-weight:bold;">
            <th>Fecha</th>
            <th>Contrato</th>
            <th>Camión</th>
            <th>Moneda</th>
            <th>Monto</th>
            <th>Estado</th>
            <th>Método</th>
        </tr>
    </thead>
    <tbody>
        @php $totalCamiones = 0; @endphp
        @foreach($pagosCamiones as $p)
            @php
                $totalCamiones += $p->monto;
            @endphp
            <tr>
                <td>{{ $p->fecha }}</td>
                <td>{{ $p->contrato->numero_contrato ?? '-' }}</td>
                <td>{{ $p->camion->placa ?? '-' }}</td>
                <td>{{ $p->moneda ?? 'BOB' }}</td>
                <td>{{ number_format($p->monto,2) }}</td>
                <td>{{ strtoupper($p->estado) }}</td>
                <td>{{ $p->metodo_pago ?? '-' }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4"style="font-weight:bold;background:#fff7ed;">TOTAL PAGOS CAMIONES</td>
            <td colspan="3"style="font-weight:bold;background:#fff7ed;">{{ number_format($totalCamiones,2) }}</td>
        </tr>
    </tbody>
</table>