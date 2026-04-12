

<?php $__env->startSection('titulo','Turnos'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>TURNOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
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
              <h5 class="card-title">Actualizar Turnos</h5>
              
            </div>
            <p>Todos los campos marcados con <span class="text-danger">(*)</span> son de ingreso obligatorio. Una vez rellenado los campos correspondientes presione el botón <strong>GUARDAR</strong>. Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.</p>
           <!--CONTENIDO -->
           <form action="<?php echo e(route('turnos.update')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            
            <input type="hidden" name="id" id="id" value="<?php echo e($turno->id); ?>">
            <div class="row">
              <div class="col-lg-4">
                <?php echo e(Form::label('empresa','Empresa' )); ?> <span class="text-danger">(*)</span>
                <input id="empresa" type="text" class="form-control <?php echo e($errors->has('empresa') ? ' error' : ''); ?>" name="empresa" value="<?php echo e($turno->empresa); ?>" readonly >
                <?php if($errors->has('empresa')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('empresa')); ?>

                    </span>
                <?php endif; ?>
            </div>
              <div class="col-lg-4">
                <?php echo e(Form::label('nombre','Nombre' )); ?> <span class="text-danger">(*)</span>
                <input id="nombre" type="text" class="form-control <?php echo e($errors->has('nombre') ? ' error' : ''); ?>" name="nombre" value="<?php echo e($turno->nombre); ?>" >
                <?php if($errors->has('nombre')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('nombre')); ?>

                    </span>
                <?php endif; ?>
            </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('unidad','Unidad' )); ?> <span class="text-danger">(*)</span>
                    <select name="unidad" class="form-control <?php echo e($errors->has('unidad') ? ' error' : ''); ?>" id="unidad">
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="1" <?php echo e(old('unidad',$turno->unidad ) =='1' ? 'selected' :''); ?>>Dia</option>
                    <option value="2" <?php echo e(old('unidad',$turno->unidad ) =='2' ? 'selected' :''); ?>>Semana</option>
                    <option value="3" <?php echo e(old('unidad',$turno->unidad ) =='3' ? 'selected' :''); ?>>Mes</option>
                    </select>
                    <?php if($errors->has('unidad')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('unidad')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                

              
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <?php echo e(Form::label('ciclo','Ciclo' )); ?> <span class="text-danger">(*)</span>
                  <input id="ciclo" type="number" class="form-control <?php echo e($errors->has('ciclo') ? ' error' : ''); ?>" name="ciclo" value="<?php echo e($turno->ciclo); ?>" >
                  <?php if($errors->has('ciclo')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('ciclo')); ?>

                      </span>
                  <?php endif; ?>
              </div>
                
              <div class="col-lg-4">
                <label for="cargo_id">Tipo Horario</label>
                <select name="horario_id" id="horario_id" class="form-control <?php echo e($errors->has('horario_id') ? ' error' : ''); ?>">
                  <option value="">-- SELECCIONE --</option>
                  <?php $__currentLoopData = $horario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ho): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($ho->id); ?>" <?php echo e(old('horario_id',$turno->horario_id) == $ho->id ? 'selected' :''); ?>><?php echo e($ho->nombre); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                </select>
                <?php if($errors->has('horario_id')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('horario_id')); ?>

                    </span>
                <?php endif; ?>
              </div>
              </div>
              
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('declaraciones.index')); ?>" class="btn btn-danger">Salir</a>
            </div>
         </form>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
    
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/turnos/edit.blade.php ENDPATH**/ ?>