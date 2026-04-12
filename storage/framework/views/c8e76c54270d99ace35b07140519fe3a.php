<?php $__env->startSection('titulo', 'Denominación del Cargo'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Cargos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Cargos</a></li>
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
                      <p> Debe rellenar el campo descripción y el salario correspondiente y presionar el botón <strong>GUARDAR</strong>.</p>
                    <!-- CONTENIDO -->            
                    <form action="<?php echo e(route('cargoDenominacion.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción <span class="text-danger">*</span></label>
                                    <input id="descripcion" name= "descripcion" type="text" class="form-control <?php echo e($errors->has('descripcion') ? ' error' : ''); ?>"required value="<?php echo e(old('descripcion', isset($area) ? $area->descripcion : '')); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
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
                            <div class="col-lg-6">
                                <label for="sueldo">Salario</label> <span class="text-danger">*</span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Bs.-</span>
                                    </div>
                                    <input name="sueldo" id="sueldo" type="number" step="0.01" class="form-control <?php echo e($errors->has('sueldo') ? ' error' : ''); ?>" required>
                                    <?php $__errorArgs = ['sueldo'];
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
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</section>
<?php if(count($cargoDenominacion)>0): ?>
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Denominaciones de Cargos Registrados</h5>
            <p class="mb-0">Desde el menú de <strong>Opciones</strong> puede editar o eliminar una denominación.</p><p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar la denominación de la cual quiera aplicar alguna acción.</p>
                    <table class="table table-hover table-bordered table-sm table-responsive" id="datos">
                        <thead>
                            <tr>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Salario</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cargoDenominacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td>
                                <small><?php echo e($a->descripcion); ?></small>   
                            </td>
                            <td class="text-center">
                                    <small>Bs.- <?php echo e(number_format($a->sueldo,2)); ?></small>       
                            </td>
                            <td class="d-flex justify-content-center" >
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      Opciones
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargoDenominacion.edit')): ?>
                                            <li><a class="dropdown-item" href="<?php echo e(route('cargoDenominacion.edit',$a->id)); ?>">Modificar Datos</a></li>
                                        <?php endif; ?>        
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargoDenominacion.destroy')): ?>
                                        <li><a class="dropdown-item" href="<?php echo e(route('cargoDenominacion.destroy',$a->id)); ?>" onclick="return confirm('¿Está seguro que desea eliminar la denominación del cargo?');">Eliminar Denominación</a></li>
                                        <?php endif; ?>
                                    </ul>
                                  </div>
                            </td>
                            </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    
          </div>
        </div>
      </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargoDenominacion/index.blade.php ENDPATH**/ ?>