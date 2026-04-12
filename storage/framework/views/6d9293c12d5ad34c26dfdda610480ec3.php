<?php $__env->startSection('titulo','Editar Cama'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Salas y Camas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Salas y Camas</a></li>
         <li class="breadcrumb-item"><a href="<?php echo e(route('salas.index')); ?>">Ver Salas</a></li>
        <li class="breadcrumb-item active">Editar Cama</li>
    </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">   
              <h5 class="card-title">Modificar datos de la Cama</h5>
              <h3><span class="badge bg-nombre-empleado">SALA <?php echo e($sala->nombre); ?></span></h3>
              </div>
          <!--CONTENIDO -->
          <?php echo Form::model($cama,['route'=>['camas.update',$cama->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

          <?php echo $__env->make('camas._form',['texto' => 'Guardar','color'=>'success'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php echo Form::close(); ?>

          <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<?php echo $__env->make('camas.secciones.camas_sala', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>"></script>
<script>$("#depende_id").select2({placeholder: '--SELECCIONE--',width: 'resolve' }).on('select2-open', function () {$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();});</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/camas/edit.blade.php ENDPATH**/ ?>