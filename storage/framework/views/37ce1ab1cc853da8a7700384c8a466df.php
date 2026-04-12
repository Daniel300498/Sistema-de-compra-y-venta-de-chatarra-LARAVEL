<?php $__env->startSection('titulo','Nueva Licencia'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>LICENCIAS</h1>
    <nav>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="">Licencias</a></li>
       <li class="breadcrumb-item"><a href="<?php echo e(route('licencias.index')); ?>">Ver Registrados</a></li>
        <li class="breadcrumb-item active">Modificar Licencia</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
                <!-- TITLE -->
                <div class="d-flex align-items-center justify-content-between">
                  <h5 class="card-title">Modificar Licencia</h5>
                  <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
                </div>
                <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>
                <!--CONTENIDO -->
                <?php echo Form::model($licencia,['route'=>['licencias.update',$licencia->id,$licencia->estado_id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

                    <?php echo $__env->make('licencias._form',['texto' => 'Actualizar','color'=>'primary'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

<!--<script src="<?php echo e(asset('assets/js/forms/licenciasControlCampos.js')); ?>" type="text/javascript"></script> -->

<script src="<?php echo e(asset('assets/js/jquery-ui.js')); ?>" type="text/javascript"></script>

<script type="text/javascript">
$("#jefe_inmediato").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});
  const feriados = <?php echo json_encode($arr_feriados); ?>;

</script>



<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/edit.blade.php ENDPATH**/ ?>