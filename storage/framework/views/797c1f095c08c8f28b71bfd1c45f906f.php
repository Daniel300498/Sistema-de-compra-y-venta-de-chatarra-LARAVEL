<p> Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Si la cama que está creando depende de otra unidad seleccione el que corresponda del listado de <strong> DEPENDE DE:</strong></p>
  <!-- CONTENIDO -->            
  <form action="<?php echo e(route('camas.store')); ?>" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="sala_id" id="sala_id" value="<?php echo e($sala->id); ?>">
       <div class="row">
          <div class="col-lg-6">
              <div class="form-group">
                  <label for="numero">Numero de cama <span class="text-danger">*</span></label>
                  <input id="numero" type="text" class="form-control <?php echo e($errors->has('numero') ? ' error' : ''); ?>" name= "numero" value="<?php echo e(old('numero', isset($cama) ? $cama->numero : '')); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                  <?php $__errorArgs = ['numero'];
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
            <div class="form-group">
                <label for="estado">Estado <span class="text-danger">*</span></label>
                <select id="estado" name="estado" class="form-control <?php echo e($errors->has('estado') ? ' is-invalid' : ''); ?>">
                    <option value="">-- Seleccione estado --</option>
                    <option value="OCUPADO" <?php echo e(old('estado', $cama->estado ?? '') == 'OCUPADO' ? 'selected' : ''); ?>>OCUPADO</option>
                    <option value="DESOCUPADO" <?php echo e(old('estado', $cama->estado ?? '') == 'DESOCUPADO' ? 'selected' : ''); ?>>DESOCUPADO</option>
                </select>
                <?php $__errorArgs = ['estado'];
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
                  <a href="<?php echo e(route('camas.index')); ?>" class="btn btn-danger">Salir</a>
              </div>
          </div>
      </div>
  </form> <?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/camas/_form.blade.php ENDPATH**/ ?>