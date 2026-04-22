<div class="modal fade" id="modalCliente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span id="tituloCliente"><i class="bi bi-person"></i> Nuevo Cliente</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formCliente" method="POST" action="{{ route('clientes.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodCliente" value="POST">
                <div class="modal-body">
                    <p>Los campos con <strong class="text-danger">(*)</strong> son obligatorios.</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">NOMBRE / RAZON SOCIAL <strong class="text-danger">(*)</strong></label>
                            <input type="text" class="form-control" name="nombre" id="cli_nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);" required >
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIT / CI <strong class="text-danger">(*)</strong></label>
                            <input type="number" class="form-control" name="nit" id="cli_nit" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 || event.keyCode === 46 ? true : !isNaN(Number(event.key))" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">PAIS<strong class="text-danger">(*)</strong></label>
                            <select class="form-select" class="form-control" name="pais" id="cli_pais" required>
                                <option value="">-- SELECCIONE UN PAIS --</option>
                                @foreach($paises as $pais)
                                    <option value="{{ $pais->descripcion }}">{{ $pais->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">EMAIL</label>
                            <input type="email" class="form-control" name="email" id="cli_email" placeholder="Ej. ejemplo@dominio.com">
                        </div>
                            <div class="col-md-6">
                                <label class="form-label">TELEFONOS</label>
                                <div id="telefonos-container">
                                    <div class="input-group mb-2 telefono-item">
                                        <input type="number" name="telefonos[]" class="form-control telefono-input" placeholder="Ej: 70123456">
                                        <button type="button" class="btn btn-success btn-add-telefono">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Direcciones</label>
                                <div id="direcciones-container">
                                    <div class="input-group mb-2 direccion-item">
                                        <input type="text" name="direcciones[]" class="form-control direccion-input" placeholder="Ej. Av. Siempre Viva 123">
                                        <button type="button" class="btn btn-success btn-add-direccion">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnCliente">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
