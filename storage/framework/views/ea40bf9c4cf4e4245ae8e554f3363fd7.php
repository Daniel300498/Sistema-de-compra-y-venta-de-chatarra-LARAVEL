<?php $__env->startSection('titulo','Nuevo Cargo'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>CARGOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Cargos</a></li>
        <li class="breadcrumb-item active">Nuevo Cargo</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Cargo</h5>
           <!--CONTENIDO -->
           <?php echo Form::open(['route'=>'cargos.store','class'=>'form-horizontal']); ?>

                <?php echo $__env->make('cargos._form',['texto' => 'Guardar','color'=>'primary'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/forms/cargo.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargos/create.blade.php ENDPATH**/ ?>