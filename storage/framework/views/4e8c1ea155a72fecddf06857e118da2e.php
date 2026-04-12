

<?php $__env->startSection('titulo','Nueva Licencia'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>LICENCIAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('empleados.index')); ?>">Licencias</a></li>
        <li class="breadcrumb-item active">Peticion Licencia</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <br>

                <!-- TITLE -->
                <h2 class="card-title">Nueva Solicitud de Licencia</h2>
                
                <h6 class="text-right"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></h6>
                <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>

                <!--CONTENIDO -->
                <?php echo Form::open(['route'=>'licencias.store','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

                    <?php echo $__env->make('licencias._form',['texto' => 'Registrar','color'=>'primary'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo Form::close(); ?>

                <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<link href="http://t4t5.github.io/sweetalert/dist/sweetalert.css" rel="stylesheet"/>
<script src="http://t4t5.github.io/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo e(asset('assets/js/forms/licenciasControlCampos.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/jquery-ui.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
  const feriados = <?php echo json_encode($arr_feriados); ?>;
</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/licencias/create.blade.php ENDPATH**/ ?>