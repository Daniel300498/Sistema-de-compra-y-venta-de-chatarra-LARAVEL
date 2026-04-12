      <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
      <?php echo e(csrf_field()); ?>


      <div class="col-md-10">
          <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
              <label for="example-text-input" class="form-control-label">Certificado Medico <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
            </div>
            <div class="col-md-7 text-center">
                <input type="file" name="documento" id="" class="form-control"  accept="application/pdf">
                  <?php if($errors->has('documento')): ?>
                    <span class="text-danger">
                      <?php echo e($errors->first('documento')); ?>

                    </span>
                  <?php endif; ?>
             
            </div>
            <?php if($enfermedadTerminal->id!=null): ?>
              <a href="<?php echo e(asset('enfermedades/'.$enfermedadTerminal->documento)); ?>" class="btn btn-info" title="Ver documento" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
            <?php endif; ?>
          </div>

          <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
              <label for="example-text-input" class="form-control-label">Descripci&oacute;n <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
            </div>
            <div class="col-md-7 text-center">
              <input id="descripcion" type="text" class="form-control text-center <?php echo e($errors->has('descripcion') ? ' error' : ''); ?>" value="<?php echo e(old('descripcion',$enfermedadTerminal->descripcion)); ?>" name="descripcion" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                    <?php if($errors->has('descripcion')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('descripcion')); ?>

                        </span>
                    <?php endif; ?>
            </div>
          </div> 

          <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
              <label for="example-text-input" class="form-control-label">Nombre Medico <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
            </div>
            <div class="col-md-7 text-center">
                <input id="nombre_medico" type="text" class="form-control text-center <?php echo e($errors->has('nombre_medico') ? ' error' : ''); ?>" value="<?php echo e(old('nombre_medico',$enfermedadTerminal->nombre_medico)); ?>" name="nombre_medico"  onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                      <?php if($errors->has('nombre_medico')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('nombre_medico')); ?>

                          </span>
                      <?php endif; ?>
            </div>
          </div> 

          <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
              <label for="example-text-input" class="form-control-label">Instituci&oacute;n <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
            </div>
            <div class="col-md-7 text-center">
              <input id="institucion" type="text" class="form-control text-center <?php echo e($errors->has('institucion') ? ' error' : ''); ?>" name="institucion" value="<?php echo e(old('institucion',$enfermedadTerminal->institucion)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                      <?php if($errors->has('institucion')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('institucion')); ?>

                          </span>
                      <?php endif; ?>
            </div>
          </div> 

          <div class="form-group d-flex align-items-center mb-2">
            <div class="col-md-5 text-right">
              <label for="example-text-input" class="form-control-label">Fecha <span class="text-danger">(*)</span> &nbsp;&nbsp;</label>
            </div>
            <div class="col-md-7 text-center">
              <input type="date" name="fecha_inicio_enfermedad" id="fecha_inicio_enfermedad" value="<?php echo e(old('fecha_inicio_enfermedad',$enfermedadTerminal->fecha_inicio_enfermedad)); ?>" class="form-control text-center <?php echo e($errors->has('fecha_inicio_enfermedad') ? ' error' : ''); ?>">
                  <?php if($errors->has('fecha_inicio_enfermedad')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('fecha_inicio_enfermedad')); ?>

                      </span>
                  <?php endif; ?>
            </div>
          </div>
      </div>
                    
      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="<?php echo e(route('enfermedades.index')); ?>" class="btn btn-danger">Salir</a>
      </div>

             
 
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/enfermedades/_form.blade.php ENDPATH**/ ?>