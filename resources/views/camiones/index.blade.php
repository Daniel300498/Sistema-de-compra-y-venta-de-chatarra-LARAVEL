@extends('layouts.app')
@section('titulo','Transporte')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>GESTIÓN DE TRANSPORTE</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Transporte</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body pt-3">

                    {{-- ===== SLIDER / TABS ===== --}}
                    <ul class="nav nav-tabs" id="transporteTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-camiones" data-bs-toggle="tab" data-bs-target="#pane-camiones" type="button" role="tab">
                                <i class="bi bi-truck"></i> Camiones
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-operadores" data-bs-toggle="tab" data-bs-target="#pane-operadores" type="button" role="tab">
                                <i class="bi bi-person-workspace"></i> Propietarios / Conductores
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-asignaciones" data-bs-toggle="tab" data-bs-target="#pane-asignaciones" type="button" role="tab">
                                <i class="bi bi-person-check"></i> Asignación de Conductores
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content pt-3" id="transporteTabContent">

                        {{-- ========== TAB CAMIONES ========== --}}
                        <div class="tab-pane fade" id="pane-camiones" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-0">Camiones Registrados</h5>
                                @can('camiones.create')
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCamion" onclick="resetModalCamion()">
                                    <i class="bi bi-plus-lg"></i> Nuevo Camión
                                </button>
                                @endcan
                            </div>
                            <div class="table-responsive">
                                <table id="tablaCamiones" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Placa</th>
                                            <th>Tipo</th>
                                            <th>Marca / Modelo</th>
                                            <th>Año</th>
                                            <th>Cap. (kg)</th>
                                            <th>Color</th>
                                            <th>Propietario</th>
                                            <th>Conductor Actual</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($camiones as $c)
                                        <tr>
                                            <td>{{ $c->placa }}</td>
                                            <td>{{ $c->tipo_vehiculo }}</td>
                                            <td>{{ $c->marca }} {{ $c->modelo }}</td>
                                            <td>{{ $c->anio }}</td>
                                            <td>{{ number_format($c->capacidad_kg, 2) }}</td>
                                            <td>{{ $c->color ?? '-' }}</td>
                                            <td>{{ $c->propietario?->nombre_completo ?? '-' }}</td>
                                            <td>{{ $c->conductorActual?->conductor?->nombre_completo ?? '-' }}</td>
                                            <td>
                                                @if($c->estado === 'Activo')
                                                    <span class="badge bg-success">{{ $c->estado }}</span>
                                                @elseif($c->estado === 'Inactivo')
                                                    <span class="badge bg-danger">{{ $c->estado }}</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">{{ $c->estado }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Opciones</button>
                                                    <ul class="dropdown-menu">
                                                        @can('camiones.edit')
                                                        <li>
                                                            <a class="dropdown-item" href="#" onclick="editarCamion({{ $c }})">
                                                                <i class="bi bi-pencil"></i> Modificar
                                                            </a>
                                                        </li>
                                                        @endcan
                                                        @can('camiones.destroy')
                                                        <li>
                                                            <a class="dropdown-item text-danger" href="{{ route('camiones.destroy', $c->uuid) }}"
                                                                onclick="return confirm('¿Eliminar este camión?')">
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

                        {{-- ========== TAB OPERADORES ========== --}}
                        <div class="tab-pane fade" id="pane-operadores" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-0">Propietarios y Conductores</h5>
                                @can('operadores.create')
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalOperador" onclick="resetModalOperador()">
                                    <i class="bi bi-plus-lg"></i> Nuevo Operador
                                </button>
                                @endcan
                            </div>
                            <div class="table-responsive">
                                <table id="tablaOperadores" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>C.I.</th>
                                            <th>Teléfono</th>
                                            <th>Tipo</th>
                                            <th>Licencia</th>
                                            <th>Categoría</th>
                                            <th>Venc. Licencia</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($operadores as $o)
                                        <tr>
                                            <td>{{ $o->nombre_completo }}</td>
                                            <td>{{ $o->ci }}</td>
                                            <td>{{ $o->telefono ?? '-' }}</td>
                                            <td>
                                                @if($o->tipo_operador === 'ambos')
                                                    <span class="badge bg-primary">Propietario / Chofer</span>
                                                @elseif($o->tipo_operador === 'propietario')
                                                    <span class="badge bg-info text-dark">Propietario</span>
                                                @else
                                                    <span class="badge bg-secondary">Chofer</span>
                                                @endif
                                            </td>
                                            <td>{{ $o->licencia_numero ?? '-' }}</td>
                                            <td>{{ $o->licencia_categoria ?? '-' }}</td>
                                            <td>
                                                @if($o->licencia_vencimiento)
                                                    @if($o->licencia_vencimiento->isPast())
                                                        <span class="text-danger fw-bold">{{ $o->licencia_vencimiento->format('d/m/Y') }} ⚠</span>
                                                    @else
                                                        {{ $o->licencia_vencimiento->format('d/m/Y') }}
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $o->estado === 'Activo' ? 'bg-success' : 'bg-danger' }}">{{ $o->estado }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Opciones</button>
                                                    <ul class="dropdown-menu">
                                                        @can('operadores.edit')
                                                        <li>
                                                            <a class="dropdown-item" href="#" onclick="editarOperador({{ $o }})">
                                                                <i class="bi bi-pencil"></i> Modificar
                                                            </a>
                                                        </li>
                                                        @endcan
                                                        @can('operadores.destroy')
                                                        <li>
                                                            <a class="dropdown-item text-danger" href="{{ route('operadores.destroy', $o->uuid) }}"
                                                                onclick="return confirm('¿Eliminar este operador?')">
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

                        {{-- ========== TAB ASIGNACIONES ========== --}}
                        <div class="tab-pane fade" id="pane-asignaciones" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-0">Asignación de Conductores a Camiones</h5>
                                @can('conductores.create')
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAsignacion">
                                    <i class="bi bi-plus-lg"></i> Nueva Asignación
                                </button>
                                @endcan
                            </div>
                            <div class="table-responsive">
                                <table id="tablaAsignaciones" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Camión</th>
                                            <th>Conductor</th>
                                            <th>Licencia</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Estado</th>
                                            <th>Observaciones</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($asignaciones as $a)
                                        <tr>
                                            <td>{{ $a->camion->placa }} - {{ $a->camion->marca }}</td>
                                            <td>{{ $a->conductor->nombre_completo }}</td>
                                            <td>{{ $a->conductor->licencia_numero }}</td>
                                            <td>{{ $a->fecha_inicio->format('d/m/Y') }}</td>
                                            <td>{{ $a->fecha_fin?->format('d/m/Y') ?? '-' }}</td>
                                            <td>
                                                @if(is_null($a->fecha_fin))
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-secondary">Finalizado</span>
                                                @endif
                                            </td>
                                            <td>{{ $a->observaciones ?? '-' }}</td>
                                            <td class="text-center">
                                                @if(is_null($a->fecha_fin))
                                                    @can('conductores.edit')
                                                    <a href="{{ route('conductores.finalizar', $a->uuid) }}"
                                                        class="btn btn-warning btn-sm"
                                                        onclick="return confirm('¿Finalizar esta asignación?')">
                                                        <i class="bi bi-stop-circle"></i> Finalizar
                                                    </a>
                                                    @endcan
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>{{-- fin tab-content --}}
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== MODAL CAMIÓN ===== --}}
<div class="modal fade" id="modalCamion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-truck"></i> <span id="tituloCamion">Nuevo Camión</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formCamion" method="POST" action="{{ route('camiones.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodCamion" value="POST">
                <div class="modal-body">
                    <p>Los campos con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    <div class="row g-3">

                        {{-- Fila 1: Placa / Tipo / Estado --}}
                        <div class="col-md-4">
                            <label class="form-label">Placa <span class="text-danger">(*)</span></label>
                            <input type="text"
                                class="form-control @error('placa') is-invalid @enderror"
                                name="placa" id="cam_placa"
                                placeholder="Ej: 2345-ABC"
                                onkeyup="this.value=this.value.toUpperCase()"
                                maxlength="10"
                                pattern="[0-9]{4}-[A-Z]{3}"
                                title="Formato: 4 dígitos, guion y 3 letras (ej: 2345-ABC)"
                                required>
                            <small class="text-muted">Formato Bolivia: 2345-ABC</small>
                            @error('placa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tipo Vehículo <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('tipo_vehiculo') is-invalid @enderror" name="tipo_vehiculo" id="cam_tipo" required>
                                <option value="">-- Seleccione --</option>
                                @foreach(['Camión','Volqueta','Trailer','Furgón'] as $tipo)
                                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                                @endforeach
                            </select>
                            @error('tipo_vehiculo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Estado <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('estado') is-invalid @enderror" name="estado" id="cam_estado" required>
                                @foreach(['Activo','Inactivo','En mantenimiento'] as $est)
                                    <option value="{{ $est }}">{{ $est }}</option>
                                @endforeach
                            </select>
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Fila 2: Marca / Modelo / Año --}}
                        <div class="col-md-4">
                            <label class="form-label">Marca <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('marca') is-invalid @enderror" name="marca" id="cam_marca" required>
                                <option value="">-- Seleccione --</option>
                                @foreach(['Volvo','Scania','Mercedes-Benz','Man','DAF','Iveco','Freightliner','Kenworth','Peterbilt','International','Ford','Chevrolet','Toyota','Hino','Isuzu','Faw','Sinotruk','Foton','Shacman','Dongfeng'] as $marca)
                                    <option value="{{ $marca }}">{{ $marca }}</option>
                                @endforeach
                            </select>
                            @error('marca')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Modelo <span class="text-danger">(*)</span></label>
                            <input type="text"
                                class="form-control @error('modelo') is-invalid @enderror"
                                name="modelo" id="cam_modelo"
                                onkeyup="this.value=this.value.toUpperCase()"
                                maxlength="50"
                                placeholder="Ej: FH 460"
                                required>
                            @error('modelo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Año <span class="text-danger">(*)</span></label>
                            <input type="text"
                                class="form-control @error('anio') is-invalid @enderror"
                                name="anio" id="cam_anio"
                                maxlength="4"
                                placeholder="{{ date('Y') }}"
                                inputmode="numeric"
                                autocomplete="off"
                                required>
                            <small id="anio_hint" class="text-muted">Entre 1970 y {{ date('Y') }}</small>
                            @error('anio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Fila 3: Capacidad / Color / Propietario --}}
                        <div class="col-md-4">
                            <label class="form-label">Capacidad (kg) <span class="text-danger">(*)</span></label>
                            <input type="text"
                                class="form-control @error('capacidad_kg') is-invalid @enderror"
                                name="capacidad_kg" id="cam_capacidad"
                                inputmode="decimal"
                                placeholder="Ej: 25.500"
                                autocomplete="off"
                                required>
                            <small id="capacidad_hint" class="text-muted">Entre 10.000 kg y 50.000 kg — 3 decimales con punto.</small>
                            @error('capacidad_kg')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Color</label>
                            <input type="text"
                                class="form-control"
                                name="color" id="cam_color"
                                onkeyup="this.value=this.value.toUpperCase()"
                                maxlength="30"
                                placeholder="Ej: BLANCO">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Propietario</label>
                            <select class="form-select" name="propietario_id" id="cam_propietario">
                                <option value="">-- Sin propietario --</option>
                                @foreach($operadores->whereIn('tipo_operador', ['propietario','ambos']) as $op)
                                    <option value="{{ $op->id }}">{{ $op->nombre_completo }} ({{ $op->ci }})</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCamion">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL OPERADOR ===== --}}
<div class="modal fade" id="modalOperador" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-person-workspace"></i> <span id="tituloOperador">Nuevo Operador</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formOperador" method="POST" action="{{ route('operadores.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodOperador" value="POST">
                <div class="modal-body">
                    <p>Los campos con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nombre <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="op_nombre" onkeyup="this.value=this.value.toUpperCase()" required>
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Apellido <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" id="op_apellido" onkeyup="this.value=this.value.toUpperCase()" required>
                            @error('apellido')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">C.I. <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control @error('ci') is-invalid @enderror" name="ci" id="op_ci" maxlength="20" required>
                            @error('ci')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="op_telefono" maxlength="20">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="op_email">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" id="op_direccion" onkeyup="this.value=this.value.toUpperCase()">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tipo Operador <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('tipo_operador') is-invalid @enderror" name="tipo_operador" id="op_tipo" onchange="toggleLicencia()" required>
                                <option value="propietario">Propietario</option>
                                <option value="chofer">Chofer</option>
                                <option value="ambos">Propietario y Chofer</option>
                            </select>
                            @error('tipo_operador')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Estado <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="estado" id="op_estado">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>

                    {{-- Sección licencia (se muestra/oculta según tipo) --}}
                    <div id="seccionLicencia" class="row g-3 mt-1 border rounded p-2 bg-light" style="display:none!important">
                        <h6 class="text-primary"><i class="bi bi-card-text"></i> Datos de Licencia</h6>
                        <div class="col-md-4">
                            <label class="form-label">N° Licencia <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control @error('licencia_numero') is-invalid @enderror" name="licencia_numero" id="op_licencia_num" maxlength="30">
                            @error('licencia_numero')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Categoría <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('licencia_categoria') is-invalid @enderror" name="licencia_categoria" id="op_licencia_cat">
                                <option value="">-- Seleccione --</option>
                                @foreach(['A','B','C','D','E','F','G'] as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                            @error('licencia_categoria')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Vencimiento <span class="text-danger">(*)</span></label>
                            <input type="date" class="form-control @error('licencia_vencimiento') is-invalid @enderror" name="licencia_vencimiento" id="op_licencia_venc">
                            @error('licencia_vencimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnOperador">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL ASIGNACIÓN CONDUCTOR ===== --}}
<div class="modal fade" id="modalAsignacion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-person-check"></i> Asignar Conductor a Camión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('conductores.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Camión <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('camion_id') is-invalid @enderror" name="camion_id" required>
                                <option value="">-- Seleccione camión --</option>
                                @foreach($camiones as $c)
                                    <option value="{{ $c->id }}">{{ $c->placa }} - {{ $c->marca }} {{ $c->modelo }}</option>
                                @endforeach
                            </select>
                            @error('camion_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Conductor <span class="text-danger">(*)</span></label>
                            <select class="form-select @error('conductor_id') is-invalid @enderror" name="conductor_id" required>
                                <option value="">-- Seleccione conductor --</option>
                                @foreach($choferes as $ch)
                                    <option value="{{ $ch->id }}">{{ $ch->nombre_completo }} — Lic: {{ $ch->licencia_numero }} ({{ $ch->licencia_categoria }})</option>
                                @endforeach
                            </select>
                            @error('conductor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha Inicio <span class="text-danger">(*)</span></label>
                            <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" value="{{ date('Y-m-d') }}" required>
                            @error('fecha_inicio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin">
                            @error('fecha_fin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Observaciones</label>
                            <textarea class="form-control" name="observaciones" rows="2" maxlength="500"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Asignar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>
    // Activar tab correcto al redirigir con parámetro ?tab=
    document.addEventListener('DOMContentLoaded', function () {
        const params = new URLSearchParams(window.location.search);
        const tab = params.get('tab');
        const tabMap = {
            'camiones'    : 'tab-camiones',
            'operadores'  : 'tab-operadores',
            'asignaciones': 'tab-asignaciones',
        };
        const tabId = tabMap[tab] || 'tab-camiones';
        const trigger = document.getElementById(tabId);
        if (trigger) bootstrap.Tab.getOrCreateInstance(trigger).show();

        // Si hay errores de validación, reabrir el modal correspondiente
        @if($errors->has('placa') || $errors->has('tipo_vehiculo') || $errors->has('marca'))
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCamion')).show();
            bootstrap.Tab.getOrCreateInstance(document.getElementById('tab-camiones')).show();
        @endif
        @if($errors->has('nombre') || $errors->has('ci') || $errors->has('tipo_operador'))
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modalOperador')).show();
            bootstrap.Tab.getOrCreateInstance(document.getElementById('tab-operadores')).show();
            toggleLicencia();
        @endif
        @if($errors->has('camion_id') || $errors->has('conductor_id') || $errors->has('fecha_inicio'))
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modalAsignacion')).show();
            bootstrap.Tab.getOrCreateInstance(document.getElementById('tab-asignaciones')).show();
        @endif
    });

    // Mostrar/ocultar sección licencia según tipo operador
    function toggleLicencia() {
        const tipo = document.getElementById('op_tipo').value;
        const seccion = document.getElementById('seccionLicencia');
        if (tipo === 'chofer' || tipo === 'ambos') {
            seccion.style.removeProperty('display');
        } else {
            seccion.style.display = 'none';
        }
    }

    // Validación en tiempo real del año
    document.addEventListener('DOMContentLoaded', function () {
        const anioInput = document.getElementById('cam_anio');
        const anioHint  = document.getElementById('anio_hint');
        const anioMin   = 1970;
        const anioMax   = {{ date('Y') }};

        anioInput.addEventListener('input', function () {
            // Solo permitir dígitos
            this.value = this.value.replace(/[^0-9]/g, '');

            const val = parseInt(this.value);

            if (this.value.length < 4) {
                anioHint.className = 'text-muted';
                anioHint.textContent = 'Entre ' + anioMin + ' y ' + anioMax;
                this.classList.remove('is-invalid', 'is-valid');
                return;
            }

            if (val < anioMin) {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
                anioHint.className = 'text-danger';
                anioHint.textContent = '⚠ El año mínimo es ' + anioMin;
            } else if (val > anioMax) {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
                anioHint.className = 'text-danger';
                anioHint.textContent = '⚠ El año máximo es ' + anioMax;
            } else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                anioHint.className = 'text-success';
                anioHint.textContent = '✓ Año válido';
            }
        });

        // Impedir tipear más de 4 caracteres
        anioInput.addEventListener('keypress', function (e) {
            if (this.value.length >= 4 || !/[0-9]/.test(e.key)) {
                e.preventDefault();
            }
        });

        // Validación en tiempo real de capacidad
        const capInput = document.getElementById('cam_capacidad');
        const capHint  = document.getElementById('capacidad_hint');
        const capMin   = 10;
        const capMax   = 50000;

        capInput.addEventListener('keydown', function (e) {
            // Permitir teclas de control (backspace, delete, flechas, tab)
            const teclaControl = ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Home','End'].includes(e.key);
            if (teclaControl) return;

            // Solo dígitos y punto
            if (!/[0-9.]/.test(e.key)) { e.preventDefault(); return; }

            // Solo un punto
            if (e.key === '.' && this.value.includes('.')) { e.preventDefault(); return; }

            const valorFuturo = this.value + e.key;
            const partes = valorFuturo.split('.');

            // Bloquear si la parte entera supera 50000
            const parteEntera = parseInt(partes[0] || '0');
            if (!this.value.includes('.') && parteEntera > capMax) {
                e.preventDefault();
                return;
            }

            // Bloquear si los decimales ya tienen 3 dígitos
            if (partes[1] !== undefined && partes[1].length >= 3 && e.key !== '.') {
                e.preventDefault();
                return;
            }
        });

        capInput.addEventListener('input', function () {
            // Limpiar caracteres no válidos (por si pegan texto)
            let val = this.value.replace(/[^0-9.]/g, '');
            const partes = val.split('.');
            if (partes.length > 2) val = partes[0] + '.' + partes.slice(1).join('');
            if (partes[1] !== undefined && partes[1].length > 3) {
                val = partes[0] + '.' + partes[1].substring(0, 3);
            }
            // Truncar parte entera si supera el máximo
            if (parseInt(partes[0] || '0') > capMax) {
                val = String(capMax) + (partes[1] !== undefined ? '.' + partes[1] : '');
            }
            this.value = val;

            const num = parseFloat(val);
            if (val === '' || isNaN(num)) {
                this.classList.remove('is-invalid', 'is-valid');
                capHint.className = 'text-muted';
                capHint.textContent = 'Entre 10.000 kg y 50,000 kg — máximo 3 decimales con punto.';
                return;
            }
            if (num < capMin) {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
                capHint.className = 'text-danger';
                capHint.textContent = '⚠ La capacidad mínima es 10 kg.';
            } else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                capHint.className = 'text-success';
                capHint.textContent = '✓ Capacidad válida';
            }
        });
    });

    // Reset y abrir modal camión en modo Nuevo
    function resetModalCamion() {
        document.getElementById('tituloCamion').innerText = 'Nuevo Camión';
        document.getElementById('btnCamion').innerText = 'Registrar';
        document.getElementById('methodCamion').value = 'POST';
        document.getElementById('formCamion').action = '{{ route("camiones.store") }}';
        document.getElementById('formCamion').reset();
    }

    // Llenar modal camión en modo Editar
    function editarCamion(camion) {
        document.getElementById('tituloCamion').innerText = 'Editar Camión';
        document.getElementById('btnCamion').innerText = 'Actualizar';
        document.getElementById('methodCamion').value = 'PUT';
        document.getElementById('formCamion').action = '/camion/' + camion.id;
        document.getElementById('cam_placa').value      = camion.placa;
        document.getElementById('cam_tipo').value       = camion.tipo_vehiculo;
        document.getElementById('cam_marca').value      = camion.marca;
        document.getElementById('cam_modelo').value     = camion.modelo;
        document.getElementById('cam_anio').value       = camion.anio;
        document.getElementById('cam_capacidad').value  = camion.capacidad_kg;
        document.getElementById('cam_color').value      = camion.color ?? '';
        document.getElementById('cam_estado').value     = camion.estado;
        document.getElementById('cam_propietario').value = camion.propietario_id ?? '';
        bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCamion')).show();
    }

    // Reset modal operador
    function resetModalOperador() {
        document.getElementById('tituloOperador').innerText = 'Nuevo Operador';
        document.getElementById('btnOperador').innerText = 'Registrar';
        document.getElementById('methodOperador').value = 'POST';
        document.getElementById('formOperador').action = '{{ route("operadores.store") }}';
        document.getElementById('formOperador').reset();
        document.getElementById('seccionLicencia').style.display = 'none';
    }

    // Llenar modal operador en modo Editar
    function editarOperador(op) {
        document.getElementById('tituloOperador').innerText = 'Editar Operador';
        document.getElementById('btnOperador').innerText = 'Actualizar';
        document.getElementById('methodOperador').value = 'PUT';
        document.getElementById('formOperador').action = '/operador/' + op.id;
        document.getElementById('op_nombre').value   = op.nombre;
        document.getElementById('op_apellido').value = op.apellido;
        document.getElementById('op_ci').value       = op.ci;
        document.getElementById('op_telefono').value = op.telefono ?? '';
        document.getElementById('op_email').value    = op.email ?? '';
        document.getElementById('op_direccion').value= op.direccion ?? '';
        document.getElementById('op_tipo').value     = op.tipo_operador;
        document.getElementById('op_estado').value   = op.estado;
        document.getElementById('op_licencia_num').value  = op.licencia_numero ?? '';
        document.getElementById('op_licencia_cat').value  = op.licencia_categoria ?? '';
        document.getElementById('op_licencia_venc').value = op.licencia_vencimiento ?? '';
        toggleLicencia();
        bootstrap.Modal.getOrCreateInstance(document.getElementById('modalOperador')).show();
    }
</script>
@endsection
