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
                 <input type ="hidden" name="_method" id="methodGasto" value="POST">
                <div class="modal-body">
                    <p>Los campos con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">CONTRATO <strong class="text-danger">(*)</strong></label>
                            <select name="contrato_id" id="contrato" class="form-select" required>
                                <option value="">-- SELECCIONE --</option>
                                @foreach($contratos as $c)
                                    <option value="{{$c->id}}">{{ $c->numero_contrato }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">CUENTA BANCARIA <strong class="text-danger">(*)</strong></label>
                            <select name="cuenta_bancaria_id" id="cuenta_bancaria" class="form-select" required>
                                <option value="">-- SELECCIONE --</option>
                                @foreach($cuentas_banco as $cb)
                                        <option value="{{$cb->id}}">{{ $cb->banco }} - {{ str_repeat('*', max(strlen($cb->numero_cuenta) - 4, 0)) . $cb->numero_cuenta_ultimos }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">CATEGORÍA <strong class="text-danger">(*)</strong></label>
                            <select name="categoria" id="categoria" class="form-select" required>
                                <option value="">-- SELECCIONE --</option>
                                <option value="ADUANERO">ADUANERO</option>
                                <option value="CARGUIO">CARGUIO</option>
                                <option value="DESCARGUIO">DESCARGUIO</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">CONCEPTO <strong class="text-danger">(*)</strong></label>
                            <input type="text" name="concepto" id="concepto" class="form-control" onkeyup="this.value=this.value.toUpperCase();" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">MONTO <strong class="text-danger">(*)</strong></label>
                            <input type="number" step="0.01" name="monto" id="monto" class="form-control" required>
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
                            <label class="form-label">TIPO DE CAMBIO <span id="asterisco_tipo_cambio" class="text-danger d-none">(*)</span></label>
                            <input type="number" step="0.01" name="tipo_cambio" id="tipo_cambio" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">FECHA <strong class="text-danger">(*)</strong></label>
                            <input type="date" name="fecha" id="fecha" class="form-control" required>
                        </div>

                
                        <div class="col-md-6">
                            <label class="form-label">COMPROBANTE</label>
                            <input type="file" name="comprobante_pago" id="comprobante" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnGasto"></i> Registrar</button>
                </div>

            </form>
        </div>
    </div>
</div>