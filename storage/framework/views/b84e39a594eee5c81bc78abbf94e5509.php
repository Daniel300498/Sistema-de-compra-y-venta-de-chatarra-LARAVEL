
  <div class="modal fade" id="formFeriado" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-info">
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
                              <?php echo e(Form::text('nombre',null,['class'=>'form-control','id'=>'nombre','required','onkeyup'=>"javascript:this.value=this.value.toUpperCase();",'required'])); ?>

                          </div>
                      </div>
                      <div class="form-group">
                          <label for="fecha" class="col-sm-12 col-md-4 control-label">Fecha <span class="text-danger">(*)</span></label>
                          <div class="col-sm-12 col-md-8">
                              <?php echo e(Form::date('fecha',null,['class'=>'form-control','id'=>'fecha', 'required'])); ?>

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
                    <button type="submit" class="btn btn-primary btnSave"> <i class="bi bi-plus"></i> Guardar </button>
                    <button type="submit" class="btn btn-success btnUpdate"><i class="bi bi-edit"></i> Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="reset();">Salir</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/feriados/_modal.blade.php ENDPATH**/ ?>