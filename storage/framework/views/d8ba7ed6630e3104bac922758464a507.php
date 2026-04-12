<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('ap_paterno','Apellido Paterno')); ?> <span class="text-danger">(*)</span>
        <input id="ap_paterno" type="text" class="form-control <?php echo e($errors->has('ap_paterno') ? ' error' : ''); ?>" name="ap_paterno" value="<?php echo e(old('ap_paterno',$paciente->ap_paterno)); ?>"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
        <?php if($errors->has('ap_paterno')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('ap_paterno')); ?>

            </span>
        <?php endif; ?>
</div>
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('ap_materno','Apellido Materno')); ?> 
    <input id="ap_materno" type="text" class="form-control <?php echo e($errors->has('ap_materno') ? ' error' : ''); ?>" name="ap_materno" value="<?php echo e(old('ap_materno',$paciente->ap_materno)); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('ap_materno')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('ap_materno')); ?>

        </span>
    <?php endif; ?>
</div>           
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('nombres','Nombres')); ?> <span class="text-danger">(*)</span>
    <input id="nombres" type="text" class="form-control <?php echo e($errors->has('nombres') ? ' error' : ''); ?>" name="nombres" value="<?php echo e(old('nombres',$paciente->nombres)); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('nombres')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nombres')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('fecha_nacimiento','Fecha Nacimiento')); ?> <span class="text-danger">(*)</span>
    <input type="date" class="form-control <?php echo e($errors->has('fecha_nacimiento') ? ' error' : ''); ?>" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo e(old('fecha_nacimiento',$paciente->fecha_nacimiento)); ?>" onkeyup="calcularEdad();">
    <?php if($errors->has('fecha_nacimiento')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('fecha_nacimiento')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-1 mt-2">
    <?php echo e(Form::label('edad','Edad' )); ?> <span class="text-danger">(*)</span>
    <input type="number" name="edad" id="campo_edad" class="form-control" value="<?php echo e(old('edad',$paciente->edad)); ?>" readonly>

</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('sexo','Género' )); ?> <span class="text-danger">(*)</span>
    <select name="sexo" id="sexo" class="form-control <?php echo e($errors->has('sexo') ? ' error' : ''); ?>">
        <option value="">-- SELECCIONE --</option>
        <option value="1" <?php echo e(old('sexo',$paciente->sexo) =='1' ? 'selected' :''); ?>>Femenino</option>
        <option value="0" <?php echo e(old('sexo',$paciente->sexo) =='0' ? 'selected' :''); ?>>Masculino</option>
    </select>
    <?php if($errors->has('sexo')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('sexo')); ?>

        </span>
    <?php endif; ?>
</div>


<div class="col-lg-2 mt-2">
    <?php echo e(Form::label('ci','C.I.' )); ?> <span class="text-danger">(*)</span>
    <input type="text" class="form-control <?php echo e($errors->has('ci') ? ' error' : ''); ?>" name="ci" id="ci" value="<?php echo e(old('ci',$paciente->ci)); ?>"  onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('ci')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('ci')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-2 mt-2">
    <?php echo e(Form::label('ci_complemento','Complemento' )); ?>

    <input type="text" class="form-control" name="ci_complemento" id="ci_complemento" value="<?php echo e(old('ci_complemento',$paciente->ci_complemento)); ?>" >
</div>
<div class="col-lg-2 mt-2">
    <?php echo e(Form::label('ci_lugar','Expedido' )); ?> <span class="text-danger">(*)</span>
    <select name="ci_lugar" id="ci_lugar" class="form-control <?php echo e($errors->has('ci_lugar') ? ' error' : ''); ?>">
        <option value="">-- SELECCIONE --</option>
        <?php $__currentLoopData = $lugares_ci; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lugar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($lugar->descripcion); ?>" <?php echo e(old('ci_lugar',$paciente->ci_lugar) ==$lugar->descripcion ? 'selected' :''); ?>><?php echo e($lugar->descripcion); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if($errors->has('ci_lugar')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('ci_lugar')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-6 mt-2">
    <?php echo e(Form::label('domicilio','Domicilio')); ?> <span class="text-danger">(*)</span>
    <input type="text" name="domicilio" id="domicilio" class="form-control <?php echo e($errors->has('domicilio') ? ' error' : ''); ?>" value="<?php echo e(old('domicilio',$paciente->domicilio)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
    <?php if($errors->has('domicilio')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('domicilio')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-md-4 mt-2">
    <?php echo e(Form::label('email','Correo' )); ?> <span class="text-danger">(*)</span>
    <input type="email" name="email" id="email" class="form-control <?php echo e($errors->has('email') ? ' error' : ''); ?>" value="<?php echo e(old('email',$paciente->email)); ?>" >
    <?php if($errors->has('email')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('email')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-md-2 mt-2">
    <?php echo e(Form::label('nro_celular','N°Celular' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="nro_celular" id="nro_celular" class="form-control" value="<?php echo e(old('nro_celular',$paciente->nro_celular)); ?>" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('nro_celular')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nro_celular')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-md-2 mt-2">
    <?php echo e(Form::label('nro_telefono','N° Telefono' )); ?>

    <input type="text" name="nro_telefono" id="nro_telefono" class="form-control" value="<?php echo e(old('nro_telefono',$paciente->telefono)); ?>" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 9 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
</div>
<?php /**PATH C:\laragon\www\chatarra\resources\views/pacientes/secciones/datos_personales.blade.php ENDPATH**/ ?>