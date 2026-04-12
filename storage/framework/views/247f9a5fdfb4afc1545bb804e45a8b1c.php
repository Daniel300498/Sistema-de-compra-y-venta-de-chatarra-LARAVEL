

<?php $__env->startSection('titulo','Vacaciones'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Vacaciones</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Agregar Vacación</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Agregar documento</h5>
            
           <!--CONTENIDO -->
         
           <?php if($mensaje=="Vacaciones Disponibles"): ?>
           <?php
           $dias_disponibles=\App\Models\DiasDisponibles::where('empleado_id',$empleado->id)->first();
           ?>
           <h6  class="card-title text-center"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?> TUS DIAS DISPONIBLES SON: <?php echo e($dias_disponibles->nro_dias_disponibles); ?> DIAS</h6>
           <hr >
           <form action="<?php echo e(route('vacaciones.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
              <div class="row">
                <div class="col-lg-4">
                  <?php echo e(Form::label('fecha_solicitud','Fecha Solicitud')); ?> <span class="text-danger">(*)</span>
                      <input id="fecha_solicitud" type="date" class="form-control <?php echo e($errors->has('fecha_solicitud') ? ' error' : ''); ?>" name="fecha_solicitud"  value="<?php echo e(old('fecha_solicitud')); ?>"  required >
                      <?php if($errors->has('codigo')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('codigo')); ?>

                          </span>
                      <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('fecha_inicio','Fecha Inicio')); ?> <span class="text-danger">(*)</span>
                        <input id="fecha_inicio" type="date" class="form-control <?php echo e($errors->has('fecha_inicio') ? ' error' : ''); ?>" name="fecha_inicio" value="<?php echo e(old('fecha_inicio')); ?>"  required >
                        <?php if($errors->has('fecha_inicio')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('fecha_inicio')); ?>

                            </span>
                        <?php endif; ?>
                  </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-4">
                  <?php echo e(Form::label('fecha_hasta','Fecha Hasta')); ?> <span class="text-danger">(*)</span>
                      <input id="fecha_hasta" type="date" class="form-control <?php echo e($errors->has('fecha_hasta') ? ' error' : ''); ?>" name="fecha_hasta" value="<?php echo e(old('fecha_hasta')); ?>"  required >
                      <?php if($errors->has('fecha_hasta')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('fecha_hasta')); ?>

                          </span>
                      <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('jornada_laboral','Jornada Laboral' )); ?> <span class="text-danger">(*)</span>
                  <select name="jornada_laboral" class="form-control" required id="jornada_laboral" Onchange = "mostrar('num')">
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="1">Jornada Completa</option>
                    <option value="2" >Media Jornada</option>
                  </select>
              </div>
              </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn back-color-second">Guardar</button>
                <?php if(auth()->user()->rol[0]->id==4): ?>
                <a href="<?php echo e(route('vacaciones.create',auth()->user()->empleado_id)); ?>" class="btn back-color-first">Salir</a>
                <?php else: ?>
                <a href="<?php echo e(route('vacaciones.index')); ?>" class="btn back-color-first">Salir</a>
                <?php endif; ?>
            </div>
         </form>
         <?php else: ?>
         <?php
         $dias_disponibles=\App\Models\DiasDisponibles::where('empleado_id',$empleado->id)->first();
         ?>
         <h6  class="card-title text-center"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></h6>
         <h1 class="text-center"><?php echo e($mensaje); ?></h1>
         <?php endif; ?>
         <br>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/vacaciones/create.blade.php ENDPATH**/ ?>