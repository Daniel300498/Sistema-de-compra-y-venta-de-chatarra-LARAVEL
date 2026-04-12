

<?php $__env->startSection('titulo','Tiempo De Descanso'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>TIEMPO DESCANSO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('tiempo_descanso.index')); ?>">Tiempo Descanso</a></li>
        <li class="breadcrumb-item active">Ver Todos</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <!--CONTENIDO -->
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Tiempo Descanso Registrados</h5>
          </div>
          <p>Desde esta secci&oacute;n puede modificar y eliminar el tiempo de descanso correspondiente
            <?php if(count($tiempo_descanso) > 0): ?>
            , se accede a estas opciones desde el bot&oacute;n <strong>Opciones</strong>.
            <?php endif; ?>
          </p>
            
        
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" id="datos">
              <thead>
                <tr>
                  <th class="text-center">Nro</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Hora Inicial</th>
                  <th class="text-center">Hora Final</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $tiempo_descanso; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$tiempo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td class="text-center"><?php echo e($key+1); ?></td>
                    
                    <td class="text-center">
                        <?php echo e($tiempo->nombre); ?>

                    
                    </td>
                    <td class="text-center">
                      <?php echo e($tiempo->hora_inicial); ?>

                       
                    
                    </td>
                    <td class="text-center">
                      <?php echo e($tiempo->hora_final); ?>

                    </td>
                    <td class="text-center">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tiempo_descanso.edit')): ?>
                        <a href="<?php echo e(route('tiempo_descanso.edit',$tiempo->id )); ?>" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                      <?php endif; ?>
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tiempo_descanso.destroy')): ?>
                        <a class="btn btn-danger" href="<?php echo e(route('tiempo_descanso.destroy',$tiempo->id)); ?>" onclick="return confirm('¿Está seguro que desea eliminar el registro?');"><i class="bi bi-trash"></i></a>
                      <?php endif; ?>
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<script>
  
</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/tiempo_descanso/index.blade.php ENDPATH**/ ?>