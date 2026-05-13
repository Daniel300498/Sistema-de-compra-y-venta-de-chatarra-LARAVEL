@extends('layouts.app')
@section('titulo', 'Cobros a Clientes')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>COBROS A CLIENTES</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Cobros Clientes</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cobros por Entrega</h5>
                <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle me-1"></i>
                    Lista de todos los camiones entregados a clientes. Si un camión no tiene precio/t registrado,
                    usa <strong>Opciones → Registrar precio/t</strong> para ingresarlo y habilitar el cobro.
                </p>

                {{-- ===== SELECTOR DE CLIENTE ===== --}}
                <div class="row g-2 align-items-end mb-3">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold mb-1"><i class="bi bi-people"></i> Filtrar por cliente</label>
                        <select class="form-select" id="filtro_cliente" onchange="filtrarPorCliente(this.value)">
                            <option value="">— Todos los clientes —</option>
                            @foreach($clientes as $cli)
                                <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-outline-secondary btn-sm" onclick="filtrarPorCliente('')">
                            <i class="bi bi-x-circle"></i> Limpiar
                        </button>
                    </div>
                    <div class="col-auto ms-auto">
                        <small class="text-muted">Mostrando <span id="lbl_count_visible">{{ $tramos->count() }}</span> entrega(s)</small>
                    </div>
                </div>

                @if($tramos->isEmpty())
                    <div class="alert alert-info py-2">
                        <small>
                            <i class="bi bi-info-circle"></i>
                            No hay entregas con precio registrado aún. Para registrar cobros, primero registre
                            la llegada de un tramo indicando el precio por tonelada al cliente.
                        </small>
                    </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm align-middle" id="tabla_cobros">
                        <thead class="table-light">
                            <tr>
                                <th>Cliente</th>
                                <th>Contrato</th>
                                <th>Camión</th>
                                <th>Fecha entrega</th>
                                <th class="text-end">Peso (t)</th>
                                <th class="text-end">Precio / t</th>
                                <th class="text-end">Total deuda</th>
                                <th class="text-end">Cobrado</th>
                                <th class="text-end">Saldo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tramos as $t)
                            @php
                                $tienePrecio = !is_null($t->precio_por_tonelada);
                                $mon         = $t->moneda_venta ?? 'BOB';
                                $deuda       = $tienePrecio ? $t->monto_deuda_cliente : 0;
                                $cobrado     = $tienePrecio ? $t->total_cobrado_cliente : 0;
                                $saldo       = $tienePrecio ? $t->saldo_cliente : null;
                                $pct         = $deuda > 0 ? min(100, round($cobrado / $deuda * 100)) : 0;
                                $rowClass    = $tienePrecio && $saldo <= 0 ? 'table-success' : ($tienePrecio ? '' : 'table-warning');
                            @endphp
                            <tr class="{{ $rowClass }}" data-cliente-id="{{ $t->cliente_id }}">
                                <td><strong>{{ $t->cliente->nombre ?? '—' }}</strong></td>
                                <td>
                                    <a href="{{ route('contratos.camiones', $t->contratoCamion->contrato->uuid ?? '') }}"
                                        class="text-decoration-none fw-semibold">
                                        {{ $t->contratoCamion->contrato->numero_contrato ?? '—' }}
                                    </a>
                                </td>
                                <td>
                                    <strong>{{ $t->contratoCamion->camion->placa ?? '—' }}</strong>
                                    <small class="text-muted d-block">{{ $t->contratoCamion->camion->marca ?? '' }}</small>
                                </td>
                                <td>
                                    <small>{{ $t->fecha_llegada?->format('d/m/Y') ?? '—' }}</small>
                                    <small class="text-muted d-block">{{ $t->destino }}</small>
                                </td>
                                <td class="text-end">{{ number_format($t->peso_llegada, 3) }}</td>
                                <td class="text-end">
                                    @if($tienePrecio)
                                        <small class="text-muted">{{ $mon }}</small>
                                        <strong>{{ number_format($t->precio_por_tonelada, 4) }}</strong>
                                    @else
                                        <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle"></i> Sin precio</span>
                                    @endif
                                </td>
                                <td class="text-end fw-semibold">{{ $tienePrecio ? $mon.' '.number_format($deuda,2) : '—' }}</td>
                                <td class="text-end text-success fw-semibold">{{ $tienePrecio ? $mon.' '.number_format($cobrado,2) : '—' }}</td>
                                <td class="text-end {{ $tienePrecio && $saldo > 0 ? 'text-danger fw-semibold' : 'text-success' }}">
                                    {{ $tienePrecio ? $mon.' '.number_format($saldo,2) : '—' }}
                                </td>
                                <td>
                                    @if(!$tienePrecio)
                                        <span class="badge bg-warning text-dark"><i class="bi bi-tag"></i> Sin precio</span>
                                    @elseif($saldo <= 0)
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Cobrado</span>
                                    @elseif($cobrado > 0)
                                        <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> {{ $pct }}% cobrado</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="bi bi-clock"></i> Pendiente</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-list-ul"></i> Opciones
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @if(!$tienePrecio)
                                            <li>
                                                <button class="dropdown-item" onclick="abrirModalPrecio({{ $t->id }}, '{{ addslashes($t->cliente->nombre ?? '') }} — {{ addslashes($t->contratoCamion->camion->placa ?? '') }}', '{{ addslashes($t->contratoCamion->contrato->numero_contrato ?? '') }}')">
                                                    <i class="bi bi-tag text-warning me-2"></i> Registrar precio/t
                                                </button>
                                            </li>
                                            @else
                                            <li>
                                                <button class="dropdown-item" onclick="abrirModalCobro({{ $t->id }}, '{{ addslashes($t->cliente->nombre ?? '') }} — {{ addslashes($t->contratoCamion->contrato->numero_contrato ?? '') }}', {{ $saldo }}, '{{ $t->moneda_venta ?? 'BOB' }}', {{ $t->cliente_id ?? 'null' }})">
                                                    <i class="bi bi-plus-circle text-success me-2"></i> Registrar cobro
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" onclick="verDetalle({{ $t->id }})">
                                                    <i class="bi bi-eye text-primary me-2"></i> Ver cobros
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" onclick="abrirModalPrecio({{ $t->id }}, '{{ addslashes($t->cliente->nombre ?? '') }} — {{ addslashes($t->contratoCamion->camion->placa ?? '') }}', '{{ addslashes($t->contratoCamion->contrato->numero_contrato ?? '') }}')">
                                                    <i class="bi bi-pencil text-secondary me-2"></i> Editar precio/t
                                                </button>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
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

{{-- ===== MODAL REGISTRAR PRECIO/TONELADA ===== --}}
<div class="modal fade" id="modalPrecio" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title"><i class="bi bi-tag"></i> Registrar Precio por Tonelada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="formPrecio" action="">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-light border py-2 mb-3">
                        <strong id="precio_label"></strong>
                        <div class="text-muted small" id="precio_contrato"></div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Moneda <span class="text-danger">*</span></label>
                            <select class="form-select" name="moneda_venta" required>
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
                        <div class="col-md-7">
                            <label class="form-label fw-semibold">Precio por tonelada <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.0001" min="0.0001" class="form-control"
                                    name="precio_por_tonelada" placeholder="0.0000" required>
                                <span class="input-group-text">/ t</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL REGISTRAR COBRO ===== --}}
<div class="modal fade" id="modalCobro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-receipt"></i> Registrar Cobro al Cliente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('pagos.clientes.store') }}">
                @csrf
                <input type="hidden" name="tramo_id" id="cobro_tramo_id">
                <div class="modal-body">

                    {{-- Info de la entrega seleccionada --}}
                    <div id="cobro_info_tramo" class="alert alert-light border mb-3 py-2" style="display:none;">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong id="cobro_tramo_label"></strong>
                            <div class="text-end">
                                <small class="text-muted">Saldo pendiente:</small>
                                <span class="badge bg-danger ms-1" id="cobro_saldo_label"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tipo de Cobro <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="tipo_pago" required>
                                <option value="">-- Seleccione --</option>
                                <option value="adelanto">Adelanto</option>
                                <option value="parcial">Parcial</option>
                                <option value="pago_final">Pago Final</option>
                            </select>
                        </div>

                        {{-- Bloque monto / moneda / tipo de cambio --}}
                        <div class="col-12">
                            <div class="border rounded-3 p-3 bg-light">
                                {{-- Moneda fija según precio/t del tramo --}}
                                <input type="hidden" name="moneda_pago" id="cobro_moneda_pago">
                                <div class="row g-2 align-items-end">

                                    <div class="col-md-7">
                                        <label class="form-label fw-semibold mb-1">Monto <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text fw-bold" id="cobro_lbl_moneda_monto">BOB</span>
                                            <input type="number" step="0.01" min="0.01" class="form-control"
                                                name="monto" id="cobro_inp_monto" required placeholder="0.00"
                                                oninput="calcEquivalente()">
                                        </div>
                                    </div>

                                    <div class="col-md-5" id="cobro_sec_tipo_cambio" style="display:none;">
                                        <label class="form-label fw-semibold mb-1">
                                            Tipo de cambio <span class="text-danger">*</span>
                                            <small class="text-muted fw-normal">— 1 <span id="cobro_lbl_moneda_tc"></span> equivale a:</small>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <input type="number" step="0.0001" min="0.0001" class="form-control"
                                                name="tipo_cambio" id="cobro_inp_tipo_cambio"
                                                placeholder="0.0000" oninput="calcEquivalente()" disabled>
                                            <span class="input-group-text">BOB</span>
                                        </div>
                                    </div>

                                </div>

                                <div id="cobro_sec_equivalente" style="display:none;" class="mt-2">
                                    <div class="d-flex align-items-center gap-2 rounded-2 px-3 py-2"
                                        style="background:#e8f4fd;border:1px solid #b8d9f5;">
                                        <i class="bi bi-arrow-left-right text-primary"></i>
                                        <span class="text-muted small">Equivalente en bolivianos:</span>
                                        <strong class="text-primary fs-6" id="cobro_lbl_equivalente">—</strong>
                                        <span class="text-muted small">BOB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="tipo_cambio" id="cobro_inp_tipo_cambio_bob" value="1">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Fecha de Cobro <span class="text-danger">(*)</span></label>
                            <input type="date" class="form-control" name="fecha_pago" required value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Método de Pago <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="metodo_pago" required onchange="toggleCodigo(this.value)">
                                <option value="">-- Seleccione --</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="transferencia">Transferencia Bancaria</option>
                                <option value="qr">QR</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="cobro_sec_codigo" style="display:none;">
                            <label class="form-label">Código / N° Cheque</label>
                            <input type="text" class="form-control" name="codigo_seguimiento" maxlength="100"
                                placeholder="Ej: TRX-20260512-001">
                        </div>

                        {{-- Cuenta origen (cuenta del cliente que paga) --}}
                        <div class="col-md-6">
                            <label class="form-label">Cuenta Origen (Cliente)</label>
                            <select class="form-select" name="cuenta_origen_id" id="sel_cuenta_origen">
                                <option value="">-- Efectivo / Sin cuenta --</option>
                            </select>
                        </div>

                        {{-- Cuenta destino (cuenta de la empresa / empleado que recibe) --}}
                        <div class="col-md-6">
                            <label class="form-label">Cuenta Destino (Empresa)</label>
                            <select class="form-select" name="cuenta_destino_id">
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

                        <div class="col-12">
                            <label class="form-label">Observaciones</label>
                            <textarea class="form-control" name="observaciones" rows="2" maxlength="500"
                                placeholder="Notas del cobro..."></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Registrar Cobro</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL DETALLE DE COBROS ===== --}}
<div class="modal fade" id="modalDetalle" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-list-ul"></i> Detalle de Cobros — <span id="det_titulo"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="det_body">
                <div class="text-center py-4"><div class="spinner-border text-success"></div></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>
let _clienteActual = null;

// ===== Filtro por cliente en la tabla =====
function filtrarPorCliente(clienteId) {
    document.getElementById('filtro_cliente').value = clienteId;
    const filas = document.querySelectorAll('#tabla_cobros tbody tr');
    let count = 0;
    filas.forEach(function (fila) {
        const visible = !clienteId || fila.dataset.clienteId === clienteId;
        fila.style.display = visible ? '' : 'none';
        if (visible) count++;
    });
    document.getElementById('lbl_count_visible').textContent = count;
}

// ===== Modal precio/tonelada =====
function abrirModalPrecio(tramoId, label, contrato) {
    document.getElementById('precio_label').textContent    = label;
    document.getElementById('precio_contrato').textContent = 'Contrato: ' + contrato;
    document.getElementById('formPrecio').action = '/pagos/clientes/' + tramoId + '/precio';
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalPrecio')).show();
}

// ===== Modal cobro =====
function abrirModalCobro(tramoId, label, saldo, moneda, clienteId) {
    moneda = moneda || 'BOB';
    document.getElementById('cobro_tramo_id').value           = tramoId;
    document.getElementById('cobro_tramo_label').textContent  = label;
    document.getElementById('cobro_saldo_label').textContent  = parseFloat(saldo).toFixed(2) + ' ' + moneda;
    document.getElementById('cobro_info_tramo').style.display = 'block';
    document.getElementById('cobro_inp_monto').value          = '';

    _clienteActual = clienteId;

    // Aplicar moneda fija inmediatamente
    toggleTipoCambio(moneda);

    cargarCuentasCliente(clienteId);
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCobro')).show();
}

function cargarCuentasCliente(clienteId) {
    const sel = document.getElementById('sel_cuenta_origen');
    sel.innerHTML = '<option value="">-- Cargando... --</option>';
    if (!clienteId) {
        sel.innerHTML = '<option value="">-- Efectivo / Sin cuenta --</option>';
        return;
    }
    fetch(`/api/pagos/cuentas-cliente?cliente_id=${clienteId}`)
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

// ===== Moneda / tipo de cambio =====
function toggleTipoCambio(moneda) {
    const secTC    = document.getElementById('cobro_sec_tipo_cambio');
    const secEquiv = document.getElementById('cobro_sec_equivalente');
    const inpTC    = document.getElementById('cobro_inp_tipo_cambio');
    const inpBob   = document.getElementById('cobro_inp_tipo_cambio_bob');
    const lblMonto = document.getElementById('cobro_lbl_moneda_monto');
    const lblTC    = document.getElementById('cobro_lbl_moneda_tc');

    document.getElementById('cobro_moneda_pago').value = moneda;
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
    const moneda = document.getElementById('cobro_moneda_pago').value;
    if (moneda === 'BOB') return;
    const monto    = parseFloat(document.getElementById('cobro_inp_monto').value) || 0;
    const tc       = parseFloat(document.getElementById('cobro_inp_tipo_cambio').value) || 0;
    const secEquiv = document.getElementById('cobro_sec_equivalente');
    const lblEquiv = document.getElementById('cobro_lbl_equivalente');
    if (monto > 0 && tc > 0) {
        lblEquiv.textContent   = 'Bs ' + (monto * tc).toFixed(2);
        secEquiv.style.display = 'block';
    } else {
        secEquiv.style.display = 'none';
    }
}

function toggleCodigo(metodo) {
    document.getElementById('cobro_sec_codigo').style.display =
        metodo === 'transferencia' ? 'block' : 'none';
}

// ===== Modal detalle =====
function verDetalle(tramoId) {
    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalDetalle'));
    document.getElementById('det_body').innerHTML =
        '<div class="text-center py-4"><div class="spinner-border text-success"></div></div>';
    modal.show();

    fetch(`/api/pagos/clientes/${tramoId}/detalle`)
        .then(r => r.json())
        .then(d => {
            const mon = d.moneda_venta || 'BOB';
            document.getElementById('det_titulo').textContent =
                d.cliente + ' — ' + d.contrato + ' (' + (d.fecha_llegada || '—') + ')';

            let html = `
            <div class="row g-2 mb-3">
                <div class="col-6 col-md-3">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small">Peso llegada</div>
                        <strong>${parseFloat(d.peso_llegada||0).toFixed(3)} t</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small">Precio / t</div>
                        <strong>${mon} ${parseFloat(d.precio_por_tonelada||0).toFixed(4)}</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small">Total deuda</div>
                        <strong>${mon} ${parseFloat(d.monto_deuda||0).toFixed(2)}</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="border rounded p-2 text-center bg-${parseFloat(d.saldo)<=0?'success':'warning'} bg-opacity-10">
                        <div class="text-muted small">Saldo</div>
                        <strong class="${parseFloat(d.saldo)<=0?'text-success':'text-danger'}">
                            ${mon} ${parseFloat(d.saldo||0).toFixed(2)}
                        </strong>
                    </div>
                </div>
            </div>`;

            if (!d.pagos || d.pagos.length === 0) {
                html += '<div class="alert alert-info">No hay cobros registrados aún.</div>';
            } else {
                const monedaFlag = { BOB:'🇧🇴', USD:'🇺🇸', BRL:'🇧🇷', ARS:'🇦🇷', EUR:'🇪🇺', PEN:'🇵🇪', CLP:'🇨🇱', PYG:'🇵🇾', COP:'🇨🇴' };
                const badgeTipo  = { 'Adelanto':'bg-warning text-dark', 'Parcial':'bg-info text-dark', 'Pago Final':'bg-success' };

                html += `<div class="table-responsive"><table class="table table-sm table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tipo</th>
                            <th class="text-end">Monto cobrado</th>
                            <th>Fecha</th>
                            <th>Método</th>
                            <th>Cuenta del cliente</th>
                            <th>Recibió</th>
                            <th>Código</th>
                            <th></th>
                        </tr>
                    </thead><tbody>`;

                d.pagos.forEach(p => {
                    const esBob  = p.moneda_pago === 'BOB';
                    const flag   = monedaFlag[p.moneda_pago] || '';
                    const badge  = badgeTipo[p.tipo] || 'bg-secondary';
                    const tcLine = esBob ? '' :
                        `<br><span class="badge bg-light text-secondary border" style="font-size:.7rem;">
                            TC: 1 ${p.moneda_pago} = ${parseFloat(p.tipo_cambio).toFixed(4)} Bs
                        </span>`;

                    // Cuenta origen (cliente)
                    let celOrigen = '—';
                    if (p.cuenta_origen) {
                        const rel     = p.cuenta_origen.tipo_relacion
                            ? ` <span class="badge bg-secondary" style="font-size:.65rem">${p.cuenta_origen.tipo_relacion}</span>`
                            : '';
                        const titular = p.cuenta_origen.titular_cuenta
                            ? `<span class="fw-semibold text-warning-emphasis">👤 ${p.cuenta_origen.titular_cuenta}</span>${rel}<br>`
                            : '';
                        celOrigen = `${titular}<small class="text-muted">🏦 ${p.cuenta_origen.banco} <code>${p.cuenta_origen.numero}</code> [${p.cuenta_origen.moneda}]${p.cuenta_origen.alias ? ' (' + p.cuenta_origen.alias + ')' : ''}</small>`;
                    }

                    // Cuenta destino (empleado que recibe)
                    let celDestino = '—';
                    if (p.cuenta_destino) {
                        celDestino = `<small>${p.cuenta_destino.titular || '—'}${p.cuenta_destino.alias ? ' (' + p.cuenta_destino.alias + ')' : ''}</small>`;
                    }

                    html += `<tr>
                        <td><span class="badge ${badge}">${p.tipo}</span></td>
                        <td class="text-end"><span class="fw-semibold">${flag} ${p.moneda_pago} ${parseFloat(p.monto).toFixed(2)}</span>${tcLine}</td>
                        <td><small>${p.fecha}</small></td>
                        <td><small>${p.metodo}</small></td>
                        <td>${celOrigen}</td>
                        <td>${celDestino}</td>
                        <td><small class="text-muted">${p.codigo||'—'}</small></td>
                        <td>
                            <a href="/pagos/clientes/${p.uuid}/destroy"
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('¿Eliminar este cobro?')">
                               <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>`;
                });

                html += '</tbody></table></div>';
            }
            document.getElementById('det_body').innerHTML = html;
        });
}
</script>
@endsection
