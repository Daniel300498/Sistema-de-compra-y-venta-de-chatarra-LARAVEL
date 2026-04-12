
<?php $__env->startSection('titulo', 'Cargos Acefalos'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Cargo de Empleados</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('cargoEmpleados.acefalo_index')); ?>">Cargo de Empleados</a></li>
            <li class="breadcrumb-item active">Cargos Ac&eacute;falos</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listado de cargos ac&eacute;falos (vacantes)</h5>
                    <p>En esta sección aparecerán los cargos que no están asignados a ningún empleado. Para asignarlo a uno presione en <strong>Opciones->Agregar a Empleado</strong>
                    de la fila correspondiente al cargo que desea asignar a algun usuario.</p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="datos">
                            <thead>
                                <tr>
                                    <th class="text-center">NÚMERO DE ITEM</th>
                                    <th class="text-center">DENOMINACI&Oacute;N DEL CARGO</th>
                                    <th class="text-center">&Aacute;REA</th>
                                    <th class="text-center">CARGO</th>
                                    <th class="text-center">SUELDO</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $acefalos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cargo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if($cargo->nro_item): ?>                                       
                                        <td class="text-center"><?php echo e($cargo->nro_item); ?></td>
                                        <?php else: ?>
                                        <td class="text-center"><?php echo e($cargo->tipo_cargo); ?></td>
                                        <?php endif; ?>
                                        <td class="text-center"><?php echo e($cargo->denominacion_cargo_nombre); ?></td>
                                        <td class="text-center"><?php echo e($cargo->area_nombre); ?></td>
                                        <td class="text-center"><?php echo e($cargo->nombre); ?></td>
                                        <td class="text-center"><?php echo e($cargo->sueldo); ?></td>
                                        <td class="d-flex justify-content-center">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargoEmpleados.asignar')): ?>
                                                    <li><a class="dropdown-item" href="<?php echo e(route('cargoEmpleados.asignar',$cargo->uuid)); ?>">Agregar a Empleado</a></li>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargoEmpleados/acefalos_index.blade.php ENDPATH**/ ?>