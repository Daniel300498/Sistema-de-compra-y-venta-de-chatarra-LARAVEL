
    <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
    <p class="mb-0">Para adjuntar el documento correspondiente debe rellenar todos los campos y presionar el botón <strong>GUARDAR</strong>. Si no desea realizar ninguna acción solo presione el botón <strong>SALIR</strong></p>
    <p>El valor predeterminado de tipo de asignación de discapacidad se asigno desde el registro del empleado, puede realizar el cambio de esa asignación seleccionando el valor que corresponda del campo de <strong>Empleado con discapacidad o es tutor?</strong></p>
    <div class="d-flex justify-content-center">
        <div class="col-md-10">
                <div class="form-group d-flex">
                    <div class="col-md-5">
                        <?php echo e(Form::label('tutor','Empleado con discapacidad o es tutor?')); ?> <span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-7 text-center">
                        <select name="tutor" id="tutor" class="form-control text-center <?php echo e($errors->has('tutor') ? ' error' : ''); ?>" >
                            <option value="">-- SELECCIONE --</option>
                            <option value="1" <?php echo e(old('tutor',$empleado->discapacidad) =='1' ? 'selected' :''); ?>>Discapacitado</option>
                            <option value="2" <?php echo e(old('tutor',$empleado->discapacidad) =='2' ? 'selected' :''); ?>>Tutor</option>
                        </select>
                        <?php if($errors->has('tutor')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('tutor')); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <br>

                <div class="form-group d-flex">
                    <div class="col-md-5">
                        <label for="example-text-input" class="form-control-label">Documento Persona con Discapacidad <span class="text-danger">(*)</span></label>
                    </div>
                    <div class="col-md-7">
                        <input type="file" class="form-control <?php echo e($errors->has('documento') ? ' error' : ''); ?>" name="documento" id="files" accept="application/pdf">  
                        <?php if($errors->has('documento')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('documento')); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                    <?php if($discapacidad->id!=null): ?>
                        <a href="<?php echo e(asset('discapacidad/'.$discapacidad->adjunto)); ?>" class="btn btn-info" title="Ver Adjunto" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                    <?php endif; ?>
                </div>
        
            
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary"><?php echo e($texto); ?></button>
                <?php if($tipo==1): ?>
                <a href="<?php echo e(route('discapacidades_empleados.index')); ?>" class="btn btn-danger">Salir</a>
                <?php else: ?>
                <a href="<?php echo e(route('discapacidades.index')); ?>" class="btn btn-danger">Salir</a>
                <?php endif; ?>
            </div>
        </div>
    </div>


    

                    
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/discapacidad/_form.blade.php ENDPATH**/ ?>