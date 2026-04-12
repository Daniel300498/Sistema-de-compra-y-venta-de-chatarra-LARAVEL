
<?php $__env->startSection('titulo', 'Incremento Salarial'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Cargos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Cargos</a></li>
            <li class="breadcrumb-item active">Incremento Salarial</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Incremento Salarial</h5>
                    <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>. Al momento de agregar un incremento salarial, tomar en cuenta que el porcentaje
                         que aplique debe estar sujeto a ley vigente y la misma actualizará los salarios de todas las denominaciones del cargo que seleccione.</p>
                    <!-- CONTENIDO -->            
                    <form action="<?php echo e(route('incrementoSalarial.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="porcentaje_incremento">Porcentaje de incremento al haber básico <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input id="porcentaje_incremento" name="porcentaje_incremento" type="number" class="form-control <?php echo e($errors->has('porcentaje_incremento') ? ' error' : ''); ?>" value="<?php echo e(old('porcentaje_incremento', isset($incrementoSalarial) ? $incrementoSalarial->porcentaje_incremento : '')); ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <span id="porcentaje-error" class="text-danger"></span>
                                <?php $__errorArgs = ['porcentaje_incremento'];
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

                            <div class="col-lg-4">
                                <label for="fecha_autorizacion">Fecha de Autorización <span class="text-danger">*</span></label>
                                <input id="fecha_autorizacion" name="fecha_autorizacion" type="date" class="form-control <?php echo e($errors->has('fecha_autorizacion') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_autorizacion', isset($incrementoSalarial) ? $incrementoSalarial->fecha_autorizacion : '')); ?>">
                                <?php $__errorArgs = ['fecha_autorizacion'];
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

                            <div class="col-lg-4">
                                <label for="motivo_autorizacion">Motivo de Autorización <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select name="motivo_autorizacion" id="motivo_autorizacion" class="form-control <?php echo e($errors->has('motivo_autorizacion') ? ' error' : ''); ?>">
                                        <option value="">-- SELECCIONE --</option>
                                        <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tipo->descripcion); ?>" <?php echo e(old('motivo_autorizacion', isset($incrementoSalarial) ? $incrementoSalarial->motivo_incremento : '') == $tipo->descripcion ? 'selected' : ''); ?>><?php echo e($tipo->descripcion); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tipoMotiv" title="Agregar Motivo de Autorización">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['motivo_autorizacion'];
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

                            <div class="row mb-3">
                                <div class="col-lg-8">
                                    <label for="nombre" class="col-md-12 col-form-label">Seleccionar Archivo de Autorización : <span class="text-danger">(*)</span></label>
                                    <input type="file" name="nombre" id="" value="<?php echo e(old('nombre', isset($incrementoSalarial) ? $incrementoSalarial->documento_autorizacion : '')); ?>">
                                    <?php $__errorArgs = ['nombre'];
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

                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="denominaciones" class="col-md-12 col-form-label">Seleccione las denominaciones del cargo a las cuales desea aplicar el aumento salarial: <span class="text-danger">(*)</span></label>
                                    <div id="checkboxes">
                                        <label>
                                            <input type="checkbox" id="select_todos"/>Seleccionar todos
                                        </label>
                                        <br>
                                        <?php $__currentLoopData = $cargoDenominaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cargoDenominacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label for="chk_<?php echo e($cargoDenominacion->id); ?>">
                                            <input type="checkbox" id="chk_<?php echo e($cargoDenominacion->id); ?>" name="denominaciones[]" value="<?php echo e($cargoDenominacion->id); ?>"/>
                                            <?php echo e($cargoDenominacion->descripcion); ?>

                                        </label>
                                        <br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php $__errorArgs = ['denominaciones'];
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
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="<?php echo e(route('home')); ?>" class="btn btn-danger"> Salir </a>
                                </div>
                            </div>
                        </div>  
                    </form> 
                    <br>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('incrementoSalarial.modals._modal_tipo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/forms/agregaMotivo.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/incrementoSalarial/create.blade.php ENDPATH**/ ?>