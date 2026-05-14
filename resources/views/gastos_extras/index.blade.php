@extends('layouts.app')
@section('titulo','Gastos Extras')

@section('content')
<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>GASTOS EXTRAS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">Gastos Extras</li>
                </ol>
            </nav>
        </div>
        @can('gastos_extras.create')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGastoExtra" onclick="resetModalGastoExtra()"><i class="bi bi-plus-lg"></i>Nuevo Gasto Extra</button>
        @endcan
    </div>
</div>
<section class="section mt-3">
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 rounded-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold">Total Gastos</small>
                        <h4 class="fw-bold mt-2 mb-0">BOB {{ number_format($total,2) }}</h4>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3"><i class="bi bi-cash-stack text-primary fs-3"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 rounded-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold">Pendientes</small>
                        <h4 class="fw-bold mt-2 mb-0">BOB {{ number_format($pendientes,2) }}</h4>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3"><i class="bi bi-hourglass-split text-warning fs-3"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 rounded-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold">Pagados</small>
                        <h4 class="fw-bold mt-2 mb-0">BOB {{ number_format($pagados,2) }}</h4>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-check-circle text-success fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 rounded-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold">Contratos</small>
                        <h4 class="fw-bold mt-2 mb-0">{{ $contratosFiltrados->count() }}</h4>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3"><i class="bi bi-file-earmark-text text-info fs-3"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>
    <div class="card mb-3">
        <div class="card-body pt-3">
            <form method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Filtrar por proveedor</label>
                        <select name="proveedor_id" class="form-select" onchange="this.form.submit()">
                            <option value="">-- TODOS LOS PROVEEDORES --</option>
                            @foreach($proveedores as $p)
                            <option value="{{ $p->id }}"{{ request('proveedor_id') == $p->id ? 'selected' : '' }}>{{ $p->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <p class="text-muted small mb-3">
        <i class="bi bi-info-circle me-1"></i>En esta sección puedes registrar y gestionar gastos adicionales relacionados con tus contratos de compra de chatarra. Estos gastos pueden incluir gastos de transporte, impuestos u otros costos asociados. 
    </p>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title mb-0">Contratos</h5>
                    </div>
                    <p class="text-muted small mb-3"><i class="bi bi-info-circle me-1"></i>Seleccione un contrato para visualizar todos sus gastos extras</p>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Contrato</th>
                                    <th>Total BOB</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contratosFiltrados as $c)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $c->numero_contrato }}</div>
                                        <small class="text-muted">{{ $c->proveedor->nombre ?? '-' }}</small>
                                    </td>
                                    <td><strong>BOB {{ number_format($c->total_gastos,2) }}</strong></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick='verDetalles(@json($c->gastos_detalle), "{{ $c->numero_contrato }}")'><i class="bi bi-eye"></i>Ver Detalles</button>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center text-muted">Sin contratos registrados</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0">Detalle de Gastos</h5>
                            <small id="tituloDetalle" class="text-muted">Seleccione un contrato</small>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Categoría</th>
                                    <th>Concepto</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="detalleGastos">
                                <tr><td colspan="5" class="text-center text-muted">Sin información</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('gastos_extras.modal')
@endsection
@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}"></script>
<script>
function verDetalles(gastos, contrato)
{
    let html = '';
    document.getElementById('tituloDetalle').innerText ='Contrato: ' + contrato;
    if(gastos.length === 0){
        html = `<tr><td colspan="6" class="text-center text-muted">Sin gastos registrados</td></tr>`;
    } else {
        gastos.forEach(g => {
            let estado = '';
            if(g.estado === 'pagado'){
                estado = `<span class="badge bg-success">Pagado</span>`;
            } else {
                estado = `<span class="badge bg-warning text-dark">Pendiente</span>`;
            }
            let comprobante = '';
            if(g.comprobante_pago){
                comprobante = `
                    <li><a class="dropdown-item" href="#" onclick="window.open('/comprobantes_pago/${g.comprobante_pago}','comprobante','width=700,height=500,resizable=yes,scrollbars=yes'); return false;"><i class="bi bi-receipt"></i>Ver Comprobante</a></li>`;
            } else {comprobante = `<li><a class="dropdown-item text-muted"><i class="bi bi-receipt"></i>Sin Comprobante</a></li>`;}
            let marcarPagado = '';
            if(g.estado === 'pendiente'){
                marcarPagado = `<li><a class="dropdown-item"><i class="bi bi-cash"></i>Marcar Pagado</a></li>`;
            }
            html += `
                <tr>
                    <td>${g.fecha.split('T')[0]}</td>
                    <td><span class="badge bg-primary">${g.categoria}</span></td>
                    <td>${g.concepto}</td>
                    <td>${g.moneda} ${parseFloat(g.monto).toFixed(2)}</td>
                    <td>${estado}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown">Opciones</button>
                            <ul class="dropdown-menu">
                                @can('gastos_extras.edit')
                                <li>
                                    <a class="dropdown-item"
                                        href="#"
                                        onclick='editarGasto(${JSON.stringify(g)})'><i class="bi bi-pencil"></i>Modificar</a>
                                </li>
                                @endcan
                                ${comprobante}
                                ${marcarPagado}
                                @can('gastos_extras.destroy')
                                <li>
                                    <form action="/gastos_extras/${g.uuid}" method="POST"
                                        onsubmit="return confirm('¿Eliminar este gasto extra?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash"></i>Eliminar</button>
                                    </form>
                                </li>
                                @endcan
                            </ul>
                        </div>
                    </td>
                </tr>
                `;
        });
    }
    document.getElementById('detalleGastos').innerHTML = html;
}
window.limpiarFormularioGastoExtra = function () {
    document.getElementById('formGasto').reset();
};
function resetModalGastoExtra(){
    document.getElementById('tituloGasto').innerText ='Registrar Gasto';
    document.getElementById('btnGasto').innerText ='Registrar';
    document.getElementById('methodGasto').value ='POST';
    document.getElementById('formGasto').action ='{{ route("gastos_extras.store") }}';
    limpiarFormularioGastoExtra();
}
function editarGasto(gasto){
    const baseUrl = "{{ url('/') }}";
    document.getElementById('tituloGasto').innerText = 'Editar Gasto';
    document.getElementById('btnGasto').innerText = 'Actualizar';
    document.getElementById('methodGasto').value = 'PUT';
    document.getElementById('formGasto').action = baseUrl + '/gastos_extras/' + gasto.id;
    document.getElementById('categoria').classList.remove('d-none');
    document.getElementById('contenedorNuevaCategoria').classList.add('d-none');
    document.getElementById('nueva_categoria').required = false;
    document.getElementById('nueva_categoria').value = '';
    document.getElementById('categoria').value = gasto.categoria;
    document.getElementById('concepto').value = gasto.concepto;
    document.getElementById('monto').value = gasto.monto;
    document.getElementById('moneda').value = gasto.moneda;
    document.getElementById('tipo_cambio').value = gasto.tipo_cambio ?? '';
    actualizarTipoCambio();
    document.getElementById('fecha').value = gasto.fecha.split('T')[0];
    document.getElementById('cuenta_bancaria').value = gasto.cuenta_bancaria_id;
    document.getElementById('contrato').value = gasto.contrato_id;
    if (gasto.estado === 'pagado') {
        document.getElementById('estado_switch').checked = true;
        document.getElementById('estado').value = 'pagado';
        document.getElementById('estado_label').innerText = 'PAGADO';
    } else {
        document.getElementById('estado_switch').checked = false;
        document.getElementById('estado').value = 'pendiente';
        document.getElementById('estado_label').innerText = 'PENDIENTE';
    }
    actualizarEstadoPago();
    document.getElementById('metodo_pago').value = gasto.metodo_pago ?? '';
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalGastoExtra')).show();
}
function actualizarTipoCambio() {   
    const moneda = document.getElementById('moneda').value;
    const tipoCambio = document.getElementById('tipo_cambio');
    const asterisco = document.getElementById('asterisco_tipo_cambio');
    const mensaje = document.getElementById('mensaje_tipo_cambio');

    if (moneda === 'BOB') {
        tipoCambio.value = '';
        tipoCambio.disabled = true;
        tipoCambio.required = false;
        asterisco.classList.add('d-none');
        mensaje.innerText = 'No es necesario ingresar tipo de cambio cuando la moneda es BOB.';
        mensaje.className = 'text-muted';
    } else {
        tipoCambio.disabled = false;
        tipoCambio.required = true;
        asterisco.classList.remove('d-none');
        mensaje.innerText = 'Ingrese el tipo de cambio para convertir el monto a BOB.';
        mensaje.className = 'text-warning';
    }
}
document.getElementById('moneda').addEventListener('change', actualizarTipoCambio);
document.addEventListener('DOMContentLoaded', function () {
    actualizarTipoCambio();
});
</script>
@endsection