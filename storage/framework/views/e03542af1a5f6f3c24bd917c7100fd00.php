<?php $__env->startSection('titulo','Sala'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>Salas y Camas</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Salas y Camas</a></li>
                <li class="breadcrumb-item active">Ver Salas</li>
            </ol>
            </nav>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salas.create')): ?>
            <a href="<?php echo e(route('salas.create')); ?>" class="btn btn-primary" title="Crea un nueva sala">Agregar Nuevo</a>
        <?php endif; ?>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Salas Registradas</h5>
            <p class="mb-0">Desde el men&uacute; de <strong>Opciones</strong> puede agregar una cama, editar o eliminar una sala.</p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar la sala que corresponda.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Piso</th>
                            <th class="text-center">Nombre de la Sala</th>
                            <th class="text-center">Tipo de Sala</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td class="text-center"><small><?php echo e($e->piso); ?></small> </td>
                            <td class="text-center"><small><?php echo e($e->nombre); ?></small> </td>
                            <td class="text-center"><small><?php echo e($e->tipo); ?></small> </td>
                                
                                <td class="d-flex justify-content-center" >
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          Opciones
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salas.edit')): ?>
                                                <li><a class="dropdown-item" href="<?php echo e(route('salas.edit',$e->uuid)); ?>">Modificar Sala</a></li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('camas.create')): ?> 
                                            <li><a class="dropdown-item" href="<?php echo e(route('camas.create',$e->uuid)); ?>">Agregar Camas</a></li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salas.destroy')): ?>
                                            <li><a class="dropdown-item" href="<?php echo e(route('salas.destroy',$e->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar la sala?');">Eliminar Sala</a></li>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/salas/index.blade.php ENDPATH**/ ?>