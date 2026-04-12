<p> Debe rellenar el campo descripción y el salario correspondiente y presionar el botón <strong>GUARDAR</strong>.</p>
<form action="<?php echo e(route('cargoDenominacion.update', $cargoDenominacion->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="descripcion">Denominación del Cargo <span class="text-danger">*</span></label>
                <input id="descripcion" type="text" class="form-control <?php echo e($errors->has('descripcion') ? ' error' : ''); ?>" name="descripcion"  value="<?php echo e(old('descripcion', isset($cargoDenominacion) ? $cargoDenominacion->descripcion : '')); ?>"  required="required" placeholder="Ingrese la Denominación del cargo" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="col-lg-6">
            <label for="sueldo">Salario</label> <span class="text-danger">*</span>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Bs.-</span>
                </div>
                <input id="sueldo" type="number" step="0.01" class="form-control <?php echo e($errors->has('sueldo') ? ' error' : ''); ?>" name="sueldo"  value="<?php echo e(old('sueldo', isset($cargoDenominacion) ? $cargoDenominacion->sueldo : '')); ?>"  required="required">
                 <?php $__errorArgs = ['sueldo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('cargoDenominacion.index')); ?>" class="btn btn-danger">Salir</a>  
            </div>
        </div>
    </div>
</form>
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargoDenominacion/_form.blade.php ENDPATH**/ ?>