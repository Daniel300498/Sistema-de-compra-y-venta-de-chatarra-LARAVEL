
<?php $__env->startSection('titulo','Vacaciones'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>Vacaciones</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Vacaciones</a></li>
            <li class="breadcrumb-item active">Ver D&iacute;as Disponibles</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Ver D&iacute;as Disponibles para Solicitar Vacaciones</h5>
            <p>Seleccione al empleado para observar si cuenta con d&iacute;as disponibles para el registro de vacaci&oacute;n.</p>
            <form action="<?php echo e(route('vacaciones_buscar_empleado')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row mt-3">
                    <label for="ci" class="col-md-4 col-control label text-right">Empleado</label>
                    <div class="col-lg-8">
                    <select name="ci" id="ci" class="form-control <?php echo e($errors->has('ci') ? ' error' : ''); ?>" required>
                        <option value="" selected>-- SELECCIONE --</option>
                        <?php $__currentLoopData = $todosempleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($e->id); ?>"><?php echo e($e->ci); ?> - <?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary">Consultar</button>
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
              <?php if($mensaje  == "ITEM"): ?>
            <div class="table-responsive">  
            <h5 class="card-title">Datos de la consulta</h5>
            <p class="">Para ingresar la solicitud de vacaci&oacute;n debe presionar sobre el bot&oacute;n <strong>SOLICITAR VACACI&Oacute;N</strong></p>
            <table cellspacing="0" width="100%" class="table table-hover table-bordered table-sm">
             <thead>
                 <tr>
                     <th class="text-center">Nombre Completo</th>
                     <th class="text-center">C.I.</th>
                     <th class="text-center">Cargo</th>
                     <th class="text-center">D&iacute;as Disponibles</th>
                     <th class="text-center">Opci&oacute;n</th>
                 </tr>
             </thead>
             <tbody>
                <tr>
                    <td><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></td>
                    <td class="text-center"><?php echo e($empleado->ci); ?> <?php if($empleado->ci_complemento != null): ?> - <?php echo e($empleado->ci_complemento); ?> <?php endif; ?> <?php echo e($empleado->ci_lugar); ?></td>
                    
                    <td class="text-center">
                        <strong><?php echo e($cargo->nombre); ?></strong>
                    </td>
                    <?php if($dias_disponibles!=null): ?>
                    <td class="text-center"><h5><span class="badge bg-secondary"><?php echo e($dias_disponibles->nro_dias_disponibles); ?></span></h5></td>
                    <td class="d-flex justify-content-center" >
                        <a href="<?php echo e(route('vacaciones.create',$empleado->uuid)); ?>" class="btn btn-primary" title="Modificar datos" <?php if(true): echo 'disabled'; endif; ?>>Solicitar Vacaci&oacute;n</a>  
                    </td>
                    <?php else: ?>
                    <td class="text-center"><h6><span class="badge bg-secondary">D&Iacute;AS NO DISPONIBLES</span></h6></td>
                    <td class="text-center"></td>
                    <?php endif; ?>
                </tr>
             </tbody>
         </table>
         <?php else: ?>
         <br>
         <h3>NO TIENE ACCESO A VACACIONES</h3>
         <?php endif; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/vacaciones/consulta.blade.php ENDPATH**/ ?>