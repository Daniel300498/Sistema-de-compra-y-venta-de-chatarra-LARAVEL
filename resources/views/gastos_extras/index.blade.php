@extends('layouts.app')
@section('titulo','Gastos Extras')

@section('content')

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>GASTOS EXTRAS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Gastos Extras</li>
                </ol>
            </nav>    
        </div>
        @can('gastos_extras.create')
        <button type="button" class="btn btn-primary MB-3" data-bs-toggle="modal" data-bs-target="#modalGastoExtra" onclick="resetModalGastoExtra()"> <i class="bi bi-plus-lg"></i> Nuevo Gasto Extra</button>
        @endcan
    </button>
    </div>
</div>

<section class="section mt-3">

    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card p-3">
                <small>Total Gastos</small>
                <h4>BOB {{ number_format($total,2) }}</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <small>Aduaneros</small>
                <h4>BOB {{ number_format($aduaneros,2) }}</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <small>Carga/Descarga</small>
                <h4>BOB {{ number_format($carga,2) }}</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <small>Otros</small>
                <h4>BOB {{ number_format($otros,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body pt-3">
             <div class="d-flex justify-content-between align-items-center mb-1">
                    <h5 class="card-title mb-0">Gastos Extras Registrados</h5>
                </div>
             <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle me-1"></i>Registra y administra tus gastos extras por contrato, identificando y registrando los pendientes y los no pendientes de pago</p>
            <div class="table-responsive">
                <table id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Contrato</th>
                            <th>Categoría</th>
                            <th>Concepto</th>
                            <th>Monto</th>
                            <th>T/C</th>
                            <th>Monto en BOB</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gastos as $g)
                        <tr>
                            <td>{{ $g->fecha }}</td>
                            <td>{{ $g->contrato->numero_contrato }}</td>
                            <td><span class="badge bg-primary">{{ $g->categoria }}</span></td>
                            <td>{{ $g->concepto }}</td>
                            <td>{{ $g->moneda }} {{ number_format($g->monto,2) }}</td>
                            <td>{{ $g->tipo_cambio ?? '-' }}</td>
                             <td>{{ $g->monto_bolivianos ?? '-' }}</td>                 
                            <td>
                                @if($g->estado == 'pagado')
                                    <span class="badge bg-success">Pagado</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Opciones</button>
                                    <ul class="dropdown-menu">

                                        <li><a class="dropdown-item" href="#" onclick="editarGasto({{ $g }})"><i class="bi bi-pencil"></i> Modificar</a></li>
                                        @if($g->comprobante_pago)     
                                        <li><a class="dropdown-item" href="#" onclick="window.open('{{ asset('comprobantes_pago/' . $g->comprobante_pago) }}', 'comprobante', 'width=700,height=500,resizable=yes,scrollbars=yes'); return false;"><i class="bi bi-receipt"></i> Ver Comprobante</a></li>   
                                       @else
                                        <li><a class="dropdown-item text-muted"><i class="bi bi-receipt"></i> Sin Comprobante</a></li>   
                                       @endif
                                        @if($g->estado == 'pendiente')
                                        <li><a class="dropdown-item"><i class="bi bi-cash"></i> Marcar Pagado</a></li>
                                        @endif
                                        <li><a class="dropdown-item text-danger" href="{{ route('gastos_extras.destroy', $g->uuid) }}" onclick="return confirm('¿Eliminar este gasto?')">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </a>
                                        </li>
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
</section>
@include('gastos_extras.modal')
@endsection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}"></script>

<script>

window.limpiarFormularioGastoExtra = function () {
    document.getElementById('formGasto').reset();
};

function resetModalGastoExtra(){
    document.getElementById('tituloGasto').innerText = 'Registrar Gasto';
    document.getElementById('btnGasto').innerText = 'Registrar';
    document.getElementById('methodGasto').value = 'POST';
    document.getElementById('formGasto').action ='{{ route("gastos_extras.store") }}';
    limpiarFormularioGastoExtra();
}
function editarGasto(gasto){
    const baseUrl = "{{ url('/') }}";
    document.getElementById('tituloGasto').innerText = 'Editar Gasto';
    document.getElementById('btnGasto').innerText = 'Actualizar';
    document.getElementById('methodGasto').value = 'PUT';
    document.getElementById('formGasto').action = baseUrl + '/gastos_extras/' + gasto.id;
    document.getElementById('categoria').value = gasto.categoria;
    document.getElementById('concepto').value = gasto.concepto;
    document.getElementById('monto').value = gasto.monto;
    document.getElementById('moneda').value = gasto.moneda;
    actualizarTipoCambio();
    document.getElementById('tipo_cambio').value = gasto.tipo_cambio;
    document.getElementById('fecha').value = gasto.fecha;
    document.getElementById('cuenta_bancaria').value = gasto.cuenta_bancaria_id;
    document.getElementById('contrato').value = gasto.contrato_id;
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalGastoExtra')).show();
}

function actualizarTipoCambio() {
    const moneda = document.getElementById('moneda').value;
    const tipoCambio = document.getElementById('tipo_cambio');
    const asterisco = document.getElementById('asterisco_tipo_cambio');

    if (moneda === 'BOB') {
        tipoCambio.value = '';
        tipoCambio.disabled = true;
        tipoCambio.required = false;
        asterisco.classList.add('d-none');
    } else {
        tipoCambio.disabled = false;
        tipoCambio.required = true;
        asterisco.classList.remove('d-none');
    }
}

document.getElementById('moneda').addEventListener('change', actualizarTipoCambio);

document.addEventListener('DOMContentLoaded', function () {
    actualizarTipoCambio();
});

</script>
@endsection