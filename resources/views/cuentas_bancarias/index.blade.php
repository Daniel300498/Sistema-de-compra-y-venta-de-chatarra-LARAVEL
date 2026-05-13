@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>CUENTAS BANCARIAS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Cuentas Bancarias</li>
                </ol>
            </nav>
        </div>
        @can('cuentas_bancarias.create')
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCuentaBancaria" onclick="resetModalCuentaBancaria()"><i class="bi bi-plus-lg"></i> Cuentas Bancarias</button>
        @endcan
    </div>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h5 class="card-title mb-0">Cuentas Bancarias Registradas</h5>
                    </div>
                    <p class="text-muted small mb-3"><i class="bi bi-info-circle me-1"></i>
                        Administra tus cuentas bancarias, toma en cuenta que solo las cuentas activas estarán disponibles para seleccionar al registrar un pago.
                    </p>
                    <div class="row g-3">
                    @foreach($cuentas_bancarias as $cb)
                    <div class="col-md-6 col-lg-4">
                        <div class="rounded-4 shadow-sm text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #141c2c, #2f4b7c);border: 1px solid rgba(255, 255, 255, 0.08);">
                            <div class="p-3">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <div class="fw-semibold fs-6">{{ $cb->banco }}</div>
                                        @if($cb->alias)
                                            <div class="small opacity-75"> {{ $cb->alias }}</div>
                                        @endif
                                    </div>
                                    <span class="badge rounded-pill px-3 py-1 {{ $cb->activa ? 'bg-success' : 'bg-danger' }}">{{ $cb->activa ? 'ACTIVA' : 'INACTIVA' }}</span>
                                </div>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="small text-uppercase opacity-50">Cuenta</div>
                                        <div class="fw-semibold"> **** {{ $cb->numero_cuenta_ultimos }}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="small text-uppercase opacity-50">Titular</div>
                                        <div class="fw-semibold text-truncate"> {{ $cb->titular }}</div>
                                    </div>
                                </div>

                                @if($cb->descripcion)
                                <div class="mt-3 pt-2 border-top border-light border-opacity-10">
                                    <div class="small text-uppercase opacity-50">Nota</div>
                                    <div class="small opacity-75">{{ \Illuminate\Support\Str::limit($cb->descripcion, 70) }}</div>
                                </div>
                                @endif
                            </div>

                            <div class="px-3 pb-3 d-flex justify-content-end">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-light dropdown-toggle rounded-pill px-3" data-bs-toggle="dropdown">Opciones</button>
                                    <ul class="dropdown-menu">
                                        @can('cuentas_bancarias.edit')
                                        <li><a class="dropdown-item"href="#"onclick='editarCuentaBancaria(@json($cb))'><i class="bi bi-pencil"></i> Modificar</a></li>
                                        @endcan
                                        @can('cuentas_bancarias.destroy')
                                        <li><a class="dropdown-item text-danger" href="{{ route('cuentas_bancarias.destroy', $cb->uuid) }}" onclick="return confirm('¿Eliminar esta cuenta?')"><i class="bi bi-trash"></i> Eliminar</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('cuentas_bancarias.modal')
@endsection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}"></script>
<script>
window.limpiarFormularioCuentaBancaria = function () {
    document.getElementById('formCuentaBancaria').reset();
};
function resetModalCuentaBancaria() {
    document.getElementById('tituloCuenta').innerHTML ='<i class="bi bi-bank"></i> Registrar Cuenta Bancaria';
    document.getElementById('btnCuenta').innerText = 'Registrar';
    document.getElementById('methodCuenta').value = 'POST';
    document.getElementById('formCuentaBancaria').action ='{{ route("cuentas_bancarias.store") }}';
    limpiarFormularioCuentaBancaria();
}
function editarCuentaBancaria(cuenta_bancaria) {
    const baseUrl = "{{ url('/') }}";
    document.getElementById('tituloCuenta').innerHTML ='<i class="bi bi-pencil-square"></i> Editar Cuenta Bancaria';
    document.getElementById('btnCuenta').innerText = 'Actualizar';
    document.getElementById('methodCuenta').value = 'PUT';
    document.getElementById('formCuentaBancaria').action =baseUrl + '/cuentas_bancarias/' + cuenta_bancaria.id;
    document.getElementById('banco').value = cuenta_bancaria.banco ?? '';
    document.getElementById('numero_cuenta').value = cuenta_bancaria.numero_cuenta ?? '';
    document.getElementById('titular').value = cuenta_bancaria.titular ?? '';
    document.getElementById('alias').value = cuenta_bancaria.alias ?? '';
    document.getElementById('descripcion').value = cuenta_bancaria.descripcion ?? '';
    document.getElementById('activa').checked = !!cuenta_bancaria.activa;

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCuentaBancaria')).show();
}
</script>
@endsection