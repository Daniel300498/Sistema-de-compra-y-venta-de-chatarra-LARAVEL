

<?php $__env->startSection('titulo','Vacaciones'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Vacaciones</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Editar Vacacion</li>
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
          
           <hr >
           <?php echo Form::model($vacacion,['route'=>['vacaciones.update',$vacacion->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($vacacion->id); ?>">
              <div class="row">
                <div class="col-lg-4">
                  <?php echo e(Form::label('fecha_solicitud','Fecha Solicitud')); ?> <span class="text-danger">(*)</span>
                      <input id="fecha_solicitud" type="date" class="form-control <?php echo e($errors->has('fecha_solicitud') ? ' error' : ''); ?>" name="fecha_solicitud"   value="<?php echo e(old('fecha_solicitud',$vacacion->fecha_solicitud)); ?>"  required >
                      <?php if($errors->has('codigo')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('codigo')); ?>

                          </span>
                      <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('fecha_inicio','Fecha Inicio')); ?> <span class="text-danger">(*)</span>
                        <input id="fecha_inicio" type="date" class="form-control <?php echo e($errors->has('fecha_inicio') ? ' error' : ''); ?>" name="fecha_inicio" value="<?php echo e(old('fecha_inicio',$vacacion->fecha_inicio)); ?>"  required >
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
                      <input id="fecha_hasta" type="date" class="form-control <?php echo e($errors->has('fecha_hasta') ? ' error' : ''); ?>" name="fecha_hasta" value="<?php echo e(old('fecha_hasta',$vacacion->fecha_hasta)); ?>"  required >
                      <?php if($errors->has('fecha_hasta')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('fecha_hasta')); ?>

                          </span>
                      <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('estado','Estado')); ?> <span class="text-danger">(*)</span>
                        <input id="estado" type="text" class="form-control <?php echo e($errors->has('estado') ? ' error' : ''); ?>" name="estado" value="<?php echo e(old('estado',$vacacion->estado)); ?>"  required >
                        <?php if($errors->has('estado')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('estado')); ?>

                            </span>
                        <?php endif; ?>
                  </div>
                

              </div>
      
            <div class="text-center mt-3">
                <button type="submit" class="btn back-color-second">Guardar</button>
                <a href="<?php echo e(route('vacaciones.vacaciones_solicitadas')); ?>" class="btn back-color-first">Salir</a>
            </div>
            <?php echo Form::close(); ?>

         <br>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/vacaciones/edit.blade.php ENDPATH**/ ?>