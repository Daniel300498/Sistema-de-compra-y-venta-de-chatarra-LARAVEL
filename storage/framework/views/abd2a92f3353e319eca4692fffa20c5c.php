<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('ap_paterno','Apellido Paterno')); ?> <span class="text-danger">(*)</span>
        <input id="ap_paterno" type="text" class="form-control <?php echo e($errors->has('ap_paterno') ? ' error' : ''); ?>" name="ap_paterno" value="<?php echo e(old('ap_paterno',$medico->ap_paterno)); ?>"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
        <?php if($errors->has('ap_paterno')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('ap_paterno')); ?>

            </span>
        <?php endif; ?>
</div>
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('ap_materno','Apellido Materno')); ?> 
    <input id="ap_materno" type="text" class="form-control <?php echo e($errors->has('ap_materno') ? ' error' : ''); ?>" name="ap_materno" value="<?php echo e(old('ap_materno',$medico->ap_materno)); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('ap_materno')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('ap_materno')); ?>

        </span>
    <?php endif; ?>
</div>           
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('nombres','Nombres')); ?> <span class="text-danger">(*)</span>
    <input id="nombres" type="text" class="form-control <?php echo e($errors->has('nombres') ? ' error' : ''); ?>" name="nombres" value="<?php echo e(old('nombres',$medico->nombres)); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('nombres')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nombres')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-6 mt-2">
    <?php echo e(Form::label('especialidad','Especialidad')); ?> <span class="text-danger">(*)</span>
    <input type="text" name="especialidad" id="especialidad" class="form-control <?php echo e($errors->has('especialidad') ? ' error' : ''); ?>" value="<?php echo e(old('especialidad',$medico->especialidad)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
    <?php if($errors->has('especialidad')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('especialidad')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-md-4 mt-2">
    <?php echo e(Form::label('correo','Correo' )); ?> <span class="text-danger">(*)</span>
    <input type="correo" name="correo" id="correo" class="form-control <?php echo e($errors->has('correo') ? ' error' : ''); ?>" value="<?php echo e(old('correo',$medico->correo)); ?>" >
    <?php if($errors->has('correo')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('correo')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-md-2 mt-2">
    <?php echo e(Form::label('telefono','N°Celular' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo e(old('telefono',$medico->telefono)); ?>" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('telefono')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('telefono')); ?>

        </span>
    <?php endif; ?>
</div>

<?php /**PATH C:\laragon\www\chatarra\resources\views/medicos/secciones/datos_personales.blade.php ENDPATH**/ ?>