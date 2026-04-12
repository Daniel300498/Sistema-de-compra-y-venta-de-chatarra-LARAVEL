
<!--CONTENIDO -->
<input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
<input type="hidden" name="numero_dias" id="numero_dias" value="">
<input type="hidden" name="area" id="area" value="<?php echo e($empleado->cargo[0]->pivot['cargos.area_id']); ?>">
<input type="hidden" name="estado_id" id="estado_id" value="<?php echo e($estado->id); ?>">

    <div class="col-md-8">
        <div class="form-group d-flex">
            <div class="col-md-6">
                <?php echo e(Form::label('tipo_id','Tipo Licencia')); ?>

            </div>
            <div class="col-md-6 text-center">
                <select name="tipo_id" class="form-control text-center" id="tipo_id" onchange="changeType()">
                    <option value="">--   SELECCIONE   --</option>
                    <?php $__currentLoopData = $tipoLicencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($t->id); ?>" <?php echo e(old('tipo_id',$licencia->tipo_id) == $t->id ? 'selected' : ''); ?> >
                            <?php echo e($t->descripcion); ?> 
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    </div>
    <!--selected-->



    <br>
    <div class="col-md-8">
        <div class="form-group d-flex">
            <div class="col-md-6">
                <?php echo e(Form::label('jefe_inmediato','Jefe Inmediato')); ?> <span class="text-danger">(*)</span>
            </div>
            <div class="col-md-6">
                <select name="jefe_inmediato" id="jefe_inmediato" class="form-control text-center <?php echo e($errors->has('jefe_inmediato') ? ' error' : ''); ?>" required>
                    <option value="">--   SELECCIONE   --</option>
                    <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($e->id); ?>" <?php echo e(old('jefe_inmediato',$licencia->jefe_inmediato) == $e->id ? 'selected' : ''); ?> ><?php echo e($e->nombre); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    </div>


    
    <br>

    <div class="col-md-8">
        <div class="form-group d-flex">
        <div class="col-md-6">
        <?php echo e(Form::label('fecha_inicio','Desde el dia' )); ?> <span class="text-danger">(*)</span> 
        </div>
        <div class="col-md-6">
        <input type="date" style="text-align: center" name="fecha_inicio" id="fecha_inicio" onchange="activeDateFinish()" class="form-control <?php echo e($errors->has('fecha_inicio') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_inicio',$licencia->fecha_inicio)); ?>" required>
        <?php if($errors->has('fecha_inicio')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('fecha_inicio')); ?>

            </span>
        <?php endif; ?>
        </div>
        </div>
    </div>


    <br>
    <div class="col-md-8">
        <div class="form-group d-flex">
        <div class="col-md-6">
        <?php echo e(Form::label('fecha_fin','Hasta el dia' )); ?> <span class="text-danger">(*)</span> 
        </div>
        <div class="col-md-6">
        <input type="date" style="text-align: center" name="fecha_fin" id="fecha_fin" onchange="countDays()" class="form-control <?php echo e($errors->has('fecha_fin') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_fin',$licencia->fecha_fin)); ?>" required disabled>
        <?php if($errors->has('fecha_fin')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('fecha_fin')); ?>

            </span>
        <?php endif; ?>
        </div>
        </div>
    </div>

    <br>


    <div class="col-md-8"  id="divMotivo">
        <div class="form-group d-flex">
            <div class="col-md-6">
                <?php echo e(Form::label('motivo','Motivo')); ?> <span class="text-danger">(*)</span>
            </div>
            <div class="col-md-6">
                <select  id="tipo_motivo" name="tipo_motivo" class="form-control text-center"  onchange="changeTypeMotivo(<?php echo e($licencia_rip[0]->horas); ?>);" style="display: none; margin-bottom:10px;" required>
                    <option id="tipo_nulo" name="tipo_nulo" value="">--   SELECCIONE   --</option>
                    <?php $__currentLoopData = $tipoMotivo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($t->id); ?>" <?php echo e(old('tipo_motivo',$licencia->tipo_motivo) == $t->id ? 'selected' : ''); ?>><?php echo e($t->descripcion); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>


                <input id="motivo" name="motivo" style="text-align: center" type="text" class="form-control <?php echo e($errors->has('motivo') ? ' error' : ''); ?>" value="<?php echo e(old('motivo',$licencia->motivo)); ?>" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);" required>
                   <?php if($errors->has('motivo')): ?>                                                                                                        
                        <span class="text-danger">
                            <?php echo e($errors->first('motivo')); ?>

                        </span>
                    <?php endif; ?>
            </div>
        </div>
    </div>
    

    <div class="col-md-8">
        <div class="form-group d-flex">
            <div class="col-md-6">
                <?php echo e(Form::label('horario','Horario')); ?>

            </div>
            <div class="col-md-6 text-center">
                <select name="horario" class="form-control text-center" id="horario">
                    <option id="completo" name="completo" value="8" <?php echo e(old('horario',$licencia->horario) == '8'? 'selected' : ''); ?>>Dia Completo</option>
                    <option id="medio" name="medio" value="4" <?php echo e(old('horario',$licencia->horario) == '4'? 'selected' : ''); ?> >Medio Dia</option>
                </select>
            </div>
        </div>
    </div>

    <br>

  
    <div class="col-md-8">
        <div class="form-group d-flex">
        <div class="col-md-6">
        <?php echo e(Form::label('fecha_registro','Fecha registro' )); ?> <span class="text-danger">(*)</span> 
        </div>
        <div class="col-md-6">
            <?php if(Auth::user()->id == 1): ?>
                <input type="date" style="text-align: center" name="fecha_registro" id="fecha_registro" class="form-control <?php echo e($errors->has('fecha_registro') ? ' error' : ''); ?>"  value="<?php echo e(old('fecha_registro',$licencia->fecha_registro)); ?>">
            <?php else: ?>   
                <input type="hidden" style="text-align: center" name="fecha_registro" id="fecha_registro" class="form-control <?php echo e($errors->has('fecha_registro') ? ' error' : ''); ?>"  value="<?php echo date("Y-m-d");?>" disabled>    
                <h5 style="text-align: center"><?php echo date("Y-m-d");?></h5>
            <?php endif; ?>

            <?php if($errors->has('fecha_registro')): ?>
                <span class="text-danger">
                    <?php echo e($errors->first('fecha_registro')); ?>

                </span>
            <?php endif; ?>
        </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>





<!-- EndCONTENIDO Example -->




<?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/licencias/_form.blade.php ENDPATH**/ ?>