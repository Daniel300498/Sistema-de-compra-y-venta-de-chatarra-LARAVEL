
<?php $__env->startSection('titulo','Clientes'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>     
            <h1>REGISTRO DE CLIENTES</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="">Registro Clientes</a></li>
                    <li class="breadcrumb-item active">Ver Todos</li>
                </ol>
            </nav>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clientes.create')): ?>
            <a href="<?php echo e(route('clientes.create')); ?>" class="btn btn-primary MB-3">+ Nuevo Cliente</a>
        <?php endif; ?>
    </div>
</div>
 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Clientes Registrados</h5>
                            <div class="table-responsive">
                                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NOMBRE</th>
                                            <th class="text-center">NIT / RUC / CI</th>
                                            <th class="text-center">Pais</th>
                                            <th class="text-center">Tel&eacute;fono</th>
                                             <th class="text-center">Direcci&oacute;n</th>
                                            <th class="text-center">Correo Electr&oacute;nico</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($c->nombre); ?></td>
                                                    <td><?php echo e($c->nit); ?></td>
                                                    <td><?php echo e($c->pais); ?></td>
                                                    <td><?php echo e($c->telefono); ?></td>
                                                    <td><?php echo e($c->direccion); ?></td>
                                                    <td><?php echo e($c->email); ?></td>  
                                                        <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Opciones
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clientes.edit')): ?>
                                                                        <li><a class="dropdown-item" href="<?php echo e(route('clientes.edit',$c->uuid)); ?>">Modificar Datos</a></li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clientes.destroy')): ?>
                                                                        <li><a class="dropdown-item" href="<?php echo e(route('clientes.destroy',$c->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar al cliente?');">Eliminar Cliente</a></li>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/clientes/index.blade.php ENDPATH**/ ?>