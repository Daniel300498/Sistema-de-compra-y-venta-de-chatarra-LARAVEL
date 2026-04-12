
<?php $__env->startSection('titulo','Asignar Cargo'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Asignar Cargo</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('cargoEmpleados.index')); ?>">Cargo Empleados</a></li>
            <li class="breadcrumb-item active">Asignar Cargo</li>
        </ol>
    </nav>
</div>
<section class="section">  
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Asignacion de Cargo a Empleado</h5>
                        <h3><span class="badge bg-nombre-empleado">CARGO: <?php echo e($cargo->nombre); ?></span></h3>
                    </div>
                    <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>. Debe seleccionar el nombre del funcionario al cual quiere asignarle el <strong>ITEM</strong>.</p>
                    
                    <form action="<?php echo e(route('cargoEmpleados.store_asignar',$cargo->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row"> 
                            <div class="col-md-6">
                                <?php echo e(Form::label('empleado_id', 'Funcionarios Sin Cargo')); ?> <span class="text-danger">(*)</span>
                                <div class="d-flex align-items-center justify-content-between">
                                    <select name="empleado_id" id="empleado_id" class="form-control <?php echo e($errors->has('empleado_id') ? ' error' : ''); ?>">
                                        <option value="">-- SELECCIONE --</option>
                                        <?php $__currentLoopData = $empleadosSinCargo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($empleado->id); ?>" <?php echo e(old('empleado_id') == $empleado->id ? 'selected' : ''); ?>><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('empleado_id')): ?>
                                        <span class="text-danger"> <?php echo e($errors->first('empleado_id')); ?></span>
                                    <?php endif; ?>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <?php echo e(Form::label('tipo_alta', 'Tipo de Alta')); ?> <span class="text-danger">(*)</span>
                                <select name="tipo_alta" id="tipo_alta" class="form-control <?php echo e($errors->has('tipo_alta') ? ' error' : ''); ?>" value="<?php echo e(old('tipo_alta')); ?>">
                                    <option value="">-- SELECCIONE --</option>
                                    <option value="PROMOCION">PROMOCION</option>
                                    <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                    <option value="REINGRESO">REINGRESO</option>
                                </select>
                                <?php if($errors->has('tipo_alta')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('tipo_alta')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="documento2"> Documento  <?php if($cargo->tipo_cargo == "PERSONAL EVENTUAL"): ?>Contrato <?php endif; ?> <span class="text-danger">(*)</span></label>
                                    <div class="input-group">
                                        <input id="documento2" type="file" class="form-control <?php echo e($errors->has('documento2') ? ' error' : ''); ?>" name="documento2">                  
                                    </div>
                                    <?php if($errors->has('documento2')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('documento2')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if($cargo->tipo_cargo =="PERSONAL EVENTUAL"): ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nro_contrato">Numero de contrato <span class="text-danger">(*)</span></label>
                                    <input id="nro_contrato" type="text" class="form-control <?php echo e($errors->has('nro_contrato') ? ' error' : ''); ?>" name="nro_contrato" value="<?php echo e(old('nro_contrato')); ?>">                
                                    <?php if($errors->has('nro_contrato')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('nro_contrato')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de Inicio <span class="text-danger">(*)</span></label>
                                    <input id="fecha_inicio" type="date" class="form-control <?php echo e($errors->has('fecha_inicio') ? ' error' : ''); ?>" name="fecha_inicio" value="<?php echo e(old('fecha_inicio')); ?>">                
                                    <?php if($errors->has('fecha_inicio')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('fecha_inicio')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if($cargo->tipo_cargo =="PERSONAL EVENTUAL"): ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_conclusion">Fecha de Conclusion <span class="text-danger">(*)</span></label>
                                    <input id="fecha_conclusion" type="date" class="form-control <?php echo e($errors->has('fecha_conclusion') ? ' error' : ''); ?>" name="fecha_conclusion" value="<?php echo e(old('fecha_conclusion')); ?>">                
                                    <?php if($errors->has('fecha_conclusion')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('fecha_conclusion')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="row mt-4">  
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary" name="estado">Guardar</button>
                                <a href="<?php echo e(route('cargoEmpleados.acefalo_index')); ?>" class="btn btn-danger">Salir</a>
                            </div>
                            </div>
                        </form>

                    </div>
                </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargoEmpleados/asignar.blade.php ENDPATH**/ ?>