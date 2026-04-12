<?php $__env->startSection('titulo','Editar Sala'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Salas y Camas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('salas.index')); ?>">Salas y Camas</a></li>
        <li class="breadcrumb-item active">Modificar Sala</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos de la Sala</h5>
           <!--CONTENIDO -->
           <?php echo Form::model($sala,['route'=>['salas.update',$sala->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

                <?php echo $__env->make('salas._form',['texto' => 'Guardar','color'=>'success'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
 


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/salas/edit.blade.php ENDPATH**/ ?>