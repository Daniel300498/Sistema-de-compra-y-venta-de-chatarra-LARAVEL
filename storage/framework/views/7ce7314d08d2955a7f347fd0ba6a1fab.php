<?php $__env->startSection('titulo','Academico'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle"> 
    <h1>Parámetros</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Parámetros</a></li>
                <li class="breadcrumb-item active">Modificar paramatro Académico</li>
            </ol>
        </nav>        
    </div>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Modificar Parámetro</h5>
                        <h3><span class="badge bg-nombre-empleado">
                            <?php if($parametro->tipo =='formacion'): ?>
                                TIPO: FORMACION
                            <?php elseif($parametro->tipo =='profesion'): ?>   
                                TIPO: CARRERAS UNIVERSITARIAS
                            <?php elseif($parametro->tipo =='institucion_formacion'): ?>   
                                TIPO: UNIVERSIDAD O INSTITUTO
                            <?php endif; ?>
                        </span></h3>
                      </div>
                    <!--CONTENIDO -->
                    <p>Debe ingresar el nombre del parámetro.</p>                  

                    <form action="<?php echo e(route('academico.update', $parametro->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="descripcion">Nombre <span class="text-danger">*</span></label>
                                    <input id="descripcion" type="text" class="form-control <?php echo e($errors->has('descripcion') ? ' error' : ''); ?>" name="descripcion"  value="<?php echo e(old('descripcion', isset($parametro) ? $parametro->descripcion : '')); ?>" required="required" placeholder="Ingrese el nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                                    <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div> 
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="<?php echo e(route('academico.index')); ?>" class="btn btn-danger">Salir</a>  
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/parametros/academico/edit.blade.php ENDPATH**/ ?>