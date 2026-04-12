<?php $__env->startSection('titulo', 'Areas'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Jerarqu&iacute;as y &Aacute;reas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Jerarqu&iacute;as y &Aacute;reas</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('jerarquias.index')); ?>">Ver Jerarqu&iacute;as</a></li>
            <li class="breadcrumb-item active">Nueva &Aacute;rea</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title">Nueva &Aacute;rea</h5>
            <h3><span class="badge bg-nombre-empleado">NIVEL JERÁRQUICO: <?php echo e($jerarquia->nombre); ?></span></h3>  
            </div>
            <!--CONTENIDO -->
           <?php echo Form::open(['route'=>'areas.store', 'class'=>'row g-3', 'enctype'=>"multipart/form-data"]); ?>

                <?php echo $__env->make('areas._form',['texto' => 'Guardar','color'=>'primary'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php echo $__env->make('areas.secciones.areas_jerarquia', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>"></script>
<script>$("#depende_id").select2({placeholder: '--SELECCIONE--',width: 'resolve' }).on('select2-open', function () {$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();});</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/areas/create.blade.php ENDPATH**/ ?>