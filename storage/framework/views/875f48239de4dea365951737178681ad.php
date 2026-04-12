<?php $__env->startSection('titulo','Comisión'); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Comisiones</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Comisiones</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Registrar Nueva Comisión</h5>
            <p class="mb-0">Ingresar el nombre, apellidos o carnet de identidad para buscar al empleado al cual se quiere asignar una comision y presionar el botón <strong>Buscar Empleado</strong>. Tambien puede obtener el listado de todos los empleados presionando el mismo botón.</p >
                  <p></p> 
                    <form action="<?php echo e(route('buscar_empleado_comisiones')); ?>" method="post">
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
           <h5 class="card-title">Empleado(s) encontrados según la b&uacute;squeda</h5>
           <p class="text-justify">Cada registro tiene la opci&oacute;n de adjuntar un documento, presionando el bot&oacute;n <span class="btn btn-warning"><i class="bi-plus-circle"></i></span> podr&aacute; acceder al formulario correspondiente.</p>
                <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
               <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">CI</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">Opción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></td>
                            <td class="text-center"><?php echo e($e->ci); ?> <?php if($e->ci_complemento != null): ?> - <?php echo e($e->ci_complemento); ?> <?php endif; ?> <?php echo e($e->ci_lugar); ?></td>
                            <td>
                                <?php echo e($e->cargo); ?>

                                 </tdclass=>
                                 <td class="d-flex justify-content-center" >
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('comisiones.create')): ?>
                                        <a href="<?php echo e(route('comisiones.create',$e->uuid)); ?>" class="btn btn-warning" title="Ver / Registrar una comision"><i class="bi-plus-circle"></i></a>
                                    <?php endif; ?>
                                </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
           <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/comisiones/consulta.blade.php ENDPATH**/ ?>