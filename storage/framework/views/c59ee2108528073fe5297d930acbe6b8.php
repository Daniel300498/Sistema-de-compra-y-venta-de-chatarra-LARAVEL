<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
   Al momento de <?php if($user->id): ?> editar  <?php else: ?> registrar <?php endif; ?> un usuario, debe asignarle un rol, para que pueda solo ver y administrar la información que corresponda</p>
   <?php if(!$user->id): ?><p>Tomar en cuenta que la contraseña que aparece en el campo correspondiente una vez se selecciona un empleado, es solo <strong>UNA SUGERENCIA</strong> basada en la C&eacute;dula de Identidad del Empleado seleccionado, usted puede cambiarla.</p><?php endif; ?>
<form action="<?php echo e(route('users.store')); ?>" method="POST" enctype="multipart/form-data">
<div class="row mb-1">
    <label for="role_id" class="col-md-4 col-form-label text-right ">Rol <span class="text-danger">(*)</span></label>
    <div class="col-md-6 mb-0 pb-0">
        <select name="role_id"  class="form-control form-control <?php echo e($errors->has('role_id') ? ' error' : ''); ?>" id="role_id" onchange="changeRol(this)">
            <option value="">--SELECCIONE--</option>
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($rol->id); ?>" <?php echo e(old('role_id',count($user->rol)>0 ? $user->rol[0]->id :'')== $rol->id ? 'selected' : ''); ?>><?php echo e($rol->name); ?> <em>(<?php echo e($rol->descripcion); ?>)</em></option>
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

<div class="row mb-1">
    <label for="empleado_id" class="col-md-4 col-form-label text-right">Empleado <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <select name="empleado_id"  class="form-control form-control <?php echo e($errors->has('empleado_id') ? ' error' : ''); ?>" id="empleado_id" data-ruta="<?php echo e(route('datos.empleado')); ?>"    onchange="datosEmpleado()">
                 <?php if(count($empleados) > 0): ?>
                <option value="">-- SELECCIONE --</option>
                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($empleado->id); ?>" <?php echo e(old('empleado_id', $user->empleado_id) == $empleado->id ? 'selected' : ''); ?>>
                        <?php echo e($empleado->ci); ?> - <?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <option value="">NO EXISTEN EMPLEADOS REGISTRADOS PARA SER HABILITADOS</option>
            <?php endif; ?>
        </select>
        <?php $__errorArgs = ['empleado_id'];
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
    <label for="name" class="col-md-4 col-form-label text-right">Nombre Completo: <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control <?php echo e($errors->has('name') ? ' error' : ''); ?>" name="name" value="<?php echo e(old('name',$user->name)); ?>"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" disabled>
        <?php if($errors->has('name')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('name')); ?>

            </span>
        <?php endif; ?>
    </div>
</div>

<div class="row mb-1">
    <label for="role_id" class="col-md-4 col-form-label text-right ">Correo Electrónico o Usuario <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="email" type="text" class="form-control<?php echo e($errors->has('email') ? ' error' : ''); ?>" name="email" value="<?php echo e(old('email', isset($user) ? $user->email : '')); ?>" disabled>
        <?php if($errors->has('email')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('email')); ?>

            </span>
        <?php endif; ?>
    </div>
</div>
<div class="row mb-1">
    <label for="estado" class="col-md-4 col-form-label text-right">Estado <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <select id="estado" class="form-control <?php echo e($errors->has('estado') ? 'error' : ''); ?>" name="estado">
            <option value="1" <?php echo e(old('estado', isset($user) && $user->estado == 1 ? 'selected' : '')); ?>>Activo</option>
            <option value="0" <?php echo e(old('estado', isset($user) && $user->estado == 0 ? 'selected' : '')); ?>>Inactivo</option>
        </select>
        <?php if($errors->has('estado')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('estado')); ?>

            </span>
        <?php endif; ?>
    </div>
</div>
<div class="row mb-0">
    <label for="password" class="col-md-4 col-form-label text-right">
        <?php echo e($texto_pass); ?> 
        <?php if($tipo==1): ?> 
            <span class="text-danger">(*)</span> 
        <?php endif; ?>
    </label>
    <div class="col-md-6 position-relative">
        <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" autocomplete="new-password">
        <i id="togglePasswordIcon" class="bi bi-eye position-absolute" style="right: 30px; top: 10px; cursor: pointer;" onclick="togglePassword('password', 'togglePasswordIcon')"></i>

        <?php $__errorArgs = ['password'];
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

<?php if($tipo==1): ?>
    <div class="row mt-1">
        <label for="password_confirm" class="col-md-4 col-form-label text-right "><?php echo e(__('Confirm Password')); ?> <span class="text-danger">(*)</span></label>
        <div class="col-md-6">
            <input id="password_confirm" type="password" class="form-control" name="password_confirm" >
            <?php $__errorArgs = ['password_confirm'];
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
<?php endif; ?>
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-primary"><?php echo e($texto); ?></button>
        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-danger">Cancelar</a>
    </div>
</div>
</form><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/users/_form.blade.php ENDPATH**/ ?>