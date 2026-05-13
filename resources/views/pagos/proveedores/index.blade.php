@extends('layouts.app')
@section('titulo', 'Pagos a Proveedores')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>PAGOS A PROVEEDORES</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Pagos Proveedores</li>
                </ol>
            </nav>
        </div>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPago">
            <i class="bi bi-plus-lg"></i> Registrar Pago
        </button>
    </div>
</div>

<section class="section">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pagos por Contrato</h5>
                <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle me-1"></i>
                    Registra y controla los pagos realizados a los proveedores por cada contrato.
                    Cada pago puede tener su propia moneda y tipo de cambio.
                </p>

                {{-- ===== SELECTOR DE PROVEEDOR ===== --}}
                <div class="row g-2 align-items-end mb-3">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold mb-1"><i class="bi bi-box-seam"></i> Filtrar por proveedor</label>
                        <select class="form-select" id="filtro_proveedor" onchange="filtrarPorProveedor(this.value)">
                            <option value="">— Todos los proveedores —</option>
                            @foreach($proveedores as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-outline-secondary btn-sm" onclick="filtrarPorProveedor('')">
                            <i class="bi bi-x-circle"></i> Limpiar
                        </button>
                    </div>
                    <div class="col-auto ms-auto">
                        <small class="text-muted">Mostrando <span id="lbl_count_prov">{{ $contratos->count() }}</span> contrato(s)</small>
                    </div>
                </div>

                @if($contratos->isEmpty())
                    <div class="alert alert-info py-2">
                        <small><i class="bi bi-info-circle"></i> No hay contratos con proveedor registrados.</small>
                    </div>
                @else
                <div class="table-responsive">
                    <table id="tabla_pagos_prov" class="table table-hover table-bordered table-sm align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Contrato</th>
                                <th>Proveedor</th>
                                <th>Tipo</th>
                                <th class="text-end">Total acordado</th>
                                <th class="text-end">Pagado</th>
                                <th class="text-end">Saldo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contratos as $c)
                            @php
                                $mon     = $c->moneda ?? 'BOB';
                                $pagado  = $c->total_pagado_proveedor;
                                $saldo   = $c->saldo_pendiente_proveedor;
                                $total   = (float) $c->monto_total;
                                $pct     = $total > 0 ? min(100, round($pagado / $total * 100)) : 0;
                                $rowClass = $saldo <= 0 ? 'table-success' : '';
                            @endphp
                            <tr class="{{ $rowClass }}" data-proveedor-id="{{ $c->proveedor_id }}">
                                <td>
                                    <strong>{{ $c->numero_contrato }}</strong>
                                    <small class="text-muted d-block">{{ $c->fecha_inicio?->format('d/m/Y') ?? '—' }}</small>
                                </td>
                                <td>{{ $c->proveedor->nombre ?? '—' }}</td>
                                <td>
                                    <span class="badge bg-{{ $c->tipo_contrato === 'Internacional' ? 'info text-dark' : 'secondary' }}">
                                        {{ $c->tipo_contrato }}
                                    </span>
                                </td>
                                <td class="text-end">{{ $mon }} {{ number_format($total, 2) }}</td>
                                <td class="text-end text-success">{{ $mon }} {{ number_format($pagado, 2) }}</td>
                                <td class="text-end {{ $saldo > 0 ? 'text-danger fw-semibold' : 'text-success' }}">
                                    {{ $mon }} {{ number_format($saldo, 2) }}
                                </td>
                                <td>
                                    @if($saldo <= 0)
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Pagado</span>
                                    @elseif($pagado > 0)
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-hourglass-split"></i> {{ $pct }}% pagado
                                        </span>
                                    @else
                                        <span class="badge bg-secondary"><i class="bi bi-clock"></i> Pendiente</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary"
                                        onclick="verDetalle({{ $c->id }})" title="Ver pagos">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success"
                                        onclick="abrirModalPago({{ $c->id }}, '{{ addslashes($c->numero_contrato) }} — {{ addslashes($c->proveedor->nombre ?? '') }}', {{ $saldo }}, '{{ $mon }}', {{ $c->proveedor_id ?? 'null' }})"
                                        title="Registrar pago">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</section>

{{-- ===== MODAL REGISTRAR PAGO ===== --}}
<div class="modal fade" id="modalPago" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-cash-coin"></i> Registrar Pago a Proveedor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('pagos.proveedores.store') }}">
                @csrf
                <input type="hidden" name="contrato_id" id="pago_contrato_id">
                <div class="modal-body">

                    {{-- Info del contrato --}}
                    <div id="pago_info_contrato" class="alert alert-light border mb-3 py-2" style="display:none;">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong id="pago_contrato_label"></strong>
                            <div class="text-end">
                                <small class="text-muted">Saldo pendiente:</small>
                                <span class="badge bg-danger ms-1" id="pago_saldo_label"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">

                        {{-- Selector de contrato (cuando se abre sin contrato preseleccionado) --}}
                        <div class="col-12" id="sec_seleccionar_contrato">
                            <label class="form-label fw-semibold">Contrato <span class="text-danger">(*)</span></label>
                            <select class="form-select" id="sel_contrato" onchange="cambiarContrato(this.value)">
                                <option value="">-- Seleccione --</option>
                                @foreach($contratos as $c)
                                    <option value="{{ $c->id }}"
                                        data-label="{{ $c->numero_contrato }} — {{ $c->proveedor->nombre ?? '' }}"
                                        data-saldo="{{ $c->saldo_pendiente_proveedor }}"
                                        data-moneda="{{ $c->moneda ?? 'BOB' }}"
                                        data-proveedor-id="{{ $c->proveedor_id }}">
                                        {{ $c->numero_contrato }} — {{ $c->proveedor->nombre ?? '—' }}
                                        (Saldo: {{ $c->moneda }} {{ number_format($c->saldo_pendiente_proveedor, 2) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tipo de Pago <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="tipo_pago" required>
                                <option value="">-- Seleccione --</option>
                                <option value="adelanto">Adelanto</option>
                                <option value="parcial">Parcial</option>
                                <option value="pago_final">Pago Final</option>
                            </select>
                        </div>

                        {{-- Bloque moneda / monto / tipo de cambio --}}
                        <div class="col-12">
                            <div class="border rounded-3 p-3 bg-light">
                                <div class="row g-2 align-items-end">

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold mb-1">Moneda <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-sm" name="moneda_pago" id="moneda_pago" required onchange="toggleTipoCambio(this.value)">
                                            <option value="BOB">🇧🇴 BOB</option>
                                            <option value="USD">🇺🇸 USD</option>
                                            <option value="BRL">🇧🇷 BRL</option>
                                            <option value="ARS">🇦🇷 ARS</option>
                                            <option value="EUR">🇪🇺 EUR</option>
                                            <option value="PEN">🇵🇪 PEN</option>
                                            <option value="CLP">🇨🇱 CLP</option>
                                            <option value="PYG">🇵🇾 PYG</option>
                                            <option value="COP">🇨🇴 COP</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold mb-1">Monto <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text fw-bold" id="lbl_moneda_monto">BOB</span>
                                            <input type="number" step="0.01" min="0.01" class="form-control"
                                                name="monto" id="inp_monto" required placeholder="0.00"
                                                oninput="calcEquivalente()">
                                        </div>
                                    </div>

                                    <div class="col-md-5" id="sec_tipo_cambio" style="display:none;">
                                        <label class="form-label fw-semibold mb-1">
                                            Tipo de cambio <span class="text-danger">*</span>
                                            <small class="text-muted fw-normal">— 1 <span id="lbl_moneda_tc"></span> equivale a:</small>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <input type="number" step="0.0001" min="0.0001" class="form-control"
                                                name="tipo_cambio" id="inp_tipo_cambio"
                                                placeholder="0.0000" oninput="calcEquivalente()" disabled>
                                            <span class="input-group-text">BOB</span>
                                        </div>
                                    </div>

                                </div>

                                <div id="sec_equivalente" style="display:none;" class="mt-2">
                                    <div class="d-flex align-items-center gap-2 rounded-2 px-3 py-2" style="background:#e8f4fd;border:1px solid #b8d9f5;">
                                        <i class="bi bi-arrow-left-right text-primary"></i>
                                        <span class="text-muted small">Equivalente en bolivianos:</span>
                                        <strong class="text-primary fs-6" id="lbl_equivalente">—</strong>
                                        <span class="text-muted small">BOB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="tipo_cambio" id="inp_tipo_cambio_bob" value="1">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Fecha de Pago <span class="text-danger">(*)</span></label>
                            <input type="date" class="form-control" name="fecha_pago" required value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Método de Pago <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="metodo_pago" id="metodo_pago" required onchange="toggleCodigo(this.value)">
                                <option value="">-- Seleccione --</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="transferencia">Transferencia Bancaria</option>
                                <option value="qr">QR</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="sec_codigo" style="display:none;">
                            <label class="form-label">Código / N° Cheque</label>
                            <input type="text" class="form-control" name="codigo_seguimiento" maxlength="100"
                                placeholder="Ej: TRX-20260512-001">
                        </div>

                        {{-- Cuenta origen (empleado) --}}
                        <div class="col-md-6">
                            <label class="form-label">Cuenta Origen (Empleado)</label>
                            <select class="form-select" name="cuenta_origen_id">
                                <option value="">-- Efectivo / Sin cuenta --</option>
                                @foreach($cuentasEmpresa as $cta)
                                    <option value="{{ $cta->id }}">
                                        {{ $cta->titular?->nombre_completo ?? '—' }} —
                                        {{ $cta->banco->nombre }} {{ $cta->numero_cuenta }}
                                        @if($cta->alias) ({{ $cta->alias }}) @endif
                                        [{{ $cta->moneda }}]
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Cuenta destino (proveedor) --}}
                        <div class="col-md-6">
                            <label class="form-label">Cuenta Destino (Proveedor)</label>
                            <select class="form-select" name="cuenta_destino_id" id="sel_cuenta_destino">
                                <option value="">-- Efectivo / Sin cuenta --</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Observaciones</label>
                            <textarea class="form-control" name="observaciones" rows="2" maxlength="500"
                                placeholder="Notas del pago..."></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Registrar Pago</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL DETALLE ===== --}}
<div class="modal fade" id="modalDetalle" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-list-ul"></i> Detalle de Pagos — <span id="det_titulo"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="det_body">
                <div class="text-center py-4"><div class="spinner-border text-primary"></div></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>
function filtrarPorProveedor(proveedorId) {
    const filas = document.querySelectorAll('#tabla_pagos_prov tbody tr');
    let visibles = 0;
    filas.forEach(function(fila) {
        const mostrar = !proveedorId || fila.dataset.proveedorId == proveedorId;
        fila.style.display = mostrar ? '' : 'none';
        if (mostrar) visibles++;
    });
    document.getElementById('lbl_count_prov').textContent = visibles;
    const sel = document.getElementById('filtro_proveedor');
    if (sel) sel.value = proveedorId;
}

let _proveedorActual = null;
let _monedaPendiente = null;

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('modalPago').addEventListener('shown.bs.modal', function () {
        if (_monedaPendiente) {
            toggleTipoCambio(_monedaPendiente);
            _monedaPendiente = null;
        }
    });
});

function toggleTipoCambio(moneda) {
    const secTC    = document.getElementById('sec_tipo_cambio');
    const secEquiv = document.getElementById('sec_equivalente');
    const inpTC    = document.getElementById('inp_tipo_cambio');
    const inpBob   = document.getElementById('inp_tipo_cambio_bob');
    const lblMonto = document.getElementById('lbl_moneda_monto');
    const lblTC    = document.getElementById('lbl_moneda_tc');

    document.getElementById('moneda_pago').value = moneda;
    lblMonto.textContent = moneda;

    if (moneda === 'BOB') {
        secTC.style.display    = 'none';
        secEquiv.style.display = 'none';
        inpTC.disabled  = true;
        inpTC.value     = '';
        inpBob.disabled = false;
        inpBob.value    = '1';
    } else {
        secTC.style.display = 'block';
        inpTC.disabled  = false;
        inpBob.disabled = true;
        lblTC.textContent = moneda;
        calcEquivalente();
    }
}

function calcEquivalente() {
    const moneda = document.getElementById('moneda_pago').value;
    if (moneda === 'BOB') return;
    const monto    = parseFloat(document.getElementById('inp_monto').value) || 0;
    const tc       = parseFloat(document.getElementById('inp_tipo_cambio').value) || 0;
    const secEquiv = document.getElementById('sec_equivalente');
    const lblEquiv = document.getElementById('lbl_equivalente');
    if (monto > 0 && tc > 0) {
        lblEquiv.textContent = 'Bs ' + (monto * tc).toFixed(2);
        secEquiv.style.display = 'block';
    } else {
        secEquiv.style.display = 'none';
    }
}

function abrirModalPago(contratoId, label, saldo, moneda, proveedorId) {
    document.getElementById('pago_contrato_id').value        = contratoId;
    document.getElementById('sel_contrato').value            = contratoId;
    document.getElementById('pago_contrato_label').textContent = label;
    document.getElementById('pago_saldo_label').textContent  = parseFloat(saldo).toFixed(2) + ' ' + (moneda || 'BOB');
    document.getElementById('pago_info_contrato').style.display = 'block';

    _monedaPendiente  = moneda || 'BOB';
    _proveedorActual  = proveedorId;

    cargarCuentasProveedor(proveedorId);
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalPago')).show();
}

function cambiarContrato(contratoId) {
    if (!contratoId) return;
    const opt = document.querySelector(`#sel_contrato option[value="${contratoId}"]`);
    if (!opt) return;

    document.getElementById('pago_contrato_id').value          = contratoId;
    document.getElementById('pago_contrato_label').textContent = opt.dataset.label;
    const mon = opt.dataset.moneda || 'BOB';
    document.getElementById('pago_saldo_label').textContent    = parseFloat(opt.dataset.saldo).toFixed(2) + ' ' + mon;
    document.getElementById('pago_info_contrato').style.display = 'block';

    document.getElementById('moneda_pago').value = mon;
    toggleTipoCambio(mon);

    _proveedorActual = opt.dataset.proveedorId || null;
    cargarCuentasProveedor(_proveedorActual);
}

function cargarCuentasProveedor(proveedorId) {
    const sel = document.getElementById('sel_cuenta_destino');
    sel.innerHTML = '<option value="">-- Cargando... --</option>';
    if (!proveedorId) {
        sel.innerHTML = '<option value="">-- Efectivo / Sin cuenta --</option>';
        return;
    }
    fetch(`/api/pagos/cuentas-proveedor?proveedor_id=${proveedorId}`)
        .then(r => r.json())
        .then(data => {
            sel.innerHTML = '<option value="">-- Efectivo / Sin cuenta --</option>';
            data.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c.id;
                opt.textContent = c.label;
                sel.appendChild(opt);
            });
        });
}

function toggleCodigo(metodo) {
    document.getElementById('sec_codigo').style.display =
        metodo === 'transferencia' ? 'block' : 'none';
}

function verDetalle(contratoId) {
    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalDetalle'));
    document.getElementById('det_body').innerHTML =
        '<div class="text-center py-4"><div class="spinner-border text-primary"></div></div>';
    modal.show();

    fetch(`/api/pagos/proveedores/${contratoId}/detalle`)
        .then(r => r.json())
        .then(d => {
            const mon = d.moneda || 'BOB';
            document.getElementById('det_titulo').textContent = d.numero + ' — ' + d.proveedor;

            let html = `
            <div class="row g-2 mb-3">
                <div class="col-6 col-md-4">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small">Total acordado</div>
                        <strong>${mon} ${parseFloat(d.monto_total||0).toFixed(2)}</strong>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small">Pagado</div>
                        <strong class="text-success">${mon} ${parseFloat(d.total_pagado||0).toFixed(2)}</strong>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="border rounded p-2 text-center bg-${parseFloat(d.saldo_pendiente)<=0?'success':'warning'} bg-opacity-10">
                        <div class="text-muted small">Saldo</div>
                        <strong class="${parseFloat(d.saldo_pendiente)<=0?'text-success':'text-danger'}">
                            ${mon} ${parseFloat(d.saldo_pendiente||0).toFixed(2)}
                        </strong>
                    </div>
                </div>
            </div>`;

            if (!d.pagos || d.pagos.length === 0) {
                html += '<div class="alert alert-info">No hay pagos registrados aún.</div>';
            } else {
                const monedaFlag = { BOB:'🇧🇴', USD:'🇺🇸', BRL:'🇧🇷', ARS:'🇦🇷', EUR:'🇪🇺', PEN:'🇵🇪', CLP:'🇨🇱', PYG:'🇵🇾', COP:'🇨🇴' };
                const badgeTipo  = { 'Adelanto':'bg-warning text-dark', 'Parcial':'bg-info text-dark', 'Pago Final':'bg-success' };

                html += `<div class="d-flex flex-column gap-2">`;
                d.pagos.forEach(p => {
                    const esBob   = p.moneda_pago === 'BOB';
                    const flag    = monedaFlag[p.moneda_pago] || '';
                    const badge   = badgeTipo[p.tipo] || 'bg-secondary';
                    const tcLine  = esBob ? '' : `<span class="text-muted ms-1" style="font-size:.7rem">TC: 1 ${p.moneda_pago} = ${parseFloat(p.tipo_cambio).toFixed(4)} Bs</span>`;

                    // Cuenta destino
                    let destLine = '';
                    if (p.cuenta_destino) {
                        const rel     = p.cuenta_destino.tipo_relacion ? ` <span class="badge bg-secondary" style="font-size:.65rem">${p.cuenta_destino.tipo_relacion}</span>` : '';
                        const titular = p.cuenta_destino.titular_cuenta ? `<span class="fw-semibold text-warning-emphasis">👤 ${p.cuenta_destino.titular_cuenta}</span>${rel} — ` : '';
                        destLine = `<div class="small mt-1">🏦 ${titular}${p.cuenta_destino.banco} <code>${p.cuenta_destino.numero}</code> [${p.cuenta_destino.moneda}]${p.cuenta_destino.alias ? ' <span class="text-muted">('+p.cuenta_destino.alias+')</span>' : ''}</div>`;
                    }

                    // Cuenta origen
                    let origLine = '';
                    if (p.cuenta_origen) {
                        const alias = p.cuenta_origen.alias ? ` (${p.cuenta_origen.alias})` : '';
                        origLine = `<span class="text-muted ms-2" style="font-size:.75rem">· Pagó: ${p.cuenta_origen.titular}${alias}</span>`;
                    }

                    html += `
                    <div class="rounded-2 border px-3 py-2 bg-white">
                        <div class="d-flex align-items-start gap-3">
                            <div class="pt-1"><span class="badge ${badge}">${p.tipo}</span></div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">${flag} ${p.moneda_pago} ${parseFloat(p.monto).toFixed(2)}${tcLine}</div>
                                <div class="text-muted small">${p.fecha} &nbsp;·&nbsp; ${p.metodo}${p.codigo ? ' &nbsp;·&nbsp; ' + p.codigo : ''}${origLine}</div>
                                ${destLine}
                            </div>
                            <a href="/pagos/proveedores/${p.uuid}/destroy"
                               class="btn btn-sm btn-outline-danger border-0 mt-1"
                               onclick="return confirm('¿Eliminar este pago?')" title="Eliminar">
                               <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </div>`;
                });
                html += '</div>';
            }
            document.getElementById('det_body').innerHTML = html;
        });
}
</script>
@endsection
