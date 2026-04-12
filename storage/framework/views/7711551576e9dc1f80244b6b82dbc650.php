<?php $__env->startSection('titulo','Jerarquía'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>Jerarqu&iacute;as y &Aacute;reas</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Jerarqu&iacute;as y &Aacute;reas</a></li>
                <li class="breadcrumb-item active">Ver Jerarqu&iacute;as</li>
            </ol>
            </nav>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('jerarquias.create')): ?>
            <a href="<?php echo e(route('jerarquias.create')); ?>" class="btn btn-primary" title="Crea un nueva jerarquia">Agregar Nuevo</a>
        <?php endif; ?>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Jerarquías Registradas</h5>
            <p class="mb-0">Desde el men&uacute; de <strong>Opciones</strong> puede agregar una &Aacute;rea, editar o eliminar una jerarqu&iacute;a.</p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar el nivel de jerarqu&iacute;a que corresponda.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nivel Jer&aacute;rquico</th>
                     
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $jerarquias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td>
                                <small><?php echo e($e->nombre); ?></small>   
                                </td>
                                
                                <td class="d-flex justify-content-center" >
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          Opciones
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('jerarquias.edit')): ?>
                                                <li><a class="dropdown-item" href="<?php echo e(route('jerarquias.edit',$e->uuid)); ?>">Modificar Jerarqu&iacute;a</a></li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('areas.create')): ?> 
                                            <li><a class="dropdown-item" href="<?php echo e(route('areas.create',$e->uuid)); ?>">Agregar &Aacute;reas</a></li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('jerarquias.destroy')): ?>
                                            <li><a class="dropdown-item" href="<?php echo e(route('jerarquias.destroy',$e->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar la jerarqu&iacute;a?');">Eliminar Jerarqu&iacute;a</a></li>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/jerarquias/index.blade.php ENDPATH**/ ?>