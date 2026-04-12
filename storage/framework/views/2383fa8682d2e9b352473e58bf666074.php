<?php $__env->startSection('titulo','Permisos de Rol'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Permisos de Accesso</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Permisos del rol</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Permisos habilitados para el rol <strong><?php echo e($role->name); ?></strong></h5>
              <a href="<?php echo e(route('roles.index')); ?>" class="btn back-color-first btn-rounded">Volver</a>
            </div>
            <hr>
           <!--CONTENIDO -->
           
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <?php $__currentLoopData = $grupos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont_grupo=>$grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-<?php echo e($cont_grupo); ?>" aria-expanded="false" aria-controls="flush-collapseOne-<?php echo e($cont_grupo); ?>">
                            <?php echo e($cont_grupo + 1); ?> - GESTIÓN DE <?php echo e($grupo->grupo); ?>

                        </button>
                    </h2>
                    <div id="flush-collapseOne-<?php echo e($cont_grupo); ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <ul class="list-unstyled">
                           
                            <?php $cont=0; ?>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($permission->grupo==$grupo->grupo): ?>
                            <?php $cont=$cont+1; ?>
                            <li>
                                <label>
                                    <?php echo e($permission->descripcion ?: 'Sin descripción'); ?>

                                    <em>(<?php echo e($permission->name); ?>)</em>
                                </label>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="text-center">
              <a href="<?php echo e(route('roles.index')); ?>" class="btn back-color-first btn-rounded">Volver</a>
            </div>
          </div>
 
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/roles/show.blade.php ENDPATH**/ ?>