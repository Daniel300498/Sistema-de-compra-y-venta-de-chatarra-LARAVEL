<p>
  Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
  Al momento de registrar o editar el permiso.</p>
<form action="<?php echo e(route('permisos.store')); ?>" method="POST" enctype="multipart/form-data">
  
<div class="row mb-1">  
    <label for="role_id" class="col-md-4 col-form-label text-right">Nombre de permiso<span class="text-danger">(*)</span></label>
      <div class="col-md-6">
        <input id="name" type="text" class="form-control <?php echo e($errors->has('name') ? ' error' : ''); ?>"  name="name" value="<?php echo e(old('name', $permiso->name)); ?>"/>
        <?php if($errors->has('name')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('name')); ?>

            </span>
        <?php endif; ?>
      </div>
</div>
<div class="row mb-1">  
    <label for="descripcion" class="col-md-4 col-form-label text-right">Descripcion <span class="text-danger">(*)</span></label>
      <div class="col-md-6">
        <input id="descripcion" type="text" class="form-control <?php echo e($errors->has('descripcion') ? ' error' : ''); ?>"  name="descripcion" value="<?php echo e(old('descripcion', $permiso->descripcion)); ?>"/>
        <?php if($errors->has('descripcion')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('descripcion')); ?>

            </span>
        <?php endif; ?>
      </div>
</div>
<div class="row mb-1">
    <label for="grupo" class="col-md-4 col-form-label text-right ">Grupo <span class="text-danger">(*)</span></label>
    <div class="col-md-6 mb-0 pb-0">
        <select name="grupo"  class="form-control form-control <?php echo e($errors->has('grupo') ? ' error' : ''); ?>" id="grupo" onchange="changeRol(this)">
            <option value="">--SELECCIONE--</option>
            <?php $__currentLoopData = $grupos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($grupo->descripcion); ?>" <?php echo e(old('grupo',$permiso->grupo ? $permiso->grupo :'')== $grupo->descripcion ? 'selected' : ''); ?>><?php echo e($grupo->name); ?> <em><?php echo e($grupo->descripcion); ?></em></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['role_id'];
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
      <button type="submit" class="btn btn-primary"> <?php echo e($texto); ?> </button>
      <a href="<?php echo e(route('permisos.index')); ?>" class="btn btn-danger">Cancelar</a>
    </div>
  </div>
</form><?php /**PATH C:\laragon\www\chatarra\resources\views/permisos/_form.blade.php ENDPATH**/ ?>