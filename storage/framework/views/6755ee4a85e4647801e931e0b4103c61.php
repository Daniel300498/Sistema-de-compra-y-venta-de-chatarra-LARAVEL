<?php $__env->startSection('titulo','Editar Paciente'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Usuarios</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('proveedores.index')); ?>">Proveedores</a></li>
        <li class="breadcrumb-item active">Modificar Datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos del proveedor</h5>
           <!--CONTENIDO -->
           <?php echo Form::model($proveedor,['route'=>['proveedores.update',$proveedor->id],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

                <?php echo $__env->make('proveedores._form',['texto' => 'Actualizar','color'=>'success'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/proveedores/edit.blade.php ENDPATH**/ ?>