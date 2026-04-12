<?php $__env->startSection('titulo','Informe De Actividades Desarrolladas'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Comisiones</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Comisiones</a></li>
        <li class="breadcrumb-item active">Agregar Informe De Actividades Desarrolladas</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Adjuntar documento</h5>
            <p>Se debe adjuntar el archivo correspondiente y luego presionar el botón <strong>Guardar</strong>. Presione el botón <strong>Salir</strong> si no desea realizar ninguna acción.</p>
           <!--CONTENIDO -->
           <form action="<?php echo e(route('comisiones_ficha_firmada.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="comision_id" id="comision_id" value="<?php echo e($comision->id); ?>">
            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <label for="example-text-input" class="form-control-label">Seleccionar documento <span class="text-danger">(*)</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="documento" id=""   accept="application/pdf" required>
                        <?php if($errors->has('informe')): ?>
                           <span class="text-danger">
                               <?php echo e($errors->first('informe')); ?>

                           </span>
                       <?php endif; ?>
                    </div>
                </div>
            
            </div>                  
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('comisiones.create',$comision->empleado_id)); ?>" class="btn btn-danger">Salir</a>
            </div>
         </form>
         <br>
            <?php if($comision->informe != null): ?>
            <hr>
            <div class="text-center">
              <h6>Archivo Adjunto Informe De Actividades Desarrolladas</h6>
                <embed src="<?php echo e(asset('comisiones_actividades_desarrolladas/'.$comision->informe)); ?>" type="application/pdf" width="420px" height="630px">
            </div>
            <?php endif; ?>
        
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/comisiones/ficha_firmada.blade.php ENDPATH**/ ?>