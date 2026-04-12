<?php $__env->startSection('titulo','Editar Permiso'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>PERMISOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('permisos.index')); ?>">Permisos</a></li>
        <li class="breadcrumb-item active">Modificar Datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos del permiso</h5>
           <!--CONTENIDO -->
           <?php echo Form::model($permiso,['route'=>['permisos.update',$permiso->id],'method'=>'PUT']); ?>

                <?php echo $__env->make('permisos._form',['texto' => 'Actualizar','tipo'=>'2','texto_pass'=>'Cambiar Contraseña','color'=>'success'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/forms/users.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/verContrasenia.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard\resources\views/permisos/edit.blade.php ENDPATH**/ ?>