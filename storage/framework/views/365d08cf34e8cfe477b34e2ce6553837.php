<?php $__env->startSection('titulo', 'Internaciones'); ?>

<?php $__env->startSection('content'); ?>
<div class="pagetitle">
  <h1>internaciones</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?php echo e(route('internaciones.create', ['uuidPaciente' => $paciente->uuid ])); ?>">internaciones</a></li>
      <li class="breadcrumb-item active">Nuevo</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Adjuntar Internaciones</h5>
            <h3><span class="badge bg-nombre-empleado"><?php echo e($paciente->nombres); ?> <?php echo e($paciente->ap_paterno); ?> <?php echo e($paciente->ap_materno); ?></span></h3>
          </div>

          <p>
            Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. 
            Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. 
            Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.
          </p>
        <form action="<?php echo e(route('internaciones.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="paciente_id" value="<?php echo e($paciente->id); ?>">

            <div class="row">
                <div class="col-lg-4">
                    <?php echo e(Form::label('fecha_ocupacion', 'Fecha de Ocupación')); ?> <span class="text-danger">(*)</span>
                    <input type="date" name="fecha_ocupacion" id="fecha_ocupacion" class="form-control <?php echo e($errors->has('fecha_ocupacion') ? 'error' : ''); ?>" value="<?php echo e(old('fecha_ocupacion')); ?>" >
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

                    <input type="date" name="fecha_desocupacion" id="fecha_desocupacion" class="form-control <?php echo e($errors->has('fecha_desocupacion') ? 'error' : ''); ?>" value="<?php echo e(old('fecha_desocupacion')); ?>">
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
                    <input type="text" name="motivo" id="motivo" class="form-control <?php echo e($errors->has('motivo') ? 'error' : ''); ?>" value="<?php echo e(old('motivo')); ?>" >
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

                    <textarea name="observaciones" id="observaciones" rows="4" class="form-control <?php echo e($errors->has('observaciones') ? 'error' : ''); ?>"><?php echo e(old('observaciones')); ?></textarea>
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
                            <option value="<?php echo e($medico->id); ?>" <?php echo e(old('medico_id') == $medico->id ? 'selected' : ''); ?>>
                                <?php echo e($medico->nombres); ?> <?php echo e($medico->ap_paterno); ?> <?php echo e($medico->ap_materno); ?>

                            </option>
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
                            <option value="<?php echo e($cama->id); ?>" <?php echo e(old('cama_id') == $cama->id ? 'selected' : ''); ?>><?php echo e($cama->salas->piso); ?> || <?php echo e($cama->salas->nombre); ?> || CAMA <?php echo e($cama->numero); ?></option>
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
                        <option value="CAJA NACIONAL" <?php echo e(old('nombre_cobertura') == 'CAJA NACIONAL' ? 'selected' : ''); ?>>CAJA NACIONAL</option>
                        <option value="SOAT" <?php echo e(old('nombre_cobertura') == 'SOAT' ? 'selected' : ''); ?>>SOAT</option>
                        <option value="PARTICULAR" <?php echo e(old('nombre_cobertura') == 'PARTICULAR' ? 'selected' : ''); ?>>PARTICULAR</option>
                    </select>
                </div>

                <div class="col-lg-3">
                    <?php echo e(Form::label('tipo_cobertura', 'Tipo de Cobertura')); ?>

                    <select name="tipo_cobertura" id="tipo_cobertura" class="form-control">
                        <option value="">-- SELECCIONE --</option>
                        <option value="SEGURO PUBLICO" <?php echo e(old('tipo_cobertura') == 'SEGURO PUBLICO' ? 'selected' : ''); ?>>SEGURO PÚBLICO</option>
                        <option value="SEGURO PRIVADO" <?php echo e(old('tipo_cobertura') == 'SEGURO PRIVADO' ? 'selected' : ''); ?>>SEGURO PRIVADO</option>
                    </select>
                </div>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('internaciones.index')); ?>" class="btn btn-danger">Salir</a>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if(count($internaciones) > 0): ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">internaciones registradas</h5> 
          </div>
          <p>
            Si necesita realizar una corrección del registro previamente ingresado o eliminarlo puede utilizar las opciones del menú.
          </p>

          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" id="datos" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Fecha de Ocupacion</th>
                  <th class="text-center">Fecha de Desocupacion</th>
                  <th class="text-center">Medico Responsable</th>
                  <th class="text-center">Sala y Cama</th>
                  <th class="text-center">Tipo de Cobertura</th>
                  <th class="text-center"></th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $internaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $internacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td class="text-center"><?php echo e($key + 1); ?></td>
                  <td class="text-center"><?php echo e(date('d/m/Y', strtotime($internacion->fecha_ocupacion))); ?></td>
                  <?php if($internacion->fecha_desocupacion): ?>
                  <td class="text-center"><?php echo e(date('d/m/Y', strtotime($internacion->fecha_desocupacion))); ?></td>
                  <?php else: ?>
                  <td class="text-center">AUN INTERNADO</td>
                  <?php endif; ?>
                  <td class="text-center"><?php echo e($internacion->medicos->nombres); ?> <?php echo e($internacion->medicos->ap_paterno); ?> <?php echo e($internacion->medicos->ap_materno); ?></td>
                  <td class="text-center"><?php echo e($internacion->camas->salas->piso); ?> || <?php echo e($internacion->camas->salas->nombre); ?> || <?php echo e($internacion->camas->numero); ?></td>
                  <td class="text-center"><?php echo e($internacion->tipo_cobertura); ?></td>
                  <td class="d-flex align-items-center justify-content-center">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button>
                      <ul class="dropdown-menu">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('internaciones.edit')): ?>
                          <li><a class="dropdown-item" href="<?php echo e(route('internaciones.edit', $internacion->uuid)); ?>">Modificar datos</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('internaciones.destroy')): ?>
                          <li>
                            <a class="dropdown-item" href="<?php echo e(route('internaciones.destroy', $internacion->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar la internacion?');">
                              Eliminar internacion
                            </a>
                          </li>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>"></script>
<script>
  mostrar();
  function mostrar() {
    const tipo = $("#tipo").val() ?? $("#tipo").data('old');
    if (tipo == 3) {
      $("#fecha_retiro").show().prop("", true);
      $("#bloque, #label").show();
    } else {
      $("#fecha_retiro").hide().removeAttr("");
      $("#label").hide();
    }
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/internaciones/create.blade.php ENDPATH**/ ?>