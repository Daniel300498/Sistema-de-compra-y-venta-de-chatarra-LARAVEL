<?php $__env->startSection('titulo','Lactancia'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>REGISTRO LACTANCIA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('lactancias_empleados.index')); ?>">Nuevo</a></li>
        <li class="breadcrumb-item active">Adjuntar Documento Postnatal</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Agregar documentación Postnatal - Documentación Nacimiento</h5>
              <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
            
           <!--CONTENIDO -->

            <p>Todos los campos son de ingreso obligatorio. Debe adjuntar el documento correspondiente y presionar el botón <strong>GUARDAR</strong>. Si no desea realizar ninguna acción presiona el botón <strong>SALIR</strong></p>
           <form action="<?php echo e(route('lactancias.storePostnatal')); ?>" method="POST" enctype="multipart/form-data">
           
            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
            <?php echo e(csrf_field()); ?>


            
            <div class="d-flex justify-content-center">
              <div class="col-md-10">
 

                <div class="form-group d-flex">
                    <div class="col-md-5">
                    <label for="example-text-input" class="form-control-label">Certificado de Nacimiento <span class="text-danger">(*)</span> </label>
                    </div>
                    <div class="col-md-7">
                        <input type="file" name="documento_postnatal" class="form-control" id=""   accept="application/pdf">
                    </div>
                    <br>
                </div>
                    
                <br>


                  <div class="form-group d-flex">
                    <div class="col-md-5">
                      <?php echo e(Form::label('fecha_inicio_postnatal','Fecha de Nacimiento' )); ?> <span class="text-danger">(*)</span> 
                    </div>
                    <div class="col-md-7">
                      <input type="date" name="fecha_inicio_postnatal" style="text-align: center" id="fecha_inicio_postnatal" class="form-control <?php echo e($errors->has('fecha_inicio_postnatal') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_inicio_postnatal',$lactancia->fecha_inicio_postnatal)); ?>" >
                        <?php if($errors->has('fecha_inicio_postnatal')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('fecha_inicio_postnatal')); ?>

                            </span>
                      <?php endif; ?>
                    </div>
                  </div>
 

            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('lactancias_empleados.index')); ?>" class="btn btn-danger">Salir</a>
            </div>

          </div>
          </div>
                              
          </form>
     




         
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/lactancia/createPostnatal.blade.php ENDPATH**/ ?>