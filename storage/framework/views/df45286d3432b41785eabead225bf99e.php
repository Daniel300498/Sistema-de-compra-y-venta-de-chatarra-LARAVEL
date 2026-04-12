
<?php $__env->startSection('titulo','DATOS REFRIGERIO'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>PLANILLA REFRIGERIO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Modificar Datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">   
            <h5 class="card-title">Modificar datos para la planilla de refrigerio</h5>
            <h3><span class="badge bg-nombre-empleado">Funcionario: <?php echo e($cargoEmpleado->empleado->nombres); ?> <?php echo e($cargoEmpleado->empleado->ap_paterno); ?> <?php echo e($cargoEmpleado->empleado->ap_materno); ?></span></h3>
      </div>
            <!--CONTENIDO -->
           <?php echo Form::model($refrigerio,['route'=>['refrigerios.update',$refrigerio],'method'=>'PUT']); ?>

                <?php echo $__env->make('refrigerios._form',['texto' => 'Actualizar','color'=>'success'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    $("#funcionario_id").select2({
        placeholder: '--SELECCIONE--',
        width: 'resolve'
    }).on('select2-open', function () {
        // Adding Custom Scrollbar
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/refrigerios/edit.blade.php ENDPATH**/ ?>