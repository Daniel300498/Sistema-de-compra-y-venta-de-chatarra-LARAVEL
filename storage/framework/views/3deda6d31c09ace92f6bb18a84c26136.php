<?php $__env->startSection('titulo','Ficha Empleado'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <h1>REGISTRO FUNCIONARIOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('empleados.index')); ?>">Ver Todos</a></li>
        <li class="breadcrumb-item active">Ficha Firmada</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Adjuntar Ficha Firmada</h5>
                <h3><span class="badge bg-nombre-empleado"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></span></h3>
            </div>
           <!--CONTENIDO -->
            <p>Seleccione el archivo que corresponde a la ficha de personal con la firma del empleado, luego presione el boton <strong>GUARDAR</strong>. Si no desea realizar ninguna acción solo presione el botón <strong>CANCELAR</strong> para salir del formulario.</p>
            <form action="<?php echo e(route('ficha_firmada.store',$empleado->id)); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="col-md-8">
                <div class="form-group d-flex">
                  <label for="example-text-input" class=" col-md-6 form-control-label text-right">Seleccionar documento <span class="text-danger">(*)</span></label>
                  <div class="col-md-6">
                    <input type="file" name="documento" id="" accept="application/pdf" class="form-control <?php echo e($errors->has('documento') ? ' error' : ''); ?>">
                    <?php $__errorArgs = ['documento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">
                      <?php echo e($message); ?>

                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                </div>
                
              </div>                  
              <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('empleados.index')); ?>" class="btn btn-danger">Cancelar</a>
              </div>
            </form>
              <br>
                <?php if($empleado->ficha_firmada != null): ?>
                <hr>
                <div class="text-center">
                  <h6>Archivo Adjunto con la Ficha Firmada</h6>
                    <embed src="<?php echo e(asset('fichas_firmadas/'.$empleado->ficha_firmada)); ?>" type="application/pdf" width="420px" height="630px">
                </div>
                <?php endif; ?>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/empleados/ficha_firmada.blade.php ENDPATH**/ ?>