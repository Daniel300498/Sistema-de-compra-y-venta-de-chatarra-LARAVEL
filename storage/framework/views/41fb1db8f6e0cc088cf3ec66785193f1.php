
<?php $__env->startSection('titulo','proveedores'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>     
            <h1>REGISTRO proveedores</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="">Registro proveedores</a></li>
                    <li class="breadcrumb-item active">Ver Todos</li>
                </ol>
            </nav>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proveedores.create')): ?>
            <a href="<?php echo e(route('proveedores.create')); ?>" class="btn btn-primary MB-3">+ Nuevo Proveedor</a>
        <?php endif; ?>
    </div>
</div>
 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Proveedores Registrados</h5>
                            <div class="table-responsive">
                                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            
                                            <th class="text-left">Nombre</th>
                                            <th class="text-left">CI /NIT / RUC</th>
                                            <th class="text-left">Pais</th>
                                            <th class="text-left">Teléfono</th>
                                            <th class="text-left">Email</th>
                                            <th class="text-left">Dirección</th>
                                            <th class="text-left">Tipo de Producto</th>
                                            <th class="text-left">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                     <td class="text-left"><?php echo e($e->nombre); ?></td>
                                                    <td class="text-left"><?php echo e($e->nit); ?></td>
                                                    <td class="text-left"><?php echo e($e->pais); ?></td>
                                                    <td class="text-left"><?php echo e($e->telefono); ?></td>
                                                    <td class="text-left"><?php echo e($e->email); ?></td>
                                                    <td class="text-left"><?php echo e($e->direccion); ?></td>
                                                    <td class="text-left"><?php echo e($e->tipo_producto); ?></td>
                                                       <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Opciones
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proveedores.edit')): ?>
                                                                        <li><a class="dropdown-item" href="<?php echo e(route('proveedores.edit',$e->uuid)); ?>">Modificar Datos</a></li>
                                                                    <?php endif; ?>

                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proveedores.destroy')): ?>
                                                                        <li><a class="dropdown-item" href="<?php echo e(route('proveedores.destroy',$e->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar al proveedor?');">Eliminar Proveedor</a></li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/proveedores/index.blade.php ENDPATH**/ ?>