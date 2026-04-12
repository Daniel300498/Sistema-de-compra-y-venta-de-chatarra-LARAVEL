<?php $__env->startSection('titulo', 'Consultas'); ?>

<?php $__env->startSection('content'); ?>
<div class="pagetitle">
  <h1>CONSULTAS</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?php echo e(route('consultas.create', ['uuidPaciente' => $paciente->uuid ])); ?>">Consultas</a></li>
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
            <h5 class="card-title">Adjuntar Consultas</h5>
            <h3><span class="badge bg-nombre-empleado"><?php echo e($paciente->nombres); ?> <?php echo e($paciente->ap_paterno); ?> <?php echo e($paciente->ap_materno); ?></span></h3>
          </div>

          <p>
            Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. 
            Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. 
            Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.
          </p>

          <form action="<?php echo e(route('consultas.store')); ?>" method="POST" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="paciente_id" value="<?php echo e($paciente->id); ?>">

            <div class="row">
              <div class="col-lg-4 mb-3">
                    <?php echo e(Form::label('fecha', 'Fecha de Consulta')); ?> <span class="text-danger">*</span>
                    <input type="date" name="fecha" id="fecha" class="form-control <?php echo e($errors->has('fecha') ? 'is-invalid' : ''); ?>" value="<?php echo e(old('fecha')); ?>">
                    <?php $__errorArgs = ['fecha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

              <div class="col-lg-4 mb-3">
                  <?php echo e(Form::label('medico_id', 'Médico Responsable')); ?> <span class="text-danger">*</span>
                  <select name="medico_id" id="medico_id" class="form-control <?php echo e($errors->has('medico_id') ? 'is-invalid' : ''); ?>">
                      <option value="">-- Seleccione un médico --</option>
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
                      <div class="invalid-feedback"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-lg-4 mb-3">
                  <?php echo e(Form::label('motivo_consulta', 'Motivo de la Consulta')); ?> <span class="text-danger">*</span>
                  <input type="text" name="motivo_consulta" id="motivo_consulta" class="form-control <?php echo e($errors->has('motivo_consulta') ? 'is-invalid' : ''); ?>" value="<?php echo e(old('motivo_consulta')); ?>">
                  <?php $__errorArgs = ['motivo_consulta'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <div class="invalid-feedback"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-lg-6 mb-3">
                  <?php echo e(Form::label('diagnostico', 'Diagnóstico')); ?> <span class="text-danger">*</span>
                  <textarea name="diagnostico" id="diagnostico" rows="4" class="form-control <?php echo e($errors->has('diagnostico') ? 'is-invalid' : ''); ?>"><?php echo e(old('diagnostico')); ?></textarea>
                  <?php $__errorArgs = ['diagnostico'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <div class="invalid-feedback"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-lg-6 mb-3">
                  <?php echo e(Form::label('observaciones', 'Observaciones')); ?>

                  <textarea name="observaciones" id="observaciones" rows="4" class="form-control <?php echo e($errors->has('observaciones') ? 'is-invalid' : ''); ?>"><?php echo e(old('observaciones')); ?></textarea>
                  <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <div class="invalid-feedback"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

          </div>

          <div class="text-center mt-3">
              <button type="submit" class="btn btn-primary">Guardar</button>
              <a href="<?php echo e(route('consultas.index')); ?>" class="btn btn-danger">Salir</a>
          </div>
      </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if(count($consultas) > 0): ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Consultas registradas</h5> 
          </div>
          <p>
            Si necesita realizar una corrección del registro previamente ingresado o eliminarlo puede utilizar las opciones del menú.
          </p>

          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" id="datos" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Fecha</th>
                  <th class="text-center">Motivo de la Consulta</th>
                  <th class="text-center">Diagnostico</th>
                  <th class="text-center">Observaciones</th>
                  <th class="text-center"></th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $consultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $consulta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td class="text-center"><?php echo e($key + 1); ?></td>
                  <td class="text-center"><?php echo e(date('d/m/Y', strtotime($consulta->fecha))); ?></td>
                  <td class="text-center"><?php echo e($consulta->motivo_consulta); ?></td>
                  <td class="text-center" title="<?php echo e($consulta->diagnostico); ?>"><?php echo e(\Illuminate\Support\Str::limit($consulta->diagnostico, 50)); ?></td>
                  <td class="text-center" title="<?php echo e($consulta->observaciones); ?>"><?php echo e(\Illuminate\Support\Str::limit($consulta->observaciones, 50)); ?></td>                  <td class="d-flex align-items-center justify-content-center">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button>
                      <ul class="dropdown-menu">
                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('consultas.edit')): ?>
                          <li><a class="dropdown-item" href="<?php echo e(route('consultas.edit', $consulta->uuid)); ?>">Modificar datos</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('consultas.destroy')): ?>
                          <li>
                            <a class="dropdown-item" href="<?php echo e(route('consultas.destroy', $consulta->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar la consulta?');">
                              Eliminar Consulta
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
      $("#fecha_retiro").show().prop("required", true);
      $("#bloque, #label").show();
    } else {
      $("#fecha_retiro").hide().removeAttr("required");
      $("#label").hide();
    }
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/consultas/create.blade.php ENDPATH**/ ?>