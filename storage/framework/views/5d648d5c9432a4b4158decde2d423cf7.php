<?php $__env->startSection('titulo','Enfermedad Terminal'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Enfermedad Terminal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Editar Documento</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Editar documento de Enfermedad Terminal</h5>
             <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>
              <!--CONTENIDO -->
              <?php echo Form::model($empleado,['route'=>['enfermedades.update',[$enfermedadTerminal, $empleado]],'method'=>'PUT','class'=>'row g-3','enctype'=>"multipart/form-data"]); ?>

                  <?php echo $__env->make('enfermedades._form',['texto' => 'Actualizar','color'=>'primary'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <?php echo Form::close(); ?>

              <!-- EndCONTENIDO Example -->

          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/enfermedades/edit.blade.php ENDPATH**/ ?>