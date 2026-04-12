

<?php $__env->startSection('titulo','Asignacion Turno'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Asignacion Turno</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="">Asignacion Turno</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('memorandums.create')): ?>
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Asignar Turno A Empleado</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
            <p>Una vez rellenado los campos correspondientes presione el bot&oacute;n <strong>GUARDAR</strong>. Presione el bot&oacute;n <strong>Salir</strong> si no desea realizar ninguna acci&oacute;n.</p>
            <form action="<?php echo e(route('asignacion_turno.store',$empleado->id)); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>" >

              <div class="row mb-3">
                <div class="col-lg-2">
                </div>
                  <div class="col-lg-4">
                    <?php echo e(Form::label('fecha_inicial','Fecha Inicial')); ?> <span class="text-danger">(*)</span>
                        <input id="fecha_inicial" type="date" class="form-control <?php echo e($errors->has('fecha_inicial') ? ' error' : ''); ?>" name="fecha_inicial" value="<?php echo e(old('fecha_inicial')); ?>"   >
                        <?php if($errors->has('fecha_inicial')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('fecha_inicial')); ?>

                            </span>
                        <?php endif; ?>
                  </div>
                  <div class="col-lg-4">
                    <?php echo e(Form::label('fecha_final','Fecha Final')); ?> <span class="text-danger">(*)</span>
                        <input id="fecha_final" type="date" class="form-control <?php echo e($errors->has('fecha_final') ? ' error' : ''); ?>" name="fecha_final" value="<?php echo e(old('fecha_final')); ?>"   >
                        <?php if($errors->has('fecha_final')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('fecha_final')); ?>

                            </span>
                        <?php endif; ?>
                  </div>
                  <div class="col-lg-2">
                </div>
              </div>  
              <div class="row mb-3">
              <div class="col-lg-2">
              </div>
                  <div class="col-lg-4">
                    <?php echo e(Form::label('tipo','Tipo Turno' )); ?> <span class="text-danger">(*)</span>
                    <select name="turno_id" id="turno_id" class="form-control <?php echo e($errors->has('turno_id') ? ' error' : ''); ?>">
                      <option value="">-- SELECCIONE --</option>
                      <?php $__currentLoopData = $turno; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ho): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($ho->id); ?>" <?php echo e(old('turno_id')==$ho->id ? 'selected' :''); ?>><?php echo e($ho->nombre); ?></option> 
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('turno_id')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('turno_id')); ?>

                        </span>
                    <?php endif; ?>
                  </div>

                  <div class="col-lg-4">
                    <?php echo e(Form::label('device_id','Biometrico' )); ?> <span class="text-danger">(*)</span>
                    <select name="device_id" id="device_id" class="form-control <?php echo e($errors->has('device_id') ? ' error' : ''); ?>">
                      <option value="">-- SELECCIONE --</option>
                      <?php $__currentLoopData = $biometricos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $biometrico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($biometrico->id); ?>" <?php echo e(old('device_id')==$biometrico->id ? 'selected' :''); ?>><?php echo e($biometrico->alias); ?></option> 
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('device_id')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('device_id')); ?>

                        </span>
                    <?php endif; ?>
                  </div>




                  <div class="col-lg-2">
                </div>
              </div>     
              <div class="text-center mt-3">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <a href="<?php echo e(route('memorandums.index')); ?>" class="btn btn-danger">Salir</a>
              </div>
             
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php if(count($asignacion_horario)>0): ?>
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <!--CONTENIDO -->
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Turnos registrados</h5>
             
            </div>
          
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
                <thead>
                  <tr>
                    <th class="text-center">Nro</th>
                    <th class="text-center">Nombre Completo</th>
                    <th class="text-center">Fecha Inicial</th>
                    <th class="text-center">Fecha Final</th>
                    <th class="text-center">Turno</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $asignacion_horario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="text-center"><?php echo e($key+1); ?></td>
                     
                      <td class="text-center">
                        <?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?>

                    
                    </td>
                      <td class="text-center">
                          <?php echo e($document->fecha_inicial); ?>

                      
                      </td>
                      <td class="text-center">
                        <?php echo e($document->fecha_final); ?>

                         
        
                      </td>
                     
                      <td class="text-center">
                        <?php echo e($document->turno->nombre); ?>

                      
                      </td>
                      
                      
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
              <br><br>
            </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
  </section>
<?php else: ?>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">NO TIENE TURNO ASIGNADO</h5>
        </div>
      </div>
    </div>
  </div>

</section>

<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/asignacion_turno/create.blade.php ENDPATH**/ ?>