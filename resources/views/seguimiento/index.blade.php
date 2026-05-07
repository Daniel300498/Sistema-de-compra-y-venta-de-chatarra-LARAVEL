@extends('layouts.app')
@section('titulo', 'Seguimiento de Cargas')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>SEGUIMIENTO DE CARGAS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Seguimiento de Cargas</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">

    {{-- Tarjetas resumen --}}
    <div class="row mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div style="font-size:2rem; color:#0d6efd;"><i class="bi bi-truck"></i></div>
                <div class="fw-bold fs-4">{{ $resumen['en_transito'] }}</div>
                <div class="text-muted small">En tránsito</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div style="font-size:2rem; color:#ffc107;"><i class="bi bi-sign-stop"></i></div>
                <div class="fw-bold fs-4">{{ $resumen['en_frontera'] }}</div>
                <div class="text-muted small">En frontera</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div style="font-size:2rem; color:#0dcaf0;"><i class="bi bi-arrow-left-right"></i></div>
                <div class="fw-bold fs-4">{{ $resumen['transbordado'] }}</div>
                <div class="text-muted small">Transbordado</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div style="font-size:2rem; color:#198754;"><i class="bi bi-check-circle"></i></div>
                <div class="fw-bold fs-4">{{ $resumen['entregado'] }}</div>
                <div class="text-muted small">Entregados</div>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="segTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pane-activos" type="button">
                        <i class="bi bi-activity"></i> En curso
                        <span class="badge bg-primary ms-1">{{ $activos->count() }}</span>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-entregados" type="button">
                        <i class="bi bi-check-circle"></i> Entregados
                        <span class="badge bg-success ms-1">{{ $resumen['entregado'] }}</span>
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-3">

                {{-- EN CURSO --}}
                <div class="tab-pane fade show active" id="pane-activos">
                    @if($activos->isEmpty())
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> No hay cargas activas en este momento.
                        </div>
                    @else
                    <div class="table-responsive">
                        <table id="tabla_activos" class="table table-hover table-bordered table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Contrato</th>
                                    <th>Camión</th>
                                    <th>Conductor</th>
                                    <th>Ruta</th>
                                    <th>Tipo</th>
                                    <th>Peso salida</th>
                                    <th>Fecha salida</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activos as $t)
                                @php
                                    $colorMap = [
                                        'En tránsito'  => 'primary',
                                        'En frontera'  => 'warning text-dark',
                                        'Transbordado' => 'info text-dark',
                                    ];
                                    $iconMap = [
                                        'En tránsito'  => 'bi-truck',
                                        'En frontera'  => 'bi-sign-stop',
                                        'Transbordado' => 'bi-arrow-left-right',
                                    ];
                                    $color = $colorMap[$t->estado] ?? 'secondary';
                                    $icon  = $iconMap[$t->estado]  ?? 'bi-circle';
                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ route('contratos.camiones', $t->contratoCamion->contrato->uuid) }}"
                                            class="fw-bold text-primary text-decoration-none">
                                            {{ $t->contratoCamion->contrato->numero_contrato }}
                                        </a>
                                    </td>
                                    <td>
                                        <strong>{{ $t->camion->placa }}</strong>
                                        <small class="text-muted d-block">{{ $t->camion->marca }} {{ $t->camion->modelo }}</small>
                                    </td>
                                    <td>
                                        @if($t->conductor)
                                            {{ $t->conductor->nombre_completo }}
                                            <small class="text-muted d-block">Lic: {{ $t->conductor->licencia_numero ?? '—' }}</small>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted small">{{ $t->origen }}</span>
                                        <i class="bi bi-arrow-right mx-1 text-muted"></i>
                                        <span class="small">{{ $t->destino }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $t->tipo_tramo === 'Internacional' ? 'danger' : 'secondary' }}">
                                            {{ $t->tipo_tramo }}
                                        </span>
                                    </td>
                                    <td class="text-end">{{ number_format($t->peso_salida, 3) }} t</td>
                                    <td>{{ $t->fecha_salida?->format('d/m/Y') ?? '—' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $color }}">
                                            <i class="bi {{ $icon }}"></i> {{ $t->estado }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('contratos.camiones', $t->contratoCamion->contrato->uuid) }}"
                                            class="btn btn-sm btn-outline-secondary" title="Ver contrato">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

                {{-- ENTREGADOS --}}
                <div class="tab-pane fade" id="pane-entregados">
                    @if($entregados->isEmpty())
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> No hay entregas registradas aún.
                        </div>
                    @else
                    <p class="text-muted small"><i class="bi bi-info-circle"></i> Mostrando las últimas 50 entregas.</p>
                    <div class="table-responsive">
                        <table id="tabla_entregados" class="table table-hover table-bordered table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Contrato</th>
                                    <th>Camión</th>
                                    <th>Conductor</th>
                                    <th>Ruta</th>
                                    <th>Tipo</th>
                                    <th>Peso llegada</th>
                                    <th>Fecha entrega</th>
                                    <th>Cliente</th>
                                    <th>Descuento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entregados as $t)
                                <tr>
                                    <td>
                                        <a href="{{ route('contratos.camiones', $t->contratoCamion->contrato->uuid) }}"
                                            class="fw-bold text-primary text-decoration-none">
                                            {{ $t->contratoCamion->contrato->numero_contrato }}
                                        </a>
                                    </td>
                                    <td>
                                        <strong>{{ $t->camion->placa }}</strong>
                                        <small class="text-muted d-block">{{ $t->camion->marca }} {{ $t->camion->modelo }}</small>
                                    </td>
                                    <td>
                                        @if($t->conductor)
                                            {{ $t->conductor->nombre_completo }}
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted small">{{ $t->origen }}</span>
                                        <i class="bi bi-arrow-right mx-1 text-muted"></i>
                                        <span class="small">{{ $t->destino }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $t->tipo_tramo === 'Internacional' ? 'danger' : 'secondary' }}">
                                            {{ $t->tipo_tramo }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <strong class="text-success">{{ number_format($t->peso_llegada, 3) }} t</strong>
                                    </td>
                                    <td>{{ $t->fecha_llegada?->format('d/m/Y') ?? '—' }}</td>
                                    <td>{{ $t->cliente?->nombre ?? '—' }}</td>
                                    <td class="text-center">
                                        @if($t->descuento_porcentaje)
                                            <span class="badge bg-danger">{{ number_format($t->descuento_porcentaje, 1) }}%</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('tramo.nota-entrega', $t->uuid) }}"
                                            class="btn btn-sm btn-outline-success" target="_blank" title="Nota de entrega">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </a>
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
@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('tabla_activos')) {
        $('#tabla_activos').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
            order: [[7, 'asc']],
            pageLength: 25,
        });
    }
    if (document.getElementById('tabla_entregados')) {
        $('#tabla_entregados').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
            order: [[6, 'desc']],
            pageLength: 25,
        });
    }
});
</script>
@endsection
