@extends('layouts.app')
@section('titulo', 'Pagos a Camiones')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>PAGOS A CAMIONES</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Pagos Camiones</li>
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

    {{-- ===== TABLA DE ASIGNACIONES CON RESUMEN ===== --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Resumen por Asignación</h5>
                @if($asignaciones->isEmpty())
                    <div class="alert alert-info py-2">
                        <small><i class="bi bi-info-circle"></i> No hay asignaciones con monto acordado registrado. Agrega el monto al asignar un camión a un contrato.</small>
                    </div>
                @else
                <div class="table-responsive">
                    <table id="tabla_pagos" class="table table-hover table-bordered table-sm align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Camión</th>
                                <th>Contrato</th>
                                <th>Conductor</th>
                                <th>Propietario</th>
                                <th class="text-end">Acordado</th>
                                <th class="text-end">Descuento</th>
                                <th class="text-end">Neto</th>
                                <th class="text-end">Pagado</th>
                                <th class="text-end">Saldo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asignaciones as $cc)
                            @php
                                $saldo = $cc->saldo_pendiente;
                                $neto  = $cc->monto_neto;
                                $pagado = $cc->total_pagado;
                                $pct = $neto > 0 ? min(100, round($pagado / $neto * 100)) : 0;
                                $rowClass = $saldo <= 0 ? 'table-success' : '';
                            @endphp
                            <tr class="{{ $rowClass }}">
                                <td>
                                    <strong>{{ $cc->camion->placa }}</strong>
                                    <small class="text-muted d-block">{{ $cc->camion->marca }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('contratos.camiones', $cc->contrato->uuid) }}" class="text-decoration-none">
                                        {{ $cc->contrato->numero_contrato ?? 'Contrato #'.$cc->contrato_id }}
                                    </a>
                                </td>
                                <td>{{ $cc->conductor?->nombre_completo ?? '—' }}</td>
                                <td>{{ $cc->camion->propietario?->nombre_completo ?? '—' }}</td>
                                <td class="text-end">Bs {{ number_format($cc->monto_acordado, 2) }}</td>
                                <td class="text-end text-danger">
                                    @if($cc->descuento_monto > 0)
                                        - Bs {{ number_format($cc->descuento_monto, 2) }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-end fw-semibold">Bs {{ number_format($neto, 2) }}</td>
                                <td class="text-end text-success">Bs {{ number_format($pagado, 2) }}</td>
                                <td class="text-end {{ $saldo > 0 ? 'text-danger fw-semibold' : 'text-success' }}">
                                    Bs {{ number_format($saldo, 2) }}
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
                                        onclick="verDetalle({{ $cc->id }})"
                                        title="Ver pagos">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success"
                                        onclick="abrirModalPago({{ $cc->id }}, '{{ addslashes($cc->camion->placa) }} - {{ addslashes($cc->camion->marca) }}', {{ $cc->saldo_pendiente }})"
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
                <h5 class="modal-title"><i class="bi bi-cash-coin"></i> Registrar Pago</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('pagos.camiones.store') }}">
                @csrf
                <input type="hidden" name="contrato_camion_id" id="pago_cc_id">
                <div class="modal-body">

                    {{-- Info del camión --}}
                    <div id="pago_info_camion" class="alert alert-light border mb-3 py-2" style="display:none;">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong id="pago_camion_label"></strong>
                            </div>
                            <div class="text-end">
                                <small class="text-muted">Saldo pendiente:</small>
                                <span class="badge bg-danger ms-1" id="pago_saldo_label"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">

                        {{-- Si viene del botón "+" ya está seleccionado; si viene del btn principal muestra select --}}
                        <div class="col-12" id="sec_seleccionar_cc">
                            <label class="form-label fw-semibold">Asignación (Camión / Contrato) <span class="text-danger">(*)</span></label>
                            <select class="form-select" id="sel_cc" onchange="cambiarCC(this.value)">
                                <option value="">-- Seleccione --</option>
                                @foreach($asignaciones as $cc)
                                    <option value="{{ $cc->id }}"
                                        data-label="{{ $cc->camion->placa }} {{ $cc->camion->marca }} — {{ $cc->contrato->numero_contrato ?? 'Contrato #'.$cc->contrato_id }}"
                                        data-saldo="{{ $cc->saldo_pendiente }}"
                                        data-conductor-id="{{ $cc->conductor_id }}"
                                        data-conductor="{{ $cc->conductor?->nombre_completo ?? '' }}"
                                        data-propietario-id="{{ $cc->camion->propietario_id }}"
                                        data-propietario="{{ $cc->camion->propietario?->nombre_completo ?? '' }}">
                                        {{ $cc->camion->placa }} — {{ $cc->contrato->numero_contrato ?? 'Contrato #'.$cc->contrato_id }}
                                        (Saldo: Bs {{ number_format($cc->saldo_pendiente, 2) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tipo de Pago <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="tipo_pago" required>
                                <option value="">-- Seleccione --</option>
                                <option value="adelanto">Adelanto</option>
                                <option value="flete">Flete</option>
                                <option value="pago_final">Pago Final</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Monto (Bs) <span class="text-danger">(*)</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Bs</span>
                                <input type="number" step="0.01" min="0.01" class="form-control" name="monto" required placeholder="0.00">
                            </div>
                        </div>

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
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="sec_codigo" style="display:none;">
                            <label class="form-label">Código de Seguimiento / N° Cheque</label>
                            <input type="text" class="form-control" name="codigo_seguimiento" maxlength="100"
                                placeholder="Ej: TRX-20260506-001">
                        </div>

                        {{-- Receptor --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pagar a</label>
                            <select class="form-select" name="receptor_type" id="receptor_type" onchange="cambiarReceptor(this.value)">
                                <option value="">-- Seleccione --</option>
                                <option value="conductor" id="opt_conductor">Conductor</option>
                                <option value="propietario" id="opt_propietario">Propietario</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="sec_receptor_nombre" style="display:none;">
                            <label class="form-label">Nombre del Receptor</label>
                            <input type="text" class="form-control" id="receptor_nombre_display" readonly>
                            <input type="hidden" name="receptor_id" id="receptor_id_hidden">
                        </div>

                        {{-- Cuenta origen (empresa) --}}
                        <div class="col-md-6">
                            <label class="form-label">Cuenta Origen (Empresa)</label>
                            <select class="form-select" name="cuenta_origen_id">
                                <option value="">-- Efectivo / Sin cuenta --</option>
                                @foreach($cuentasEmpresa as $cta)
                                    <option value="{{ $cta->id }}">
                                        {{ $cta->banco->nombre }} — {{ $cta->numero_cuenta }}
                                        @if($cta->alias) ({{ $cta->alias }}) @endif
                                        [{{ $cta->moneda }}]
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Cuenta destino (receptor) --}}
                        <div class="col-md-6">
                            <label class="form-label">Cuenta Destino (Receptor)</label>
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

{{-- ===== MODAL DETALLE DE PAGOS ===== --}}
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
// Datos de cuentas por operador (cargados vía AJAX al seleccionar receptor)
let receptorActual = { conductor_id: null, propietario_id: null };

function abrirModalPago(ccId, label, saldo) {
    document.getElementById('pago_cc_id').value = ccId;
    document.getElementById('sel_cc').value = ccId;
    document.getElementById('pago_camion_label').textContent = label;
    document.getElementById('pago_saldo_label').textContent = 'Bs ' + parseFloat(saldo).toFixed(2);
    document.getElementById('pago_info_camion').style.display = 'block';

    // Cargar datos del conductor/propietario desde el option
    const opt = document.querySelector(`#sel_cc option[value="${ccId}"]`);
    if (opt) {
        receptorActual = {
            conductor_id:   opt.dataset.conductorId   || null,
            conductor:      opt.dataset.conductor     || '',
            propietario_id: opt.dataset.propietarioId || null,
            propietario:    opt.dataset.propietario   || '',
        };
        // Habilitar/deshabilitar opciones según existan
        document.getElementById('opt_conductor').disabled   = !receptorActual.conductor_id;
        document.getElementById('opt_propietario').disabled = !receptorActual.propietario_id;
    }

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalPago')).show();
}

function cambiarCC(ccId) {
    if (!ccId) return;
    const opt = document.querySelector(`#sel_cc option[value="${ccId}"]`);
    if (!opt) return;
    document.getElementById('pago_cc_id').value = ccId;
    document.getElementById('pago_camion_label').textContent = opt.dataset.label;
    document.getElementById('pago_saldo_label').textContent  = 'Bs ' + parseFloat(opt.dataset.saldo).toFixed(2);
    document.getElementById('pago_info_camion').style.display = 'block';

    receptorActual = {
        conductor_id:   opt.dataset.conductorId   || null,
        conductor:      opt.dataset.conductor     || '',
        propietario_id: opt.dataset.propietarioId || null,
        propietario:    opt.dataset.propietario   || '',
    };
    document.getElementById('opt_conductor').disabled   = !receptorActual.conductor_id;
    document.getElementById('opt_propietario').disabled = !receptorActual.propietario_id;
    document.getElementById('receptor_type').value = '';
    document.getElementById('sec_receptor_nombre').style.display = 'none';
    document.getElementById('sel_cuenta_destino').innerHTML = '<option value="">-- Efectivo / Sin cuenta --</option>';
}

function cambiarReceptor(tipo) {
    const sec = document.getElementById('sec_receptor_nombre');
    if (!tipo) { sec.style.display = 'none'; return; }

    let nombre = '', id = null;
    if (tipo === 'conductor') {
        nombre = receptorActual.conductor;
        id     = receptorActual.conductor_id;
    } else {
        nombre = receptorActual.propietario;
        id     = receptorActual.propietario_id;
    }

    document.getElementById('receptor_nombre_display').value = nombre;
    document.getElementById('receptor_id_hidden').value = id || '';
    sec.style.display = 'block';

    // Cargar cuentas del receptor
    cargarCuentasReceptor(id);
}

function cargarCuentasReceptor(id) {
    const sel = document.getElementById('sel_cuenta_destino');
    sel.innerHTML = '<option value="">-- Cargando... --</option>';
    if (!id) { sel.innerHTML = '<option value="">-- Efectivo / Sin cuenta --</option>'; return; }

    fetch(`/api/pagos/cuentas-receptor?receptor_id=${id}`)
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
    const sec = document.getElementById('sec_codigo');
    sec.style.display = ['transferencia', 'cheque'].includes(metodo) ? 'block' : 'none';
}

function verDetalle(ccId) {
    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalDetalle'));
    document.getElementById('det_body').innerHTML = '<div class="text-center py-4"><div class="spinner-border text-primary"></div></div>';
    modal.show();

    fetch(`/api/pagos/camiones/${ccId}/detalle`)
        .then(r => r.json())
        .then(d => {
            document.getElementById('det_titulo').textContent = d.camion;
            let html = `
            <div class="row g-2 mb-3">
                <div class="col-6 col-md-3">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small">Acordado</div>
                        <strong>Bs ${parseFloat(d.monto_acordado||0).toFixed(2)}</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small">Descuento</div>
                        <strong class="text-danger">- Bs ${parseFloat(d.descuento_monto||0).toFixed(2)}</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="border rounded p-2 text-center">
                        <div class="text-muted small">Neto a pagar</div>
                        <strong>Bs ${parseFloat(d.monto_neto||0).toFixed(2)}</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="border rounded p-2 text-center bg-${parseFloat(d.saldo_pendiente)<=0?'success':'warning'} bg-opacity-10">
                        <div class="text-muted small">Saldo</div>
                        <strong class="${parseFloat(d.saldo_pendiente)<=0?'text-success':'text-danger'}">
                            Bs ${parseFloat(d.saldo_pendiente||0).toFixed(2)}
                        </strong>
                    </div>
                </div>
            </div>`;

            if (d.pagos.length === 0) {
                html += '<div class="alert alert-info">No hay pagos registrados aún.</div>';
            } else {
                html += `<div class="table-responsive"><table class="table table-sm table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tipo</th><th>Monto</th><th>Fecha</th><th>Método</th><th>Receptor</th><th>Código</th><th></th>
                        </tr>
                    </thead><tbody>`;
                d.pagos.forEach(p => {
                    html += `<tr>
                        <td><span class="badge bg-secondary">${p.tipo}</span></td>
                        <td class="text-end fw-semibold">Bs ${parseFloat(p.monto).toFixed(2)}</td>
                        <td>${p.fecha}</td>
                        <td>${p.metodo}</td>
                        <td>${p.receptor||'—'}</td>
                        <td><small>${p.codigo||'—'}</small></td>
                        <td>
                            <a href="/pagos/camiones/${p.uuid}/destroy"
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('¿Eliminar este pago?')">
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
