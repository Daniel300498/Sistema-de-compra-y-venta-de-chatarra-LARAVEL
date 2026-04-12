
<?php $__env->startSection('titulo','Pacientes'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>     
            <h1>REGISTRO PACIENTES</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="">Registro Pacientes</a></li>
                    <li class="breadcrumb-item active">Ver Todos</li>
                </ol>
            </nav>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pacientes.create')): ?>
            <a href="<?php echo e(route('pacientes.create')); ?>" class="btn btn-primary MB-3">Registrar Paciente</a>
        <?php endif; ?>
    </div>
</div>
 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pacientes Registrados</h5>
                            <div class="table-responsive">
                                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">CI</th>
                                            <th class="text-center">Nombre Completo</th>
                                            <th class="text-center">Fecha de Nacimiento</th>
                                            <th class="text-center">Numero de Celular</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                     <td class="text-center"><?php echo e($e->ci); ?> <?php if(!$e->ci_complemento): ?> - <?php echo e($e->ci_complemento); ?> <?php endif; ?> <?php echo e($e->ci_lugar); ?></td>
                                                    <td><?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></td>
                                                    <td><?php echo e($e->fecha_nacimiento); ?></td>
                                                    <td><?php echo e($e->nro_celular); ?></td>
                                                       <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Opciones
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pacientes.edit')): ?>
                                                                        <li><a class="dropdown-item" href="<?php echo e(route('pacientes.edit',$e->uuid)); ?>">Modificar Datos</a></li>
                                                                    <?php endif; ?>

                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pacientes.destroy')): ?>
                                                                        <li><a class="dropdown-item" href="<?php echo e(route('pacientes.destroy',$e->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar al paciente?');">Eliminar Paciente</a></li>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/pacientes/index.blade.php ENDPATH**/ ?>