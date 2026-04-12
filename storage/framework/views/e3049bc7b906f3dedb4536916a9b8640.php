<?php $__env->startSection('titulo','Kardex'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>KARDEX</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
           <li class="breadcrumb-item"><a href="">Kardex</a></li>
        <li class="breadcrumb-item active">Archivo Digital</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Consultar Kardex de Empleados</h5>
            <p>Para ver el archivo digital del kardex de un empleado ingrese el nombre o ci del empleado y presione el bot&oacute;n <strong>Buscar Empleado</strong>. Tambi&eacute;n puede obtener el listado de todos los empleados presionando el bot&oacute;n <strong>Buscar Empleados.</strong> </p>
            
            <form action="<?php echo e(route('buscar_empleado_kardex')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <label for="nombre" class="col-md-4 col-control label text-right">Nombre Empleado</label>
                    <div class="col-lg-8">
                        <input type="text" name="nombre" id="nombre" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="ci" class="col-md-4 col-control label text-right">C.I.</label>
                    <div class="col-lg-8">
                        <input type="text" name="ci" id="ci" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary">Buscar Empleado</button>
                    </div>
                </div>
            </form>
           
          </div>
        </div>
      </div>
    </div>
</section>
<?php if($empleados != null): ?>
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
                <h5 class="card-title">Listado de Empleado(s) que coinciden con la busqueda</h5>
                <p class="mb-0">Para ver el archivo correspondiente presione sobre el botón <span class="btn btn-warning btn-sm"><i class="bi-file-earmark-person"></i></span></p>
                <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
                <div class="table-responsive">
                    <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Nro Item</th>
                                <th class="text-center">Nombre Completo</th>
                                <th class="text-center">C.I.</th>
                                <th class="text-center">Cargo</th>
                                <th class="text-center">&Aacute;rea</th>
                                <th class="text-center">Opci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($e->nro_item); ?></td>
                                    <td><?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></td>
                                    <td class="text-center"><?php echo e($e->ci); ?> <?php if($e->ci_complemento != null): ?> - <?php echo e($e->ci_complemento); ?> <?php endif; ?> <?php echo e($e->ci_lugar); ?></td>
                                    <td>
                                        <?php echo e($e->cargo); ?> (<small><?php echo e($e->tipo_cargo); ?></small>)
                                    </td>
                                    <td><?php echo e($e->area); ?></td>    
                                    <td class="d-flex justify-content-center" >
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('archivo_digital.show')): ?>
                                            <a href="<?php echo e(route('archivo_digital.show',$e->uuid)); ?>" class="btn btn-warning" title="Ver Kardex Digital del empleado"><i class="bi bi-file-earmark-person"></i></a>
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
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/kardex/archivo_digital/index.blade.php ENDPATH**/ ?>