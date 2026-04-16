<div class="modal fade" id="nuevaCiudad" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Agregar Nueva Ciudad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="storeCiudad" role="form">
                <input type="hidden" id="areaIdModal">
                <input type="hidden" id="tipoCargoModal">
                <div class="modal-body">
                    <p>Debe seleccionar el <strong>DEPARTAMENTO</strong> antes de ingresar una nueva ciudad, ya que el campo Provincia depende de ese valor.</p>
                    <input type="hidden" id="nombre_depto">
                    <div class="col-sm-12 mt-2">
                        <label for="provincia" class="col-control-label">Provincia <span class="text-danger">(*)</span></label>
                        <select name="provincia_id" id="provincia_id" class="form-control" required style="width: 100%;">
                            <option value="">-- SELECCIONE --</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="ciudad" class="col-control-label">Nombre</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" id="nombre_ciudad" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reset();">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\chatarra\resources\views/clientes/modals/_modal_ciudad.blade.php ENDPATH**/ ?>