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
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Registrar Solicitud de Vacaciones</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
            <h4 class="text-center">Dias disponibles para solicitar: <?php echo e($dias_disponibles->nro_dias_disponibles); ?></h4>
            <p>Todos los campos son de ingreso obligatorio, para guardar la solicitud de vacación debe presionar el botón <strong>GUARDAR</strong>. Si no desea realizar ninguna solicitud presione el botón <strong>SALIR</strong>.</p>
           <!--CONTENIDO -->
          
           <hr >
           <br>
           <?php echo Form::model($vacacion,['route'=>['vacaciones.update',$vacacion->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($vacacion->empleado_id); ?>">
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
               
              </div>
              <br>
              <br>
              <br>
              <br>
              <div class="row">
                   <div class="col-lg-4">
                    <?php echo e(Form::label('fecha_inicio','Fecha Inicio')); ?> <span class="text-danger">(*)</span>
                        <input id="fecha_inicio" type="date" class="form-control <?php echo e($errors->has('fecha_inicio') ? ' error' : ''); ?>" name="fecha_inicio" value="<?php echo e(old('fecha_inicio',$vacacion->fecha_inicio)); ?>"  required >
                        <?php if($errors->has('fecha_inicio')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('fecha_inicio')); ?>

                            </span>
                        <?php endif; ?>
                  </div>
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
                  <?php echo e(Form::label('jornada_laboral','Jornada Laboral' )); ?> <span class="text-danger">(*)</span>
                  <select name="jornada_laboral" class="form-control" required id="jornada_laboral" Onchange = "mostrar('num')">
                    <?php if($jornada==1): ?>
                    <option value="" >-- SELECCIONE --</option>
                    <option value="1" selected>Jornada Completa</option>
                    <option value="2" >Media Jornada</option>
                    <?php else: ?>
                    <option value="" >-- SELECCIONE --</option>
                    <option value="1">Jornada Completa</option>
                    <option value="2" selected>Media Jornada</option>
                        
                    <?php endif; ?>
                    
                  </select>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/vacaciones/edit.blade.php ENDPATH**/ ?>