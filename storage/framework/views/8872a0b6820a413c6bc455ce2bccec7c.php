<?php $__env->startSection('titulo', 'Denominación del Cargo'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Denominación del cargo</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Denominación del Cargo</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Agregar Denominación del Cargo</h5>
                    <!--CONTENIDO -->
                    <?php echo Form::model($cargoDenominacion,['route'=>['cargoDenominacion.update',$cargoDenominacion->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

                    <?php echo $__env->make('cargoDenominacion._form',['texto' => 'Actualizar','color'=>'success'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo Form::close(); ?>

                    <!-- EndCONTENIDO Example -->
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargoDenominacion/edit.blade.php ENDPATH**/ ?>