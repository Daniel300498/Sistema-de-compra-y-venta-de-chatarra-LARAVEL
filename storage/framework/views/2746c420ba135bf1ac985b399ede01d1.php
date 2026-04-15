<?php $__env->startSection('titulo','Nuevo Paciente'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>REGISTRO PROVEEDORES
    </h1>
    <nav>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('proveedores.create')); ?>">Registro Proveedores</a></li>
        <li class="breadcrumb-item active">Nuevo Proveedor</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Proveedor</h5>
           <!--CONTENIDO -->
           <?php echo Form::open(['route'=>'proveedores.store','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

                <?php echo $__env->make('proveedores._form',['texto' => 'Registrar','color'=>'primary'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<?php echo $__env->make('proveedores.modals._modal_instituto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('proveedores.modals._modal_profesion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('proveedores.modals._modal_formacion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('proveedores.modals._modal_ciudad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/forms/proveedoresControlCampos.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/jquery-ui.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/agregarCargo.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/agregaInstitucionFormacion.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/agregaProfesion.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/agregaFormacion.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/agregaCiudad.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/mostrarSugerenciaParentesco.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/proveedores/create.blade.php ENDPATH**/ ?>