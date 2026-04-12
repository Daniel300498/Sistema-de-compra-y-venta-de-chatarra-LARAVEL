<?php $__env->startSection('titulo','Publicaciones - Noticias'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Publicaciones</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Publicaciones</a></li>
            <li class="breadcrumb-item active">Agregar Publicaciones</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nueva Publicación</h5>
           <!--CONTENIDO -->
           <?php echo Form::open(['route'=>'publicacion.store', 'class'=>'row g-3', 'enctype'=>"multipart/form-data"]); ?>

                <?php echo $__env->make('publicaciones._form',['texto' => 'Guardar','color'=>'primary'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<?php echo $__env->make('publicaciones.modal._modal_tipo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/forms/agregaTipo.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/publicaciones/create.blade.php ENDPATH**/ ?>