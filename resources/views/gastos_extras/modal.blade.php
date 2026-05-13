<div class="modal fade" id="modalGastoExtra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <span id="tituloGasto">
                        <i class="bi bi-cash-coin"></i> Registrar Gasto Extra
                    </span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formGasto" method="POST" action="{{ route('gastos_extras.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="methodGasto" value="POST">
                <div class="modal-body">
                    <p>Los campos con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">CONTRATO <strong class="text-danger">(*)</strong></label>
                            <select name="contrato_id" id="contrato" class="form-select" required>
                                <option value="">-- SELECCIONE --</option>
                                @foreach($contratos as $c)
                                    <option value="{{ $c->id }}">{{ $c->numero_contrato }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">CUENTA BANCARIA <strong class="text-danger">(*)</strong></label>
                            <select name="cuenta_bancaria_id" id="cuenta_bancaria" class="form-select" required>
                                <option value="">-- SELECCIONE --</option>
                                @foreach($cuentas_banco as $cb)
                                    @php
                                        $cuenta = $cb->numero_cuenta;
                                        $visibleInicio = substr($cuenta, 0, 2);
                                        $visibleFinal = substr($cuenta, -4);
                                        $ocultos = str_repeat('*', max(strlen($cuenta) - 6, 0));
                                    @endphp

                                    <option value="{{ $cb->id }}">
                                        {{ $cb->banco->nombre }} {{ $visibleInicio . $ocultos . $visibleFinal }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">CATEGORÍA <strong class="text-danger">(*)</strong></label>
                            <select name="categoria" id="categoria" class="form-select" required>
                                <option value="">-- SELECCIONE --</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->descripcion }}">{{ $cat->descripcion }}</option>
                                @endforeach
                                <option value="OTRO">OTRO</option>
                            </select>
                            <div id="contenedorNuevaCategoria" class="d-none mt-2">
                                <div class="input-group">
                                    <input type="text" name="nueva_categoria" id="nueva_categoria" class="form-control" placeholder="ESCRIBA LA NUEVA CATEGORÍA" onkeyup="this.value=this.value.toUpperCase();">
                                    <button type="button" class="btn btn-secondary" id="volverCategoria"><i class="bi bi-arrow-left"></i></button>
                                </div>
                                <small id="mensaje_categoria" class="text-muted">Escriba una categoría nueva. Si ya existe, se usará la existente.</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">CONCEPTO <strong class="text-danger">(*)</strong></label>
                            <input type="text" name="concepto" id="concepto" class="form-control" onkeyup="this.value=this.value.toUpperCase();" required>
                            <small id="mensaje_concepto" class="text-muted">Mínimo 3 caracteres.</small>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">MONTO <strong class="text-danger">(*)</strong></label>
                            <input type="number" step="0.01" min="0.01" name="monto" id="monto" class="form-control" required>
                            <small id="mensaje_monto" class="text-muted">Ingrese un monto mayor a 0.</small>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">MONEDA <strong class="text-danger">(*)</strong></label>
                            <select name="moneda" id="moneda" class="form-select" required>
                                <option value="BOB">BOB</option>
                                <option value="USD">USD</option>
                                <option value="BRL">BRL</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">TIPO DE CAMBIO<span id="asterisco_tipo_cambio" class="text-danger d-none">(*)</span></label>
                            <input type="number" step="0.01" min="0.01" name="tipo_cambio" id="tipo_cambio" class="form-control">
                            <small id="mensaje_tipo_cambio" class="text-muted">No es necesario cuando la moneda es BOB.</small>
                        </div>
                       <div class="col-md-6">
                            <label class="form-label">FECHA <strong class="text-danger">(*)</strong></label>
                            <input type="date" name="fecha" id="fecha" class="form-control"value="{{ date('Y-m-d') }}"required>
                            <small id="mensaje_fecha" class="text-muted">Seleccione la fecha del gasto.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label d-block">ESTADO DEL PAGO <strong class="text-danger">(*)</strong></label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="estado_switch"checked>
                                <label class="form-check-label fw-bold" id="estado_label" for="estado_switch">PAGADO</label>
                            </div>

                            <input type="hidden" name="estado" id="estado" value="pagado">
                            <small id="mensaje_estado" class="text-success">Está marcando este gasto como PAGADO.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">MÉTODO DE PAGO<span id="asterisco_metodo_pago" class="text-danger">(*)</span></label>
                            <select name="metodo_pago" id="metodo_pago" class="form-select" required>
                                <option value="">-- SELECCIONE --</option>
                                <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                <option value="QR">QR</option>
                            </select>
                            <small id="mensaje_metodo_pago" class="text-muted">Seleccione cómo se realizó el pago.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">COMPROBANTE<span id="asterisco_comprobante" class="text-danger d-none">(*)</span></label>
                            <input type="file" name="comprobante_pago" id="comprobante" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                            <small id="mensaje_comprobante" class="text-muted">Puede subir imagen o PDF del comprobante.</small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnGasto">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const categoria = document.getElementById('categoria');
const contenedorNueva = document.getElementById('contenedorNuevaCategoria');
const nuevaCategoria = document.getElementById('nueva_categoria');
const volverCategoria = document.getElementById('volverCategoria');
const estadoSwitch = document.getElementById('estado_switch');
const estadoInput = document.getElementById('estado');
const estadoLabel = document.getElementById('estado_label');
const mensajeEstado = document.getElementById('mensaje_estado');
const metodoPago = document.getElementById('metodo_pago');
const mensajeMetodoPago = document.getElementById('mensaje_metodo_pago');
const asteriscoMetodoPago = document.getElementById('asterisco_metodo_pago');
const comprobante = document.getElementById('comprobante');
const mensajeComprobante = document.getElementById('mensaje_comprobante');
const monto = document.getElementById('monto');
const moneda = document.getElementById('moneda');
const tipoCambioInput = document.getElementById('tipo_cambio');
const mensajeTipoCambio = document.getElementById('mensaje_tipo_cambio');
const asteriscoTipoCambio = document.getElementById('asterisco_tipo_cambio');
const concepto = document.getElementById('concepto');
const mensajeConcepto = document.getElementById('mensaje_concepto');
const fecha = document.getElementById('fecha');
const mensajeFecha = document.getElementById('mensaje_fecha');
const mensajeMonto = document.getElementById('mensaje_monto');

categoria.addEventListener('change', function () {
    if (this.value === 'OTRO') {
        categoria.classList.add('d-none');
        contenedorNueva.classList.remove('d-none');
        nuevaCategoria.required = true;
        nuevaCategoria.focus();
    }
});

volverCategoria.addEventListener('click', function () {
    categoria.classList.remove('d-none');
    contenedorNueva.classList.add('d-none');
    categoria.value = '';
    nuevaCategoria.value = '';
    nuevaCategoria.required = false;
});

function actualizarEstadoPago() {
    if (estadoSwitch.checked) {
        estadoInput.value = 'pagado';
        estadoLabel.innerText = 'PAGADO';
        mensajeEstado.innerText = 'Está marcando este gasto como PAGADO.';
        mensajeEstado.className = 'text-success';
        metodoPago.required = true;
        metodoPago.disabled = false;
        asteriscoMetodoPago.classList.remove('d-none');
    } else {
        estadoInput.value = 'pendiente';
        estadoLabel.innerText = 'PENDIENTE';
        mensajeEstado.innerText = 'Está marcando este gasto como NO PAGADO / PENDIENTE.';
        mensajeEstado.className = 'text-warning';
        metodoPago.required = false;
        metodoPago.value = '';
        metodoPago.disabled = true;
        asteriscoMetodoPago.classList.add('d-none');
        mensajeMetodoPago.innerText = 'El método de pago no es obligatorio si está pendiente.';
        mensajeMetodoPago.className = 'text-muted';
    }
}

function actualizarTipoCambio() {
    const monedaValor = moneda.value;
    const montoValor = parseFloat(monto.value) || 0;
    const tipoCambioValor = parseFloat(tipoCambioInput.value) || 0;

    if (monedaValor === 'BOB') {
        tipoCambioInput.value = '';
        tipoCambioInput.disabled = true;
        tipoCambioInput.required = false;
        asteriscoTipoCambio.classList.add('d-none');
        mensajeTipoCambio.innerText ='No es necesario ingresar tipo de cambio cuando la moneda es BOB.';
        mensajeTipoCambio.className = 'text-muted';
        return;
    }
    tipoCambioInput.disabled = false;
    tipoCambioInput.required = true;
    asteriscoTipoCambio.classList.remove('d-none');
    if (montoValor > 0 && tipoCambioValor > 0) {
        const totalBob = montoValor * tipoCambioValor;
        mensajeTipoCambio.innerHTML =`${montoValor.toFixed(2)} ${monedaValor}= <strong>${totalBob.toFixed(2)} BOB</strong>`;
        mensajeTipoCambio.className = 'text-success';
    } else {
        mensajeTipoCambio.innerText ='Ingrese el monto y el tipo de cambio para calcular el equivalente en BOB.';
        mensajeTipoCambio.className = 'text-warning';
    }
}
estadoSwitch.addEventListener('change', actualizarEstadoPago);
metodoPago.addEventListener('change', function () {
    if (estadoInput.value === 'pagado' && this.value === '') {
        mensajeMetodoPago.innerText = 'Debe seleccionar un método de pago si el gasto está pagado.';
        mensajeMetodoPago.className = 'text-danger';
    } else if (this.value !== '') {
        mensajeMetodoPago.innerText = 'Método de pago seleccionado correctamente.';
        mensajeMetodoPago.className = 'text-success';
    } else {
        mensajeMetodoPago.innerText = 'El método de pago no es obligatorio si está pendiente.';
        mensajeMetodoPago.className = 'text-muted';
    }
});

monto.addEventListener('input', function () {
    actualizarTipoCambio();
    if (parseFloat(this.value) <= 0 || this.value === '') {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        mensajeMonto.innerText = 'El monto debe ser mayor a 0.';
        mensajeMonto.className = 'text-danger';
    } else {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
        mensajeMonto.innerText = 'Monto válido.';
        mensajeMonto.className = 'text-success';
    }
});

moneda.addEventListener('change', actualizarTipoCambio);
tipoCambioInput.addEventListener('input', actualizarTipoCambio);

concepto.addEventListener('input', function () {
    if (this.value.trim().length < 3) {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        mensajeConcepto.innerText = 'El concepto debe tener mínimo 3 caracteres.';
        mensajeConcepto.className = 'text-danger';
    } else {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
        mensajeConcepto.innerText = 'Concepto válido.';
        mensajeConcepto.className = 'text-success';
    }
});

fecha.addEventListener('change', function () {
    if (this.value === '') {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        mensajeFecha.innerText = 'Debe seleccionar una fecha.';
        mensajeFecha.className = 'text-danger';
    } else {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
        mensajeFecha.innerText = 'Fecha válida.';
        mensajeFecha.className = 'text-success';
    }
});

comprobante.addEventListener('change', function () {
    const archivo = this.files[0];
    if (!archivo) {
        mensajeComprobante.innerText = 'Puede subir imagen o PDF del comprobante.';
        mensajeComprobante.className = 'text-muted';
        return;
    }

    const extensionesPermitidas = ['jpg', 'jpeg', 'png', 'pdf'];
    const extension = archivo.name.split('.').pop().toLowerCase();
    if (!extensionesPermitidas.includes(extension)) {
        this.value = '';
        mensajeComprobante.innerText = 'Formato no permitido. Solo JPG, PNG o PDF.';
        mensajeComprobante.className = 'text-danger';
        return;
    }
    if (archivo.size > 2 * 1024 * 1024) {
        this.value = '';
        mensajeComprobante.innerText = 'El comprobante no debe superar los 2MB.';
        mensajeComprobante.className = 'text-danger';
        return;
    }

    mensajeComprobante.innerText = 'Comprobante válido.';
    mensajeComprobante.className = 'text-success';
});

document.addEventListener('DOMContentLoaded', function () {
    actualizarEstadoPago();
    actualizarTipoCambio();
});
</script>