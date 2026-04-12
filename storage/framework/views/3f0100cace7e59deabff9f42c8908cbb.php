<p> Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Si el área que está creando depende de otra unidad seleccione el que corresponda del listado de <strong> DEPENDE DE:</strong></p>
  <!-- CONTENIDO -->            
  <form action="<?php echo e(route('areas.store')); ?>" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="jerarquia_id" id="jerarquia_id" value="<?php echo e($jerarquia->id); ?>">
       <div class="row">
          <div class="col-lg-6">
              <div class="form-group">
                  <label for="nombre">Nombre del área <span class="text-danger">*</span></label>
                  <input id="nombre" type="text" class="form-control <?php echo e($errors->has('nombre') ? ' error' : ''); ?>" name= "nombre" value="<?php echo e(old('nombre', isset($area) ? $area->nombre : '')); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                  <?php $__errorArgs = ['nombre'];
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
             <label for="descripcion">Descripción <span class="text-danger">*</span></label>
            <textarea id="descripcion" class="form-control <?php echo e($errors->has('descripcion') ? ' error' : ''); ?>" name="descripcion" rows="4"  onkeydown="return soloLetras(event);"><?php echo e(old('descripcion', isset($area) ? $area->descripcion : '')); ?></textarea>
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
            <label for="depende_id">Depende de:</label>
            <select name="depende_id" id="depende_id" class="form-control">
                <option value="">-- SELECCIONE --</option>
                <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($area_option->id); ?>" <?php echo e(old('depende_id', isset($area) ? $area->depende_id : '') == $area_option->id ? 'selected' : ''); ?>><?php echo e($area_option->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
      </div>
      
      <div class="row">
          <div class="col-lg-12">
              <div class="text-center mt-3">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <a href="<?php echo e(route('areas.index')); ?>" class="btn btn-danger">Salir</a>
              </div>
          </div>
      </div>
  </form> <?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/areas/_form.blade.php ENDPATH**/ ?>