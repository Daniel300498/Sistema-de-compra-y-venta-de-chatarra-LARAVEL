<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>
    <div class="row mb-1">
        <label for="tipo_cargo" class="col-md-4 col-form-label text-right">Tipo Cargo <span class="text-danger">(*)</span></label>
        <div class="col-md-6">
            <select name="tipo_cargo" id="tipo_cargo" class="form-control <?php echo e($errors->has('tipo_cargo') ? ' error' : ''); ?>" onchange="changeTipoCargo();">
                <option value="">Seleccionar...</option>
                <?php $__currentLoopData = $cargo_tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tc->descripcion); ?>" <?php echo e(old('tipo_cargo',$cargo->tipo_cargo)==$tc->descripcion ? 'selected' : ''); ?>><?php echo e($tc->descripcion); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if($errors->has('tipo_cargo')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('tipo_cargo')); ?>

            </span>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mb-1">
    <label for="area_id" class="col-md-4 col-form-label text-right">Área <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <select name="area_id" id="area_id" class="form-control <?php echo e($errors->has('area_id') ? ' error' : ''); ?>">
            <option value="">Seleccionar...</option>
            <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($a->id); ?>" <?php echo e(old('area_id',$cargo->area_id)==$a->id ? 'selected' : ''); ?>><?php echo e($a->nombre); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php if($errors->has('area_id')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('area_id')); ?>

        </span>
        <?php endif; ?>
    </div>
</div>

<div class="row mb-1">
    <label for="denominacion_cargo_id" class="col-md-4 col-form-label text-right ">Denominación <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <select name="denominacion_cargo_id" id="denominacion_cargo_id" class="form-control <?php echo e($errors->has('denominacion_cargo_id') ? ' error' : ''); ?>">
            <option value="">Seleccionar...</option>
            <?php $__currentLoopData = $denominaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($d->id); ?>" <?php echo e(old('denominacion_cargo_id',$cargo->denominacion_cargo_id)==$d->id ? 'selected' : ''); ?>><?php echo e($d->descripcion); ?> --> SUELDO: <?php echo e($d->valor); ?> BS.</option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php if($errors->has('denominacion_cargo_id')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('denominacion_cargo_id')); ?>

            </span>
        <?php endif; ?>
    </div>
</div>

<div class="row mb-1">
    <label for="nro_item" class="col-md-4 col-form-label text-right "> Nro item</label>
    <div class="col-md-6">
        <input id="nro_item" type="text" class="form-control <?php $__errorArgs = ['nro_item'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="nro_item" disabled value="<?php echo e(old('nro_item',$cargo->nro_item)); ?>">
        <?php $__errorArgs = ['nro_item'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">
                <?php echo e($message); ?>

            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<div class="row mb-1">
    <label for="nombre" class="col-md-4 col-form-label text-right "> Nombre del Cargo <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="nombre" type="text" class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo e(old('nombre',$cargo->nombre)); ?>">
        <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">
                <?php echo e($message); ?>

            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<div class="row mb-1">
    <label for="requisito_minimo" class="col-md-4 col-form-label text-right "> Requisito mínimo del Cargo <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="requisito_minimo" type="text" class="form-control <?php $__errorArgs = ['requisito_minimo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="requisito_minimo" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo e(old('requisito_minimo',$cargo->requisito_minimo)); ?>" >
        <?php $__errorArgs = ['requisito_minimo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">
                <?php echo e($message); ?>

            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-primary"><?php echo e($texto); ?></button>
        <a href="<?php echo e(route('cargos.index')); ?>" class="btn btn-danger">Salir</a>
    </div>
</div>
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargos/_form.blade.php ENDPATH**/ ?>