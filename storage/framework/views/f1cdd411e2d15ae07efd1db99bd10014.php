
<?php $__env->startSection('titulo','Años de Servicio'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>KARDEX</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Kardex</a></li>
            <li class="breadcrumb-item active">Años de Servicio</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleados Registrados</h5>
            <p>Para adjuntar los documentos de años de servicio debe presionar en el botón <span class="btn btn-warning btn-sm"><i class="bi-paperclip"></i></span></p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nro Item</th>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">CI</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Area</th>
                            <th class="text-center">Opción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($e->cargo->nro_item); ?></td>
                                <td> <?php echo e($e->empleado->nombres); ?> <?php echo e($e->empleado->ap_paterno); ?> <?php echo e($e->empleado->ap_materno); ?></td>
                                <td class="text-center"><?php echo e($e->empleado->ci); ?></td>
                                <td><?php echo e($e->cargo->nombre); ?> </td>
                                <td><?php echo e($e->cargo->area->nombre); ?></td>
                                <td class="d-flex justify-content-center" >
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('servicio_años.create')): ?>
                                        <a href="<?php echo e(route('años_servicio.create',$e->empleado->uuid)); ?>" class="btn btn-warning" title="Ver / Registrar Años de servicio"><i class="bi-paperclip"></i></a>
                                    <?php endif; ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/kardex/años_servicio/empleados.blade.php ENDPATH**/ ?>