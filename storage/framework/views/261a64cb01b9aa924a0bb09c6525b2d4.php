
  <div class="modal fade" id="formFeriado" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="storeferiado" role="form">
                <div class="modal-body">
                    <p>Debe completar todos los campos</p>
                      <div class="form-group">
                          <input type="hidden" name="id" id="id">
                          <label for="nombre" class="col-sm-12 col-md-4 control-label">Descripción <span class="text-danger">(*)</span> </label>
                          <div class="col-sm-12 col-md-12">
                            <input type="text" name="nombre" id="nombre" class="form-control" required onkeyup"javascript:this.value=this.value.toUpperCase();">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="fecha" class="col-sm-12 col-md-4 control-label">Fecha <span class="text-danger">(*)</span></label>
                          <div class="col-sm-12 col-md-8">
                              <input type="date" name="fecha" id="fecha" class="form-control" required>
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="anual" class="control-label col-sm-4">Tipo <span class="text-danger">(*)</span></label>
                        <div class="col-sm-8">
                              <select name="anual" id="anual" class="form-control" required>
                                  <option value="">Seleccionar...</option>
                                  <option value="1">General</option>
                                  <option value="0">Anual</option>
                              </select>
                        </div>
                    </div>
                  </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSave"> Guardar </button>
                    <button type="submit" class="btn btn-primary btnUpdate">Actualizar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reset();">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/feriados/_modal.blade.php ENDPATH**/ ?>