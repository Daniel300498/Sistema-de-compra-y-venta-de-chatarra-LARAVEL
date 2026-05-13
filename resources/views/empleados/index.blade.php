@extends('layouts.app')
@section('titulo', 'Empleados')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>EMPLEADOS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Empleados</li>
                </ol>
            </nav>
        </div>
        <div>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEmpleado" onclick="resetModal()">
                <i class="bi bi-plus-lg"></i> Nuevo Empleado
            </button>
        </div>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Empleados Registrados</h5>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Registro del personal de la empresa. Los empleados pueden estar asociados a cuentas de usuario del sistema.
                    </p>

                    @if($empleados->isEmpty())
                        <div class="alert alert-info py-2">
                            <small><i class="bi bi-info-circle"></i> No hay empleados registrados.</small>
                        </div>
                    @else
                    <div class="table-responsive">
                        <table id="tabla_empleados" class="table table-hover table-bordered table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Apellido y Nombre</th>
                                    <th>C.I.</th>
                                    <th>Cargo</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($empleados as $i => $emp)
                                <tr class="{{ $emp->activo ? '' : 'table-secondary text-muted' }}">
                                    <td>{{ $i + 1 }}</td>
                                    <td>
                                        <strong>{{ $emp->apellido }}</strong>, {{ $emp->nombre }}
                                    </td>
                                    <td>{{ $emp->ci ?? '—' }}</td>
                                    <td>{{ $emp->cargo ?? '—' }}</td>
                                    <td>{{ $emp->telefono ?? '—' }}</td>
                                    <td>{{ $emp->email ?? '—' }}</td>
                                    <td>
                                        @if($emp->activo)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-secondary">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <button class="btn btn-sm btn-outline-secondary"
                                                title="Editar"
                                                onclick="editarEmpleado(
                                                    '{{ $emp->uuid }}',
                                                    '{{ addslashes($emp->nombre) }}',
                                                    '{{ addslashes($emp->apellido) }}',
                                                    '{{ addslashes($emp->ci ?? '') }}',
                                                    '{{ addslashes($emp->cargo ?? '') }}',
                                                    '{{ addslashes($emp->telefono ?? '') }}',
                                                    '{{ addslashes($emp->email ?? '') }}'
                                                )">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <a href="{{ route('empleados.toggle', $emp->uuid) }}"
                                                class="btn btn-sm {{ $emp->activo ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                                title="{{ $emp->activo ? 'Desactivar' : 'Activar' }}"
                                                onclick="return confirm('¿{{ $emp->activo ? 'Desactivar' : 'Activar' }} a {{ $emp->nombre }} {{ $emp->apellido }}?')">
                                                <i class="bi {{ $emp->activo ? 'bi-toggle-on' : 'bi-toggle-off' }}"></i>
                                            </a>
                                            <a href="{{ route('empleados.destroy', $emp->uuid) }}"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar a {{ $emp->nombre }} {{ $emp->apellido }}? Esta acción no se puede deshacer.')">
                                                <i class="bi bi-trash"></i>
                                            </a>
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

{{-- ===== MODAL EMPLEADO ===== --}}
<div class="modal fade" id="modalEmpleado" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-person-badge"></i> <span id="tituloEmpleado">Nuevo Empleado</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEmpleado" method="POST" action="{{ route('empleados.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodEmpleado" value="POST">
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nombre <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" name="nombre" id="emp_nombre" required maxlength="100"
                                placeholder="Ej: MARÍA" style="text-transform:uppercase"
                                oninput="this.value=this.value.toUpperCase()">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Apellido <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" name="apellido" id="emp_apellido" required maxlength="100"
                                placeholder="Ej: FLORES" style="text-transform:uppercase"
                                oninput="this.value=this.value.toUpperCase()">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">C.I. / Documento <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" name="ci" id="emp_ci" maxlength="20"
                                placeholder="Ej: 12345678" required>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">Cargo <span class="text-danger">(*)</span></label>
                            <select class="form-select" name="cargo" id="emp_cargo" required>
                                <option value="">-- Seleccione un cargo --</option>
                                <option value="Dueño">Dueño</option>
                                <option value="Gerente General">Gerente General</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Contador">Contador</option>
                                <option value="Facturación">Facturación</option>
                                <option value="Operador Logístico">Operador Logístico</option>
                                <option value="Almacenero">Almacenero</option>
                                <option value="Cajero">Cajero</option>
                                <option value="Asistente">Asistente</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="emp_telefono" maxlength="20"
                                placeholder="Ej: +591 70000000">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="email" id="emp_email" maxlength="150"
                                placeholder="ejemplo@correo.com">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnEmpleado">
                        <i class="bi bi-save"></i> Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>
function resetModal() {
    document.getElementById('tituloEmpleado').textContent = 'Nuevo Empleado';
    document.getElementById('btnEmpleado').innerHTML      = '<i class="bi bi-save"></i> Registrar';
    document.getElementById('methodEmpleado').value       = 'POST';
    document.getElementById('formEmpleado').action        = '{{ route("empleados.store") }}';
    document.getElementById('emp_nombre').value           = '';
    document.getElementById('emp_apellido').value         = '';
    document.getElementById('emp_ci').value               = '';
    document.getElementById('emp_cargo').value            = '';
    document.getElementById('emp_telefono').value         = '';
    document.getElementById('emp_email').value            = '';
}

function editarEmpleado(uuid, nombre, apellido, ci, cargo, telefono, email) {
    document.getElementById('tituloEmpleado').textContent = 'Editar Empleado';
    document.getElementById('btnEmpleado').innerHTML      = '<i class="bi bi-save"></i> Actualizar';
    document.getElementById('methodEmpleado').value       = 'PUT';
    document.getElementById('formEmpleado').action        = '/empleados/' + uuid;
    document.getElementById('emp_nombre').value           = nombre;
    document.getElementById('emp_apellido').value         = apellido;
    document.getElementById('emp_ci').value               = ci;
    document.getElementById('emp_cargo').value            = cargo || '';
    document.getElementById('emp_telefono').value         = telefono;
    document.getElementById('emp_email').value            = email;
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEmpleado')).show();
}
</script>
@endsection
