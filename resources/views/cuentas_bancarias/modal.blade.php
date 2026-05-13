<div class="modal fade" id="modalCuentaBancaria" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span id="tituloCuenta">
                        <i class="bi bi-bank"></i> Registrar Cuenta de Banco
                    </span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formCuentaBancaria" method="POST" action="{{ route('cuentas_bancarias.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodCuenta" value="POST">
                <div class="modal-body">
                    <p>Los campos con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">BANCO <span class="text-danger">*</span></label>
                            <select class="form-select" name="banco" id="banco" required>
                                <option value="">-- SELECCIONE EL BANCO --</option>
                                @foreach($bancos as $banco)
                                    <option value="{{ $banco->descripcion }}">{{ $banco->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alias</label>
                            <input type="text" class="form-control" name="alias" id="alias" placeholder="Ej: OPERACIONES" onkeyup="this.value=this.value.toUpperCase();">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Número de cuenta <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="numero_cuenta" id="numero_cuenta"required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Titular <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="titular" id="titular" onkeyup="this.value=this.value.toUpperCase();" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" placeholder="Descripción o detalle adicional de la cuenta"></textarea>
                        </div>
8
                        <div class="col-md-4 d-flex align-items-end">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="activa" name="activa"  checked>
                                <label class="form-check-label" for="activa">Cuenta activa</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCuenta">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>