

<?php $__env->startSection('titulo','Vacaciones'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>VACACIONES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('vacaciones.index')); ?>">Ver Dias Disponibles</a></li>
        <li class="breadcrumb-item active">Registrar Solicitud de Vacaciones</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Registrar Solicitud de Vacaciones</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
           <h4 class="text-center">Dias disponibles para solicitar: <?php echo e(optional($dias_disponibles)->nro_dias_disponibles ?? 0); ?></h4>
            <p>Todos los campos son de ingreso obligatorio, para guardar la solicitud de vacaci&oacute;n debe presionar el bot&oacute;n <strong>GUARDAR</strong>. Si no desea realizar ninguna solicitud presione el bot&oacute;n <strong>SALIR</strong>.</p>
           <!--CONTENIDO -->
           <?php if($mensaje=="Vacaciones Disponibles"): ?>
           <form action="<?php echo e(route('vacaciones.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
              <div class="row mb-2">
                <div class="col-lg-4">
                  <?php echo e(Form::label('fecha_solicitud','Fecha Solicitud')); ?> <span class="text-danger">(*)</span>
                      <input id="fecha_solicitud" type="date" class="form-control <?php echo e($errors->has('fecha_solicitud') ? ' error' : ''); ?>" name="fecha_solicitud"  value="<?php echo e(old('fecha_solicitud')); ?>"  >
                      <?php if($errors->has('fecha_solicitud')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('fecha_solicitud')); ?>

                          </span>
                      <?php endif; ?>
                </div>
              </div>
              <div class="row">
                  <div class="col-lg-4">
                  <?php echo e(Form::label('jornada_laboral','Jornada Laboral' )); ?> <span class="text-danger">(*)</span>
                  <select name="jornada_laboral" class="form-control <?php echo e($errors->has('jornada_laboral') ? ' error' : ''); ?>" id="jornada_laboral" Onchange = "mostrar('num')">
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="1">Jornada Completa</option>
                    <option value="2" >Media Jornada</option>
                  </select>
                  <?php if($errors->has('jornada_laboral')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('jornada_laboral')); ?>

                          </span>
                      <?php endif; ?>
              </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('fecha_inicio','Fecha Inicio')); ?> <span class="text-danger">(*)</span>
                        <input id="fecha_inicio" type="date" class="form-control <?php echo e($errors->has('fecha_inicio') ? ' error' : ''); ?>" name="fecha_inicio" value="<?php echo e(old('fecha_inicio')); ?>"  >
                        <?php if($errors->has('fecha_inicio')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('fecha_inicio')); ?>

                            </span>
                        <?php endif; ?>
                  </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('fecha_hasta','Fecha Hasta')); ?> <span class="text-danger">(*)</span>
                      <input id="fecha_hasta" type="date" class="form-control <?php echo e($errors->has('fecha_hasta') ? ' error' : ''); ?>" name="fecha_hasta" value="<?php echo e(old('fecha_hasta')); ?>"  >
                      <?php if($errors->has('fecha_hasta')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('fecha_hasta')); ?>

                          </span>
                      <?php endif; ?>
                </div>
                
              </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <?php if(auth()->user()->rol[0]->id==4): ?>
                <a href="<?php echo e(route('vacaciones.create',auth()->user()->empleado_id)); ?>" class="btn btn-danger">Salir</a>
                <?php else: ?>
                <a href="<?php echo e(route('vacaciones.index')); ?>" class="btn btn-danger">Salir</a>
                <?php endif; ?>
            </div>
         </form>
         <?php else: ?>
         <?php
         $dias_disponibles=\App\Models\DiasDisponibles::where('empleado_id',$empleado->id)->first();
         ?>
         <h6  class="card-title text-center"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></h6>
          <h5 class="text-center"><?php echo e($mensaje); ?></h5>
         <?php endif; ?>
         <br>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/vacaciones/create.blade.php ENDPATH**/ ?>