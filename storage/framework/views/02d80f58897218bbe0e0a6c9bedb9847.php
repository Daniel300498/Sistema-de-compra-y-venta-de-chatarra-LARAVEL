<?php $__env->startSection('titulo','Lactancia'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>REGISTRO LACTANCIA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('lactancias_empleados.index')); ?>">Nuevo</a></li>
        <li class="breadcrumb-item active">Adjuntar documento Prenatal</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Agregar documentación Prenatal</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
            
           <!--CONTENIDO -->
            <p>Todos los campos son de ingreso obligatorio.</p>
           <form action="<?php echo e(route('lactancias.storePrenatal')); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
            <?php echo e(csrf_field()); ?>


            <div class="d-flex justify-content-center">
              <div class="col-md-10">
                <div class="form-group d-flex">
                    <div class="col-md-5">
                    <label for="example-text-input" class="form-control-label">Certificado Medico <span class="text-danger">(*)</span> </label>
                    </div>
                    <div class="col-md-7">
                        <input type="file" name="documento_prenatal" class="form-control" id=""   accept="application/pdf">
                    </div>
                    <br>
                </div>
                <br>
                <div class="form-group d-flex">
                <div class="col-md-5">
                <?php echo e(Form::label('fecha_inicio_prenatal','Fecha Certificado Medico' )); ?> <span class="text-danger">(*)</span> 
                </div>
                <div class="col-md-7">
                <input type="date" name="fecha_inicio_prenatal" style="text-align: center" id="fecha_inicio_prenatal" class="form-control <?php echo e($errors->has('fecha_inicio_prenatal') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_inicio_prenatal',$lactancia->fecha_inicio_prenatal)); ?>" >
                <?php if($errors->has('fecha_inicio_prenatal')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('fecha_inicio_prenatal')); ?>

                    </span>
                <?php endif; ?>
                </div>
                </div>


            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('lactancias_empleados.index')); ?>" class="btn btn-danger">Salir</a>
            </div>

                              
          </form>

          </div>
        </div>
     




         
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/lactancia/createPrenatal.blade.php ENDPATH**/ ?>