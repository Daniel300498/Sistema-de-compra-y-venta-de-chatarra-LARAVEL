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
                    <li class="breadcrumb-item active">Camiones</li>
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

        {{-- ===== COLUMNA IZQUIERDA: info contrato + progress ===== --}}
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

                    {{-- Progress bar de toneladas --}}
                    @if($contrato->toneladas_contrato)
                        @php
                            $asignadas   = $contrato->toneladas_asignadas;
                            $total       = (float) $contrato->toneladas_contrato;
                            $porcentaje  = $contrato->porcentaje_toneladas;
                            $disponibles = max(0, $total - $asignadas);
                            $colorBar    = $porcentaje >= 100 ? 'bg-success' : ($porcentaje >= 75 ? 'bg-warning' : 'bg-primary');
                        @endphp
                        <hr>
                        <h6 class="fw-bold">Toneladas del Contrato</h6>
                        <div class="d-flex justify-content-between mb-1">
                            <small>Entregadas: <strong>{{ number_format($contrato->toneladas_entregadas, 3) }} t</strong></small>
                            <small>Total: <strong>{{ number_format($total, 3) }} t</strong></small>
                        </div>
                        <div class="progress" style="height: 22px;">
                            <div class="progress-bar {{ $colorBar }} progress-bar-striped"
                                role="progressbar"
                                style="width: {{ $porcentaje }}%"
                                aria-valuenow="{{ $porcentaje }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                                {{ $porcentaje }}%
                            </div>
                        </div>
                        <div class="mt-2 d-flex justify-content-between">
                            @if($porcentaje >= 100)
                                <span class="badge bg-success w-100 text-center py-2">✓ Contrato completado</span>
                            @else
                                <small class="text-muted">Disponibles: <strong>{{ number_format($disponibles, 3) }} t</strong></small>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-warning py-2 mt-2">
                            <small><i class="bi bi-exclamation-triangle"></i> Sin toneladas definidas en el contrato.</small>
                        </div>
                    @endif

                    {{-- Resumen de entregas --}}
                    @if($contrato->contratoCamiones->isNotEmpty())
                        @php
                            $tEntregadas = $contrato->contratoCamiones->where('estado_entrega','Entregado')->sum('toneladas');
                            $tPendientes = $contrato->contratoCamiones->where('estado_entrega','Pendiente')->sum('toneladas');
                        @endphp
                        <hr>
                        <h6 class="fw-bold">Estado de Entregas</h6>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="badge bg-success py-2 px-3">
                                <i class="bi bi-check-circle"></i> Entregado<br>
                                <strong>{{ number_format($tEntregadas, 3) }} t</strong>
                            </span>
                            <span class="badge bg-warning text-dark py-2 px-3">
                                <i class="bi bi-clock"></i> Pendiente<br>
                                <strong>{{ number_format($tPendientes, 3) }} t</strong>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ===== COLUMNA DERECHA: tabs camiones ===== --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-tabs" id="camionesTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pane-lista" type="button">
                                <i class="bi bi-truck"></i> Camiones Asignados
                                <span class="badge bg-primary ms-1">{{ $contrato->contratoCamiones->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-agregar" type="button">
                                <i class="bi bi-plus-circle"></i> Agregar Camión
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content pt-3">

                        {{-- Lista de camiones asignados --}}
                        <div class="tab-pane fade show active" id="pane-lista">
                            @if($contrato->contratoCamiones->isEmpty())
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i> No hay camiones asignados a este contrato aún.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>Placa</th>
                                                <th>Marca / Modelo</th>
                                                <th>Conductor</th>
                                                <th class="text-end">Toneladas</th>
                                                <th class="text-center">Entrega</th>
                                                <th>Observaciones</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($contrato->contratoCamiones as $cc)
                                            <tr>
                                                <td class="fw-bold">{{ $cc->camion->placa }}</td>
                                                <td>{{ $cc->camion->marca }} {{ $cc->camion->modelo }}</td>
                                                <td>
                                                    @if($cc->conductor)
                                                        {{ $cc->conductor->nombre_completo }}
                                                        <small class="text-muted d-block">Lic: {{ $cc->conductor->licencia_numero }}</small>
                                                    @elseif($cc->camion->conductorActual?->conductor)
                                                        <span class="text-muted">{{ $cc->camion->conductorActual->conductor->nombre_completo }}</span>
                                                        <small class="badge bg-light text-dark">actual</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="text-end fw-bold text-primary">{{ number_format($cc->toneladas, 3) }} t</td>
                                                <td class="text-center">
                                                    @can('contratos.edit')
                                                    <a href="{{ route('contrato-camion.toggle-entrega', $cc->uuid) }}"
                                                       class="badge text-decoration-none {{ $cc->estado_entrega === 'Entregado' ? 'bg-success' : 'bg-warning text-dark' }}"
                                                       title="Clic para cambiar estado"
                                                       onclick="return confirm('¿Cambiar estado a {{ $cc->estado_entrega === 'Entregado' ? 'Pendiente' : 'Entregado' }}?')">
                                                        <i class="bi {{ $cc->estado_entrega === 'Entregado' ? 'bi-check-circle' : 'bi-clock' }}"></i>
                                                        {{ $cc->estado_entrega }}
                                                    </a>
                                                    @else
                                                    <span class="badge {{ $cc->estado_entrega === 'Entregado' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                        <i class="bi {{ $cc->estado_entrega === 'Entregado' ? 'bi-check-circle' : 'bi-clock' }}"></i>
                                                        {{ $cc->estado_entrega }}
                                                    </span>
                                                    @endcan
                                                </td>
                                                <td><small>{{ $cc->observaciones ?? '-' }}</small></td>
                                                <td class="text-center">
                                                    <a href="{{ route('contrato-camion.destroy', $cc->uuid) }}"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('¿Quitar este camión del contrato?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-light fw-bold">
                                                <td colspan="3" class="text-end">Total asignado:</td>
                                                <td class="text-end text-primary">{{ number_format($contrato->toneladas_asignadas, 3) }} t</td>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @endif
                        </div>

                        {{-- Formulario agregar camión --}}
                        <div class="tab-pane fade" id="pane-agregar">
                            @if(!$contrato->toneladas_contrato)
                                <div class="alert alert-warning">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    El contrato no tiene toneladas definidas. Edita el contrato primero para establecer el total de toneladas.
                                </div>
                            @endif

                            <form method="POST" action="{{ route('contrato-camion.store') }}">
                                @csrf
                                <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
                                <div class="row g-3">

                                    <div class="col-md-12">
                                        <label class="form-label">Camión <span class="text-danger">(*)</span></label>
                                        <select class="form-select @error('camion_id') is-invalid @enderror"
                                            name="camion_id" id="cc_camion_id"
                                            onchange="cargarConductoresPorCamion(this)" required>
                                            <option value="">-- Seleccione camión disponible --</option>
                                            @foreach($camionesDisponibles as $cam)
                                                <option value="{{ $cam->id }}" data-uuid="{{ $cam->uuid }}">
                                                    {{ $cam->placa }} — {{ $cam->marca }} {{ $cam->modelo }}
                                                    ({{ number_format($cam->capacidad_kg, 0) }} kg)
                                                    @if($cam->conductorActual?->conductor)
                                                        | Conductor: {{ $cam->conductorActual->conductor->nombre_completo }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('camion_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Toneladas asignadas <span class="text-danger">(*)</span></label>
                                        <input type="number" step="0.001"
                                            class="form-control @error('toneladas') is-invalid @enderror"
                                            name="toneladas" id="inp_toneladas"
                                            min="0.001"
                                            @if($contrato->toneladas_contrato)
                                                max="{{ $contrato->toneladas_contrato - $contrato->toneladas_asignadas }}"
                                                placeholder="Máx: {{ number_format($contrato->toneladas_contrato - $contrato->toneladas_asignadas, 3) }} t"
                                            @else
                                                placeholder="Ej: 15.500"
                                            @endif
                                            required>
                                        @if($contrato->toneladas_contrato)
                                            <small class="text-muted">
                                                Disponibles: <strong>{{ number_format($contrato->toneladas_contrato - $contrato->toneladas_asignadas, 3) }} t</strong>
                                            </small>
                                        @endif
                                        @error('toneladas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Conductor específico (opcional)</label>
                                        <select class="form-select" name="conductor_id" id="cc_conductor_id" disabled>
                                            <option value="">— Primero seleccione un camión —</option>
                                        </select>
                                        <div id="cc_conductor_hint" class="form-text text-muted d-none">
                                            <i class="bi bi-info-circle"></i>
                                            Se muestran el propietario (si conduce) y conductores con asignación activa en este camión.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Estado de Entrega <span class="text-danger">(*)</span></label>
                                        <select class="form-select @error('estado_entrega') is-invalid @enderror" name="estado_entrega" required>
                                            <option value="Pendiente" selected>Pendiente</option>
                                            <option value="Entregado">Entregado</option>
                                        </select>
                                        @error('estado_entrega')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Observaciones</label>
                                        <textarea class="form-control" name="observaciones" rows="2" maxlength="500"
                                            placeholder="Notas sobre la asignación de este camión..."></textarea>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-plus-lg"></i> Agregar Camión al Contrato
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>
    // Si hay errores abrir tab de agregar
    @if($errors->has('camion_id') || $errors->has('toneladas'))
        document.addEventListener('DOMContentLoaded', function () {
            bootstrap.Tab.getOrCreateInstance(document.querySelector('[data-bs-target="#pane-agregar"]')).show();
        });
    @endif

    function cargarConductoresPorCamion(select) {
        const option = select.options[select.selectedIndex];
        const uuid   = option ? option.dataset.uuid : null;
        const selectConductor = document.getElementById('cc_conductor_id');
        const hint            = document.getElementById('cc_conductor_hint');

        selectConductor.innerHTML = '<option value="">— Cargando... —</option>';
        selectConductor.disabled  = true;
        hint.classList.add('d-none');

        if (!uuid) {
            selectConductor.innerHTML = '<option value="">— Primero seleccione un camión —</option>';
            return;
        }

        fetch('{{ url("api/camion") }}/' + uuid + '/conductores-relacionados', {
            headers: { 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(conductores => {
            selectConductor.innerHTML = '<option value="">— Usar conductor actual del camión —</option>';

            if (conductores.length === 0) {
                selectConductor.disabled = true;
                hint.classList.add('d-none');
                return;
            }

            conductores.forEach(function(c) {
                const op = document.createElement('option');
                op.value       = c.id;
                op.textContent = c.nombre + ' — Lic: ' + (c.licencia || 'S/N') + ' [' + c.tipo + ']';
                selectConductor.appendChild(op);
            });

            selectConductor.disabled = false;
            hint.classList.remove('d-none');
        })
        .catch(() => {
            selectConductor.innerHTML = '<option value="">— Error al cargar conductores —</option>';
            selectConductor.disabled = true;
        });
    }
</script>
@endsection
