@extends('layouts.app')
@section('titulo', 'Camiones — ' . $contrato->numero_contrato)
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>CONTRATO {{ $contrato->numero_contrato }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('contratos.index') }}">Contratos</a></li>
                    <li class="breadcrumb-item active">Camiones y Tramos</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('contratos.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<section class="section">
    <div class="row">

        {{-- ===== COLUMNA IZQUIERDA ===== --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detalle del Contrato</h5>
                    <table class="table table-sm table-borderless">
                        <tr><th>N° Contrato</th><td><span class="fw-bold text-primary">{{ $contrato->numero_contrato }}</span></td></tr>
                        <tr><th>Tipo</th><td>{{ $contrato->tipo_contrato }}</td></tr>
                        <tr><th>Cliente</th><td>{{ $contrato->cliente->nombre }}</td></tr>
                        <tr><th>Proveedor</th><td>{{ $contrato->proveedor->nombre }}</td></tr>
                        <tr><th>Fecha Inicio</th><td>{{ $contrato->fecha_inicio?->format('d/m/Y') ?? '-' }}</td></tr>
                        <tr><th>Fecha Fin</th><td>{{ $contrato->fecha_fin?->format('d/m/Y') ?? '-' }}</td></tr>
                        <tr><th>Monto</th><td>{{ $contrato->moneda }} {{ number_format($contrato->monto_total, 2) }}</td></tr>
                        <tr>
                            <th>Estado</th>
                            <td>
                                @php $badgeMap = ['Borrador'=>'bg-secondary','Activo'=>'bg-success','Finalizado'=>'bg-dark','Cancelado'=>'bg-danger']; @endphp
                                <span class="badge {{ $badgeMap[$contrato->estado] ?? 'bg-secondary' }}">{{ $contrato->estado }}</span>
                            </td>
                        </tr>
                    </table>

                    {{-- Gráfico toneladas --}}
                    @if($contrato->toneladas_contrato)
                        @php
                            $total      = (float) $contrato->toneladas_contrato;
                            $entregadas = $contrato->toneladas_entregadas;
                            $enTransito = $contrato->toneladas_en_transito;
                            $pctEnt     = min(100, round(($entregadas / $total) * 100, 1));
                            $pctTra     = min(100 - $pctEnt, round(($enTransito / $total) * 100, 1));
                        @endphp
                        <hr>
                        <h6 class="fw-bold">Toneladas del Contrato</h6>
                        <div class="progress mb-1" style="height:22px;" title="{{ $pctEnt }}% entregado · {{ $pctTra }}% en tránsito">
                            @if($pctEnt > 0)
                            <div class="progress-bar bg-success progress-bar-striped" style="width:{{ $pctEnt }}%">
                                @if($pctEnt >= 10){{ $pctEnt }}%@endif
                            </div>
                            @endif
                            @if($pctTra > 0)
                            <div class="progress-bar progress-bar-striped" style="width:{{ $pctTra }}%; background:#38bdf8;">
                                @if($pctTra >= 10){{ $pctTra }}%@endif
                            </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between">
                            <small>
                                <span class="text-success fw-semibold"><i class="bi bi-check-circle"></i> {{ number_format($entregadas, 3) }} t</span>
                                &nbsp;·&nbsp;
                                <span style="color:#0ea5e9;"><i class="bi bi-truck"></i> {{ number_format($enTransito, 3) }} t</span>
                            </small>
                            <small class="text-muted">Total: <strong>{{ number_format($total, 3) }} t</strong></small>
                        </div>
                        @if($pctEnt >= 100)
                            <span class="badge bg-success w-100 text-center py-2 mt-2">✓ Contrato completado</span>
                        @endif
                    @else
                        <div class="alert alert-warning py-2 mt-2">
                            <small><i class="bi bi-exclamation-triangle"></i> Sin toneladas definidas en el contrato.</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ===== COLUMNA DERECHA ===== --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-tabs" id="camionesTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pane-lista" type="button">
                                <i class="bi bi-diagram-3"></i> Camiones y Tramos
                                <span class="badge bg-primary ms-1">{{ $contrato->contratoCamiones->count() }}</span>
                            </button>
                        </li>
                        @can('contratos.edit')
                        <li class="nav-item">
                            <button class="nav-link @if($errors->any()) active @endif" data-bs-toggle="tab" data-bs-target="#pane-agregar" type="button">
                                <i class="bi bi-plus-circle"></i> Asignar Camión
                            </button>
                        </li>
                        @endcan
                    </ul>

                    <div class="tab-content pt-3">

                        {{-- ===== LISTA ===== --}}
                        <div class="tab-pane fade @if(!$errors->any()) show active @endif" id="pane-lista">
                            @if($contrato->contratoCamiones->isEmpty())
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i> No hay camiones asignados a este contrato aún.
                                </div>
                            @else
                                @foreach($contrato->contratoCamiones as $cc)
                                @php $tramosRaiz = $cc->tramos->whereNull('tramo_padre_id'); @endphp
                                <div class="card border mb-3 {{ $cc->estado_entrega === 'Entregado' ? 'border-success' : '' }}">
                                    <div class="card-header py-2 {{ $cc->estado_entrega === 'Entregado' ? 'bg-success bg-opacity-10' : 'bg-light' }}">
                                        {{-- Línea 1: identificación + estado + acciones --}}
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="bi bi-truck {{ $cc->estado_entrega === 'Entregado' ? 'text-success' : 'text-primary' }}"></i>
                                                <strong>{{ $cc->camion->placa }}</strong>
                                                <span class="text-muted ms-1">{{ $cc->camion->marca }} {{ $cc->camion->modelo }}</span>
                                            </div>
                                            <div class="d-flex gap-2 align-items-center">
                                                <span class="badge {{ $cc->estado_entrega === 'Entregado' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                    {{ $cc->estado_entrega }}
                                                </span>
                                                @can('contratos.edit')
                                                @if($cc->estado_entrega === 'Pendiente')
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="confirmarEliminarCC('{{ $cc->uuid }}', '{{ $cc->camion->placa }}')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif
                                                @endcan
                                            </div>
                                        </div>
                                        {{-- Línea 2: toneladas --}}
                                        <div class="mt-1 d-flex gap-3 flex-wrap">
                                            <small class="text-muted">
                                                <i class="bi bi-tag"></i> Proveedor:
                                                <strong>{{ number_format($cc->toneladas, 3) }} t</strong>
                                            </small>
                                            @if($cc->estado_entrega === 'Entregado')
                                                <small class="text-success fw-semibold">
                                                    <i class="bi bi-check-circle"></i> Entregado al cliente:
                                                    <strong>{{ number_format($cc->peso_entregado, 3) }} t</strong>
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body py-2">
                                        @if($tramosRaiz->isEmpty())
                                            <small class="text-muted"><i class="bi bi-info-circle"></i> Sin tramos registrados.</small>
                                        @else
                                            @foreach($tramosRaiz as $tramo)
                                                @include('contratos.partials.tramo', ['tramo' => $tramo, 'nivel' => 0, 'camionesDisponibles' => $camionesDisponibles])
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>

                        {{-- ===== FORMULARIO ASIGNAR CAMIÓN ===== --}}
                        @can('contratos.edit')
                        <div class="tab-pane fade @if($errors->any()) show active @endif" id="pane-agregar">
                            @if($errors->any())
                                <div class="alert alert-danger py-2">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <p class="text-muted small"><i class="bi bi-info-circle"></i> Al asignar el camión se registra automáticamente el primer tramo de transporte.</p>
                            <form method="POST" action="{{ route('contrato-camion.store') }}">
                                @csrf
                                <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
                                <div class="row g-3">

                                    {{-- Camión --}}
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold">Camión <span class="text-danger">(*)</span></label>
                                        <select class="form-select @error('camion_id') is-invalid @enderror"
                                            name="camion_id" id="cc_camion_id" required>
                                            <option value="">-- Busque por placa o marca --</option>
                                            @foreach($camionesDisponibles as $cam)
                                                <option value="{{ $cam->id }}" data-uuid="{{ $cam->uuid }}" data-capacidad="{{ $cam->capacidad_kg }}">
                                                    {{ $cam->placa }} — {{ $cam->marca }} {{ $cam->modelo }} ({{ number_format($cam->capacidad_kg / 1000, 3) }} t cap.)
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('camion_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    {{-- Conductor --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Conductor <span class="text-danger">(*)</span></label>
                                        <select class="form-select @error('conductor_id') is-invalid @enderror"
                                            name="conductor_id" id="cc_conductor_id" disabled required>
                                            <option value="">— Primero seleccione un camión —</option>
                                        </select>
                                        <div id="cc_sin_conductores" class="alert alert-warning py-2 mt-1 d-none">
                                            <i class="bi bi-exclamation-triangle"></i> No hay conductores para este camión.
                                        </div>
                                        @error('conductor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    {{-- Tipo de tramo --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tipo de Tramo <span class="text-danger">(*)</span></label>
                                        <select class="form-select @error('tipo_tramo') is-invalid @enderror" name="tipo_tramo" required>
                                            <option value="Nacional" {{ old('tipo_tramo') == 'Nacional' ? 'selected' : '' }}>Nacional</option>
                                            <option value="Internacional" {{ old('tipo_tramo') == 'Internacional' ? 'selected' : '' }}>Internacional</option>
                                        </select>
                                        @error('tipo_tramo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    {{-- Origen y Destino --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Origen <span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control @error('origen') is-invalid @enderror"
                                            name="origen" value="{{ old('origen') }}" required maxlength="150" placeholder="Ej: SÃO PAULO, BRASIL"
                                            style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()">
                                        @error('origen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Destino <span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control @error('destino') is-invalid @enderror"
                                            name="destino" value="{{ old('destino') }}" required maxlength="150" placeholder="Ej: FRONTERA CORUMBÁ / LA PAZ"
                                            style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()">
                                        @error('destino')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    {{-- Peso declarado y fecha --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Peso declarado por el proveedor (t) <span class="text-danger">(*)</span></label>
                                        <input type="number" step="0.001" min="0.001"
                                            class="form-control @error('peso_declarado') is-invalid @enderror"
                                            name="peso_declarado" value="{{ old('peso_declarado') }}" required
                                            placeholder="Ej: 25.000">
                                        <small class="text-muted">Lo que el proveedor dice que entrega.</small>
                                        @error('peso_declarado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Fecha de Salida <span class="text-danger">(*)</span></label>
                                        <input type="date" class="form-control @error('fecha_asignacion') is-invalid @enderror"
                                            name="fecha_asignacion" value="{{ old('fecha_asignacion', date('Y-m-d')) }}" required>
                                        @error('fecha_asignacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    {{-- Observaciones --}}
                                    <div class="col-12">
                                        <label class="form-label">Observaciones</label>
                                        <textarea class="form-control" name="observaciones" rows="2" maxlength="500"
                                            placeholder="Notas adicionales...">{{ old('observaciones') }}</textarea>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-plus-lg"></i> Asignar Camión
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endcan

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ===== MODAL REGISTRAR LLEGADA ===== --}}
<div class="modal fade" id="modalLlegada" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-geo-alt"></i> Registrar Llegada</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="formLlegada" action="">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-light border mb-3 py-2">
                        <small class="text-muted">Tramo:</small><br>
                        <strong id="llegada_tramo_info"></strong>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Peso al llegar (t) <span class="text-danger">(*)</span></label>
                            <input type="number" step="0.001" min="0.001" class="form-control"
                                name="peso_llegada" id="inp_peso_llegada" required placeholder="Toneladas reales pesadas">
                            <small class="text-muted">Máximo permitido: <strong id="llegada_peso_max"></strong> t</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha de llegada <span class="text-danger">(*)</span></label>
                            <input type="date" class="form-control" name="fecha_llegada" id="inp_fecha_llegada" required>
                            <small class="text-muted">No puede ser anterior a la fecha de salida.</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">¿Qué ocurrió al llegar? <span class="text-danger">(*)</span></label>
                            <div class="d-flex flex-column gap-2 mt-1">
                                <div class="form-check border rounded p-3">
                                    <input class="form-check-input" type="radio" name="accion" value="entregado" id="accion_entregado" required>
                                    <label class="form-check-label" for="accion_entregado">
                                        <i class="bi bi-check-circle text-success"></i>
                                        <strong>Entregado al cliente</strong>
                                        <small class="d-block text-muted">La carga llegó a su destino final.</small>
                                    </label>
                                </div>
                                <div class="form-check border rounded p-3">
                                    <input class="form-check-input" type="radio" name="accion" value="frontera" id="accion_frontera" required>
                                    <label class="form-check-label" for="accion_frontera">
                                        <i class="bi bi-sign-stop text-warning"></i>
                                        <strong>Llegó a frontera</strong>
                                        <small class="d-block text-muted">La carga espera transbordo a otro(s) camión(es).</small>
                                    </label>
                                </div>
                                <div class="form-check border rounded p-3">
                                    <input class="form-check-input" type="radio" name="accion" value="transbordo" id="accion_transbordo" required>
                                    <label class="form-check-label" for="accion_transbordo">
                                        <i class="bi bi-arrow-down-right text-info"></i>
                                        <strong>Transbordo a otro camión</strong>
                                        <small class="d-block text-muted">La carga se divide y continúa en otros camiones.</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL TRANSBORDO ===== --}}
<div class="modal fade" id="modalTransbordo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-dark">
                <h5 class="modal-title"><i class="bi bi-arrow-down-right"></i> Registrar Transbordo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('tramo.store') }}">
                @csrf
                <input type="hidden" name="contrato_camion_id" id="tsb_cc_id">
                <input type="hidden" name="tramo_padre_id"     id="tsb_padre_id">
                <div class="modal-body">
                    <div class="alert alert-info py-2 mb-3">
                        <i class="bi bi-info-circle"></i>
                        Transbordo desde: <strong id="tsb_info_padre"></strong>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Camión <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="camion_id" id="tsb_camion_id" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($camionesDisponibles as $cam)
                                    <option value="{{ $cam->id }}" data-uuid="{{ $cam->uuid }}">
                                        {{ $cam->placa }} — {{ $cam->marca }} {{ $cam->modelo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Conductor <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="conductor_id" id="tsb_conductor_id" disabled required>
                                <option value="">— Seleccione un camión primero —</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tipo de Tramo <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="tipo_tramo" required>
                                <option value="Nacional" selected>Nacional</option>
                                <option value="Internacional">Internacional</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Destino <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" name="destino" required maxlength="150" placeholder="Ej: LA PAZ"
                                style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Peso que lleva este camión (t) <span class="text-danger">(*)</span></label>
                            <input type="number" step="0.001" min="0.001" class="form-control"
                                name="peso_salida" id="tsb_peso_salida" required placeholder="Toneladas que carga este camión">
                            <small class="text-muted">Disponible para transbordo: <strong id="tsb_peso_disponible"></strong> t</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha de Salida <span class="text-danger">(*)</span></label>
                            <input type="date" class="form-control" name="fecha_salida" id="tsb_fecha_salida" required>
                            <small class="text-muted">No puede ser anterior a la llegada del camión anterior.</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Observaciones</label>
                            <textarea class="form-control" name="observaciones" rows="2" maxlength="500"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info"><i class="bi bi-save"></i> Registrar Transbordo</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL ELIMINAR CAMIÓN ===== --}}
<div class="modal fade" id="modalEliminarCC" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-trash"></i> Quitar Camión</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>¿Quitar el camión <strong id="modal_cc_placa"></strong> del contrato? Se eliminarán también todos sus tramos.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a id="modal_cc_url" href="#" class="btn btn-danger"><i class="bi bi-trash"></i> Sí, quitar</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>

document.addEventListener('DOMContentLoaded', function () {
    // Select2 camión principal — sin dropdownParent para evitar problemas dentro del tab
    $('#cc_camion_id').select2({
        placeholder: 'Busque por placa, marca o modelo...',
        allowClear: true,
        width: '100%',
        language: { noResults: () => 'No se encontró ningún camión.', searching: () => 'Buscando...' }
    });
    $('#cc_camion_id').on('change', function () {
        const opt  = $('#cc_camion_id option:selected');
        const uuid = opt.data('uuid');
        cargarConductores(uuid, 'cc_conductor_id', 'cc_sin_conductores');
    });

    // Select2 camión transbordo
    $('#tsb_camion_id').select2({
        placeholder: 'Busque por placa...',
        width: '100%',
        dropdownParent: $('#modalTransbordo'),
        language: { noResults: () => 'No se encontró ningún camión.', searching: () => 'Buscando...' }
    });
    $('#tsb_camion_id').on('change', function () {
        const opt  = $('#tsb_camion_id option:selected');
        const uuid = opt.data('uuid');
        cargarConductores(uuid, 'tsb_conductor_id', null);
    });

    // Re-inicializar Select2 cuando se abre el tab de agregar
    $('button[data-bs-target="#pane-agregar"]').on('shown.bs.tab', function () {
        $('#cc_camion_id').select2({
            placeholder: 'Busque por placa, marca o modelo...',
            allowClear: true,
            width: '100%',
            language: { noResults: () => 'No se encontró ningún camión.', searching: () => 'Buscando...' }
        });
    });
});

function cargarConductores(uuid, selectId, sinConductoresId) {
    const sel = document.getElementById(selectId);
    const sin = sinConductoresId ? document.getElementById(sinConductoresId) : null;

    sel.innerHTML = '<option value="">— Cargando... —</option>';
    sel.disabled  = true;
    if (sin) sin.classList.add('d-none');

    if (!uuid) {
        sel.innerHTML = '<option value="">— Primero seleccione un camión —</option>';
        return;
    }

    fetch('{{ url("api/camion") }}/' + uuid + '/conductores-relacionados', {
        headers: { 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(conductores => {
        if (conductores.length === 0) {
            sel.innerHTML = '<option value="">— Sin conductores —</option>';
            if (sin) sin.classList.remove('d-none');
            return;
        }
        sel.innerHTML = '<option value="">— Seleccione conductor —</option>';
        conductores.forEach(c => {
            const op = document.createElement('option');
            op.value       = c.id;
            op.textContent = c.nombre + ' — Lic: ' + (c.licencia || 'S/N') + ' [' + c.tipo + ']';
            sel.appendChild(op);
        });
        sel.disabled = false;
    })
    .catch(() => { sel.innerHTML = '<option value="">— Error al cargar —</option>'; });
}

function abrirModalLlegada(tramoUuid, info, pesoSalida, fechaSalida) {
    document.getElementById('llegada_tramo_info').textContent = info;
    document.getElementById('formLlegada').action            = '{{ url("tramo") }}/' + tramoUuid + '/llegada';
    document.getElementById('llegada_peso_max').textContent  = pesoSalida;
    document.querySelectorAll('input[name="accion"]').forEach(r => r.checked = false);

    const inp = document.getElementById('inp_peso_llegada');
    inp.max   = pesoSalida;
    inp.value = '';
    inp.oninput = function () {
        if (parseFloat(this.value) > parseFloat(pesoSalida)) this.value = pesoSalida;
    };

    document.getElementById('inp_fecha_llegada').min   = fechaSalida;
    document.getElementById('inp_fecha_llegada').value = fechaSalida;

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalLlegada')).show();
}

function abrirModalTransbordo(ccId, tramoPadreId, destino, infoPadre, disponible, fechaLlegadaPadre) {
    document.getElementById('tsb_cc_id').value                   = ccId;
    document.getElementById('tsb_padre_id').value                = tramoPadreId;
    document.getElementById('tsb_info_padre').textContent        = infoPadre;
    document.getElementById('tsb_peso_disponible').textContent   = disponible;

    const inp = document.getElementById('tsb_peso_salida');
    inp.max   = disponible;
    inp.value = '';
    inp.oninput = function () {
        if (parseFloat(this.value) > parseFloat(disponible)) this.value = disponible;
    };

    document.getElementById('tsb_fecha_salida').min   = fechaLlegadaPadre ?? '';
    document.getElementById('tsb_fecha_salida').value = fechaLlegadaPadre ?? '';

    const sel = document.getElementById('tsb_conductor_id');
    sel.innerHTML = '<option value="">— Seleccione un camión primero —</option>';
    sel.disabled  = true;

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalTransbordo')).show();
}

function confirmarEliminarCC(uuid, placa) {
    document.getElementById('modal_cc_placa').textContent = placa;
    document.getElementById('modal_cc_url').href = '{{ url("contrato-camion") }}/' + uuid + '/destroy';
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEliminarCC')).show();
}
</script>
@endsection
