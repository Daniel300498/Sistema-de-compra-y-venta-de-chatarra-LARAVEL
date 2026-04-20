@extends('layouts.app')
@section('titulo','Contratos')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>GESTIÓN DE CONTRATOS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Contratos</li>
                </ol>
            </nav>
        </div>
        @can('contratos.create')
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalContrato" onclick="resetModalContrato()">
            <i class="bi bi-plus-lg"></i> Nuevo Contrato
        </button>
        @endcan
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Contratos Registrados</h5>
                    <div class="table-responsive">
                        <table id="datos" class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>N° Contrato</th>
                                    <th>Tipo</th>
                                    <th>Cliente</th>
                                    <th>Proveedor</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Camiones</th>
                                    <th>Toneladas</th>
                                    <th>Monto Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contratos as $c)
                                <tr>
                                    <td><span class="fw-bold text-primary">{{ $c->numero_contrato }}</span></td>
                                    <td>
                                        @if($c->tipo_contrato === 'Nacional')
                                            <span class="badge bg-info text-dark">Nacional</span>
                                        @else
                                            <span class="badge bg-primary">Internacional</span>
                                        @endif
                                    </td>
                                    <td>{{ $c->cliente->nombre }} <small class="text-muted">({{ $c->cliente->nit }})</small></td>
                                    <td>{{ $c->proveedor->nombre }} <small class="text-muted">({{ $c->proveedor->pais }})</small></td>
                                    <td>{{ $c->fecha_inicio?->format('d/m/Y') ?? '-' }}</td>
                                    <td>{{ $c->fecha_fin?->format('d/m/Y') ?? '-' }}</td>
                                    <td class="text-center">{{ $c->cantidad_camiones ?? '-' }}</td>
                                    <td class="text-center">
                                        @if($c->toneladas_contrato)
                                            @php
                                                $total      = (float) $c->toneladas_contrato;
                                                $entregadas = $c->toneladas_entregadas;
                                                $asignadas  = $c->toneladas_asignadas;
                                                $pendientes = max(0, $asignadas - $entregadas);
                                                $pctEnt     = min(100, round(($entregadas / $total) * 100, 1));
                                                $pctPen     = min(100 - $pctEnt, round(($pendientes / $total) * 100, 1));
                                            @endphp
                                            <div class="progress" style="height:16px; min-width:90px;" title="{{ $pctEnt }}% entregado · {{ $pctPen }}% pendiente">
                                                @if($pctEnt > 0)
                                                <div class="progress-bar bg-success" style="width:{{ $pctEnt }}%">
                                                    @if($pctEnt >= 15){{ $pctEnt }}%@endif
                                                </div>
                                                @endif
                                                @if($pctPen > 0)
                                                <div class="progress-bar" style="width:{{ $pctPen }}%; background:#38bdf8;">
                                                    @if($pctPen >= 15){{ $pctPen }}%@endif
                                                </div>
                                                @endif
                                            </div>
                                            <small class="text-muted">
                                                <span class="text-success fw-semibold">{{ number_format($entregadas,1) }}t</span>
                                                / <span style="color:#0ea5e9;">{{ number_format($pendientes,1) }}t</span>
                                                / {{ number_format($total,1) }}t
                                            </small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $c->moneda }} {{ number_format($c->monto_total, 2) }}</td>
                                    <td>
                                        @php
                                            $badgeMap = [
                                                'Borrador'   => 'bg-secondary',
                                                'Activo'     => 'bg-success',
                                                'Finalizado' => 'bg-dark',
                                                'Cancelado'  => 'bg-danger',
                                            ];
                                        @endphp
                                        <span class="badge {{ $badgeMap[$c->estado] ?? 'bg-secondary' }}">{{ $c->estado }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Opciones</button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('contratos.camiones', $c->uuid) }}">
                                                        <i class="bi bi-truck"></i> Gestionar Camiones
                                                    </a>
                                                </li>
                                                @can('contratos.edit')
                                                <li>
                                                    <a class="dropdown-item" href="#" onclick="editarContrato({{ $c->id }}, '{{ $c->uuid }}')">
                                                        <i class="bi bi-pencil"></i> Modificar
                                                    </a>
                                                </li>
                                                @endcan
                                                @can('contratos.destroy')
                                                <li>
                                                    <a class="dropdown-item text-danger" href="{{ route('contratos.destroy', $c->uuid) }}"
                                                        onclick="return confirm('¿Eliminar el contrato {{ $c->numero_contrato }}?')">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </a>
                                                </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== MODAL CONTRATO ===== --}}
<div class="modal fade" id="modalContrato" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-file-earmark-text"></i> <span id="tituloContrato">Nuevo Contrato</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formContrato" method="POST" action="{{ route('contratos.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodContrato" value="POST">
                <div class="modal-body">
                    <p>Los campos con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    <div class="row g-3">

                        {{-- Número de contrato (solo lectura) --}}
                        <div class="col-md-4">
                            <label class="form-label">N° Contrato</label>
                            <input type="text" class="form-control bg-light fw-bold text-primary"
                                id="numero_contrato_display" value="{{ $numeroSiguiente }}" readonly>
                        </div>

                        {{-- Tipo de contrato --}}
                        <div class="col-md-4">
                            <label class="form-label">Tipo de Contrato <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('tipo_contrato') is-invalid @enderror"
                                name="tipo_contrato" id="tipo_contrato" required>
                                <option value="">-- Seleccione --</option>
                                <option value="Nacional">Nacional</option>
                                <option value="Internacional">Internacional</option>
                            </select>
                            @error('tipo_contrato')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Estado --}}
                        <div class="col-md-4">
                            <label class="form-label">Estado <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('estado') is-invalid @enderror"
                                name="estado" id="estado" required>
                                <option value="Borrador">Borrador</option>
                                <option value="Activo">Activo</option>
                                <option value="Finalizado">Finalizado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Cliente --}}
                        <div class="col-md-6">
                            <label class="form-label">Cliente <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('cliente_id') is-invalid @enderror"
                                name="cliente_id" id="cliente_id" required>
                                <option value="">-- Seleccione cliente --</option>
                                @foreach($clientes as $cl)
                                    <option value="{{ $cl->id }}">
                                        {{ $cl->nombre }}
                                        @if($cl->nit) — NIT/CI: {{ $cl->nit }} @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Proveedor --}}
                        <div class="col-md-6">
                            <label class="form-label">Proveedor <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('proveedor_id') is-invalid @enderror"
                                name="proveedor_id" id="proveedor_id" required>
                                <option value="">-- Seleccione proveedor --</option>
                                @foreach($proveedores as $pv)
                                    <option value="{{ $pv->id }}">
                                        {{ $pv->nombre }} — {{ $pv->pais }}
                                        @if($pv->nit) (NIT: {{ $pv->nit }}) @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('proveedor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Fechas --}}
                        <div class="col-md-3">
                            <label class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror"
                                name="fecha_inicio" id="fecha_inicio">
                            @error('fecha_inicio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror"
                                name="fecha_fin" id="fecha_fin">
                            @error('fecha_fin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Cantidad camiones --}}
                        <div class="col-md-3">
                            <label class="form-label">Cant. Camiones Estimados</label>
                            <input type="number" class="form-control @error('cantidad_camiones') is-invalid @enderror"
                                name="cantidad_camiones" id="cantidad_camiones" min="1">
                            @error('cantidad_camiones')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Toneladas contrato --}}
                        <div class="col-md-3">
                            <label class="form-label">Total Toneladas Contrato</label>
                            <input type="number" step="0.001"
                                class="form-control @error('toneladas_contrato') is-invalid @enderror"
                                name="toneladas_contrato" id="toneladas_contrato"
                                min="0.001" placeholder="Ej: 500.000">
                            <small class="text-muted">Toneladas pactadas.</small>
                            @error('toneladas_contrato')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Monto y moneda --}}
                        <div class="col-md-2">
                            <label class="form-label">Moneda <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('moneda') is-invalid @enderror"
                                name="moneda" id="moneda" required>
                                <option value="BOB" selected>BOB</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="BRL">BRL</option>
                                <option value="ARS">ARS</option>
                                <option value="PEN">PEN</option>
                                <option value="CLP">CLP</option>
                                <option value="PYG">PYG</option>
                                <option value="COP">COP</option>
                            </select>
                            @error('moneda')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Monto Total <span class="text-danger">(*)</span></label>
                            <input type="number" step="0.01" class="form-control @error('monto_total') is-invalid @enderror"
                                name="monto_total" id="monto_total" min="0" required>
                            @error('monto_total')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnContrato">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>
    // Reabrir modal si hay errores de validación
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', function () {
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modalContrato')).show();
        });
    @endif

    function resetModalContrato() {
        document.getElementById('tituloContrato').innerText = 'Nuevo Contrato';
        document.getElementById('btnContrato').innerText    = 'Registrar';
        document.getElementById('methodContrato').value     = 'POST';
        document.getElementById('formContrato').action      = '{{ route("contratos.store") }}';
        document.getElementById('numero_contrato_display').value = '{{ $numeroSiguiente }}';
        document.getElementById('formContrato').reset();
        document.getElementById('moneda').value = 'BOB';
        document.getElementById('estado').value = 'Borrador';
    }

    function editarContrato(id, uuid) {
        fetch('/contrato/' + uuid + '/edit')
            .then(r => r.json())
            .then(c => {
                document.getElementById('tituloContrato').innerText          = 'Editar Contrato';
                document.getElementById('btnContrato').innerText             = 'Actualizar';
                document.getElementById('methodContrato').value              = 'PUT';
                document.getElementById('formContrato').action               = '/contrato/' + id;
                document.getElementById('numero_contrato_display').value     = c.numero_contrato;
                document.getElementById('tipo_contrato').value               = c.tipo_contrato;
                document.getElementById('estado').value                      = c.estado;
                document.getElementById('cliente_id').value                  = c.cliente_id;
                document.getElementById('proveedor_id').value                = c.proveedor_id;
                document.getElementById('fecha_inicio').value                = c.fecha_inicio ?? '';
                document.getElementById('fecha_fin').value                   = c.fecha_fin ?? '';
                document.getElementById('cantidad_camiones').value           = c.cantidad_camiones ?? '';
                document.getElementById('toneladas_contrato').value          = c.toneladas_contrato ?? '';
                document.getElementById('moneda').value                      = c.moneda;
                document.getElementById('monto_total').value                 = c.monto_total;
                bootstrap.Modal.getOrCreateInstance(document.getElementById('modalContrato')).show();
            });
    }
</script>
@endsection
