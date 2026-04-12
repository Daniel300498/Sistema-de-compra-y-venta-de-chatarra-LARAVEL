<?php $__env->startSection('titulo','Discapacidad'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>REGISTRO DISCAPACIDAD</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Editar documento</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Modificar Adjunto de Discapacidad</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>

                <!--CONTENIDO -->
                <?php echo Form::model($empleado,['route'=>['discapacidades.update',[$discapacidad, $empleado]],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

                    <?php echo $__env->make('discapacidad._form',['texto' => 'Actualizar','tipo'=>'2'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo Form::close(); ?>

                <!-- EndCONTENIDO Example -->

          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/discapacidad/edit.blade.php ENDPATH**/ ?>