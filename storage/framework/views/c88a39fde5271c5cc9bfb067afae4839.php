<?php $__env->startSection('titulo','Comisión'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>comisiones</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Comisiones</a></li>
        <li class="breadcrumb-item active">Editar Comisión</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Modificar Datos Comisión</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
            <p class="mb-3">Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el bot&oacute;n <strong>GUARDAR</strong>. Presione el bot&oacute;n <strong>Salir</strong> si no desea realizar ninguna acci&oacute;n.</p>
            <br>
           <?php echo Form::model($comision,['route'=>['comisiones.update',$comision->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
              <div class="row">
                <div class="col-lg-4">
                  <?php echo e(Form::label('fecha_inicio','Fecha Inicio')); ?> <span class="text-danger">(*)</span>
                      <input id="fecha_inicio" type="date" class="form-control <?php echo e($errors->has('fecha_inicio') ? ' error' : ''); ?>" name="fecha_inicio" maxlength="8" value="<?php echo e($comision->fecha_inicio); ?>"  required>
                      <?php if($errors->has('fecha_inicio')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('fecha_inicio')); ?>

                          </span>
                      <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('fecha_fin','Fecha Fin')); ?> <span class="text-danger">(*)</span>
                      <input id="fecha_fin" type="date" class="form-control <?php echo e($errors->has('fecha_fin') ? ' error' : ''); ?>" name="fecha_fin" maxlength="8" value="<?php echo e($comision->fecha_fin); ?>"  required >
                      <?php if($errors->has('fecha_fin')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('fecha_fin')); ?>

                          </span>
                      <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('tipo','Tipo Jornada' )); ?> <span class="text-danger">(*)</span>
                  <select name="tipo_jornada" class="form-control" id="tipo_jornada">
                    <option value="">-- SELECCIONE --</option>
                    <option value="1" <?php echo e(old('tipo_jornada',$comision->tipo_jornada) =='1' ? 'selected' :''); ?>>Jornada Laboral</option>
                    <option value="2" <?php echo e(old('tipo_jornada',$comision->tipo_jornada) =='2' ? 'selected' :''); ?>>Jornada No Laboral</option>
                  </select>
              </div>
              </div>
              <br>
              <br>
              <br>
              <div class="row">
                <div class="col-lg-4">
                  <?php echo e(Form::label('','Tipo Comision' )); ?> <span class="text-danger">(*)</span>
                  <select name="tipo_comision" class="form-control"  id="tipo_comision">
                    <option value="">-- SELECCIONE --</option>
                    <option value="1" <?php echo e(old('tipo_comision',$comision->tipo_comision) =='1' ? 'selected' :''); ?>>Misma Cede</option>
                    <option value="2" <?php echo e(old('tipo_comision',$comision->tipo_comision) =='2' ? 'selected' :''); ?>>Distinta Cede</option>
                    <option value="3" <?php echo e(old('tipo_comision',$comision->tipo_comision) =='3' ? 'selected' :''); ?>>Exterior</option>
                  </select>
              </div>
                <?php if($comision->tipo_jornada==2): ?>
                <div class="col-lg-4">
                    <label for="hora_entrada">Hora Entrada<span class="text-danger">(*)</span></label>
                    <input id="hora_entrada" type="time" class="form-control <?php echo e($errors->has('hora_entrada') ? ' error' : ''); ?>" name="hora_entrada" value="<?php echo e($comision->hora_entrada); ?>"  required >
                    <?php if($errors->has('hora_entrada')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('hora_entrada')); ?>

                        </span>
                    <?php endif; ?>
                  </div>
                  <div class="col-lg-4">
                    <label for="hora_salida" >Hora Salida<span class="text-danger">(*)</span></label>
                    <input id="hora_salida" type="time" class="form-control <?php echo e($errors->has('hora_salida') ? ' error' : ''); ?>" name="hora_salida" value="<?php echo e($comision->hora_salida); ?>"  required >
                    <?php if($errors->has('hora_salida')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('hora_salida')); ?>

                        </span>
                    <?php endif; ?>
                  </div>   
                <?php endif; ?>
              </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('comisiones.create',$empleado->id)); ?>" class="btn btn-danger">Salir</a>
            </div>
            <?php echo Form::close(); ?>

         <br>
          </div>
        </div>
      </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/comisiones/edit.blade.php ENDPATH**/ ?>