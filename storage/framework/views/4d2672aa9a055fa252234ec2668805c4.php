
<?php $__env->startSection('titulo','Documentacion'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Documentaci&oacute;n</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('historialcvs.index')); ?>">Documentaci&oacute;n</a></li>
            <li class="breadcrumb-item active">Historial Curriculum Vitae</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Actualizar Curriculum Vitae</h5>
            <p>Ingresar nombre, apellidos o carnet de identidad para buscar al empleado. Tambi&eacute;n puede obtener el listado de todos los empleados presionando el bot&oacute;n <strong>Buscar Empleado</strong>.</p>
            <form action="<?php echo e(route('buscar_empleado_historial')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row mt-3">
                    <label for="ci" class="col-md-4 col-control label text-right">Empleado</label>
                    <div class="col-lg-8">
                    <select name="ci" id="ci" class="form-control <?php echo e($errors->has('ci') ? ' error' : ''); ?>" required>
                        <option value="" selected>-- SELECCIONE --</option>
                        <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($e->id); ?>"><?php echo e($e->ci); ?> - <?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
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
<?php if($empleado != null): ?>
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleado(s) que coinciden con la busqueda</h5>
           <!--CONTENIDO -->
           <p class="mb-0">Presione sobre el botón <span class="btn btn-warning btn-sm"><i class="bi-paperclip"></i></span> para acceder al formulario de registro correpondiente.</p>
           <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar en la tabla al empleado que corresponda.</p>
               <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Nro Item</th>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">CI</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">Opción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php if($cargo): ?>
                        <td class="text-center"><?php echo e($cargo->nro_item); ?></td>
                        <?php else: ?>
                        <td class="text-center">FUNCIONARIO INACTIVO</td>
                        <?php endif; ?>
                        <td><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></td>
                        <td class="text-center"><?php echo e($empleado->ci); ?> <?php if($empleado->ci_complemento != null): ?> - <?php echo e($empleado->ci_complemento); ?> <?php endif; ?> <?php echo e($empleado->ci_lugar); ?></td>
                        <?php if($cargo): ?>
                        <td><?php echo e($cargo->nombre); ?></td>
                        <?php else: ?>
                        <td>FUNCIONARIO INACTIVO</td>
                        <?php endif; ?>
                             <td class="d-flex justify-content-center" >
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('declaraciones.create')): ?>
                                    <a href="<?php echo e(route('historialcvs.create',$empleado->uuid)); ?>" class="btn btn-warning" title="Ver / Registrar un DDJJ"><i class="bi-paperclip"></i></a>
                                <?php endif; ?>
                            </td>
                    </tr>
                </tbody>
            </table>
            <!-- EndCONTENIDO Example -->
        </div>
    </div>
</div>
</div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<script>
    $("#ci").select2({
        placeholder: '--SELECCIONE--',
        width: 'resolve'
    }).on('select2-open', function () {
        // Adding Custom Scrollbar
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/historial_cvs/consulta.blade.php ENDPATH**/ ?>