
<?php $__env->startSection('titulo', 'Cargos Asignados'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Cargos asignados</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Cargos Asignados</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listado de cargos asignados a los empleados</h5>
                    <p>En esta sección aparecerán los empleados con cargos asignados actualmente, es decir el personal <strong> ACTIVO</strong> de la institución.</p>
                    Desde <strong>Opciones</strong> puede declarar el item en acéfalo, es decir retirar al empleado de su cargo.
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="datos">
                            <thead>
                                <tr>
                                    <th class="text-center">NRO DE ITEM</th>
                                    <th class="text-center">EMPLEADO</th>
                                    <th class="text-center">CARGO</th>
                                    <th class="text-center">FECHA INICIO</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cargoEmpleado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ce): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <tr>    
                                            <td><?php echo e($ce->cargo->nro_item); ?></td>    
                                            <td><?php echo e($ce->empleado->ap_paterno); ?> <?php echo e($ce->empleado->ap_materno); ?> <?php echo e($ce->empleado->nombres); ?></td>
                                            <td><?php echo e($ce->cargo->nombre); ?></td>
                                            <td><?php echo e(date('d-m-y', strtotime($ce->fecha_inicio))); ?></td>
                                            <td class="d-flex justify-content-center">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Opciones
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargoEmpleados.store_liberar')): ?>
                                                               <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#liberarItemModal-<?php echo e($ce->id); ?>">Liberar Item</a></li>                                                        
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php echo $__env->make('cargoEmpleados.modals._modal_acefalo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargoEmpleados/index.blade.php ENDPATH**/ ?>