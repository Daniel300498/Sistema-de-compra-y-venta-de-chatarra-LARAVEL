
<?php $__env->startSection('titulo','Internaciones'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>REGISTRO DE INTERNACIONES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('internaciones.edit',$internacion->uuid)); ?>">Internaciones</a></li>
        <li class="breadcrumb-item active">Editar</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Editar Registro de Internacion</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($paciente->nombres); ?> <?php echo e($paciente->ap_paterno); ?> <?php echo e($paciente->ap_materno); ?></span></h3>
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.</p>
           <!--CONTENIDO -->
           <?php echo Form::model($internacion,['route'=>['internaciones.update',$internacion->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

            <?php echo e(csrf_field()); ?>

             <input type="hidden" name="paciente_id" value="<?php echo e($paciente->id); ?>">

                <div class="row">
                  <div class="col-lg-4">
                <?php echo e(Form::label('fecha_ocupacion', 'Fecha de Ocupación')); ?> <span class="text-danger">(*)</span>
                <input type="date" name="fecha_ocupacion" id="fecha_ocupacion" class="form-control <?php echo e($errors->has('fecha_ocupacion') ? 'error' : ''); ?>" value="<?php echo e(old('fecha_ocupacion', optional($internacion->fecha_ocupacion)->format('Y-m-d'))); ?>">
                    <?php $__errorArgs = ['fecha_ocupacion'];
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

              <div class="col-lg-4">
                  <?php echo e(Form::label('fecha_desocupacion', 'Fecha de Desocupación')); ?>

                  <input type="date" name="fecha_desocupacion" id="fecha_desocupacion" class="form-control <?php echo e($errors->has('fecha_desocupacion') ? 'error' : ''); ?>"value="<?php echo e(old('fecha_desocupacion', optional($internacion->fecha_desocupacion)->format('Y-m-d'))); ?>">
                  <?php $__errorArgs = ['fecha_desocupacion'];
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

                <div class="col-lg-4">
                    <?php echo e(Form::label('motivo', 'Motivo de la Internación')); ?> <span class="text-danger">(*)</span>
                    <input type="text" name="motivo" id="motivo" class="form-control <?php echo e($errors->has('motivo') ? 'error' : ''); ?>" value="<?php echo e(old('motivo', $internacion->motivo)); ?>" >
                    <?php $__errorArgs = ['motivo'];
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

                <div class="col-lg-12">
                    <?php echo e(Form::label('observaciones', 'Observaciones')); ?>

                    <textarea name="observaciones" id="observaciones" rows="4" class="form-control <?php echo e($errors->has('observaciones') ? 'error' : ''); ?>"><?php echo e(old('observaciones', $internacion->observaciones)); ?></textarea>
                    <?php $__errorArgs = ['observaciones'];
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

                <div class="col-lg-6">
                    <?php echo e(Form::label('medico_id', 'Médico Responsable')); ?> <span class="text-danger">(*)</span>
                    <select name="medico_id" id="medico_id" class="form-control <?php echo e($errors->has('medico_id') ? 'error' : ''); ?>" >
                        <option value="">-- SELECCIONE --</option>
                      <?php $__currentLoopData = $medicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($medico->id); ?>" <?php echo e(old('medico_id', $internacion->medico_id) == $medico->id ? 'selected' : ''); ?>> <?php echo e($medico->nombres); ?> <?php echo e($medico->ap_paterno); ?> <?php echo e($medico->ap_materno); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['medico_id'];
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

                <div class="col-lg-6">
                    <?php echo e(Form::label('cama_id', 'Sala y Cama')); ?> <span class="text-danger">(*)</span>
                    <select name="cama_id" id="cama_id" class="form-control <?php echo e($errors->has('cama_id') ? 'error' : ''); ?>" >
                        <option value="">-- SELECCIONE --</option>
                      <?php $__currentLoopData = $camas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($cama->id); ?>" <?php echo e(old('cama_id', $internacion->cama_id) == $cama->id ? 'selected' : ''); ?>><?php echo e($cama->salas->piso); ?> || <?php echo e($cama->salas->nombre); ?> || CAMA <?php echo e($cama->numero); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['cama_id'];
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

                <div class="col-lg-3">
                    <?php echo e(Form::label('nombre_cobertura', 'Nombre de Cobertura')); ?>

                    <select name="nombre_cobertura" id="nombre_cobertura" class="form-control">
                        <option value="">-- SELECCIONE --</option>
                       <option value="CAJA NACIONAL" <?php echo e(old('nombre_cobertura', $internacion->nombre_cobertura) == 'CAJA NACIONAL' ? 'selected' : ''); ?>>CAJA NACIONAL</option>
                        <option value="SOAT" <?php echo e(old('nombre_cobertura', $internacion->nombre_cobertura) == 'SOAT' ? 'selected' : ''); ?>>SOAT</option>
                        <option value="PARTICULAR" <?php echo e(old('nombre_cobertura', $internacion->nombre_cobertura) == 'PARTICULAR' ? 'selected' : ''); ?>>PARTICULAR</option>
                     </select>
                </div>

                <div class="col-lg-3">
                    <?php echo e(Form::label('tipo_cobertura', 'Tipo de Cobertura')); ?>

                    <select name="tipo_cobertura" id="tipo_cobertura" class="form-control">
                        <option value="">-- SELECCIONE --</option>
                       <option value="SEGURO PUBLICO" <?php echo e(old('tipo_cobertura', $internacion->tipo_cobertura) == 'SEGURO PUBLICO' ? 'selected' : ''); ?>>SEGURO PÚBLICO</option>
                        <option value="SEGURO PRIVADO" <?php echo e(old('tipo_cobertura', $internacion->tipo_cobertura) == 'SEGURO PRIVADO' ? 'selected' : ''); ?>>SEGURO PRIVADO</option>       </select>
                </div>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('internaciones.index')); ?>" class="btn btn-danger">Salir</a>
            </div>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
    
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<script>
  mostrar();
  function mostrar() {
  var x = $("#tipo").val() != null ? $("#tipo").val() : $("#tipo").data('old');
  if (x==3) {
       $("#fecha_retiro").show();
       $("#fecha_retiro").prop("", true);
       var el = document.getElementById("bloque");
       el.setAttribute("style", "display:block");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:block");
      } else {
       $("#fecha_retiro").hide();
       $("#fecha_retiro").removeAttr("");
       var el1 = document.getElementById("label");
       el1.setAttribute("style", "display:none");
      } 
 
  }  
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/internaciones/edit.blade.php ENDPATH**/ ?>