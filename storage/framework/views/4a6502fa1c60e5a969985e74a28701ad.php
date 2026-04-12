
<?php $__env->startSection('titulo','Cargo de Empleados'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Cargo de Empleados</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('cargoEmpleados.buscar_cargo_empleado')); ?>">Cargo de Empleados</a></li>
            <li class="breadcrumb-item active">Cargo de Empleados Activos</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Buscar el Cargo del Empleado</h5>
            <p>Busque el empleado por el <strong>NOMBRE</strong> del empleado, <strong>CI</strong> o número de <strong>ITEM</strong>.</p>
            <form action="<?php echo e(route('cargoEmpleados.buscar_cargo_empleado')); ?>" method="get">     
                <?php echo csrf_field(); ?>
                <div class="row">
                    <label for="nombre" class="col-md-4 col-control label text-right">Nombre Empleado</label>
                    <div class="col-lg-8">
                        <input type="text" name="nombre" id="nombre" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="ci" class="col-md-4 col-control label text-right">C.I.</label>
                    <div class="col-lg-8">
                        <input type="text" name="ci" id="ci" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="tipo_alta" class="col-md-4 col-control label text-right">Tipo de Alta</label>
                    <div class="col-lg-8">
                        <select name="tipo_alta" id="tipo_alta" class="form-control">
                            <option value="">-- SELECCIONE --</option>
                            <?php $__currentLoopData = $tiposAlta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tipo); ?>"><?php echo e($tipo); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 text-center">
                        <input type="hidden" name="is_search" value="1"> 
                        <button type="submit" class="btn btn-primary">Buscar Empleado</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
<?php if($cargoEmpleado != null): ?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listado de cargos asignados a los empleados</h5>
                    <p>En esta sección aparecerán los empleados con cargos asignados actualmente, es decir el personal <strong> ACTIVO</strong> de la institución.</p>
                    Desde <strong>Opciones</strong> puede declarar el item en acéfalo, es decir retirar al empleado de su cargo.
                    <div class="table-responsive">
                        <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">                            
                        <thead>
                                <tr>
                                    <th class="text-center">NRO DE ITEM</th>
                                    <th class="text-center">NOMBRE COMPLETO</th>
                                    <th class="text-center">CI</th>
                                    <th class="text-center">CARGO</th>
                                    <th class="text-center">FECHA INICIO</th>
                                    <th class="text-center">TIPO ALTA</th>
                                    <th class="text-center">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cargoEmpleado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ce): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <tr>    
                                        <?php if($ce->cargo->nro_item): ?>
                                        <td class="text-center"><?php echo e($ce->cargo->nro_item); ?></td>    
                                        <?php else: ?>
                                        <td class="text-center"><?php echo e($ce->cargo->tipo_cargo); ?></td>
                                        <?php endif; ?>
                                        <td class="text-center"><?php echo e($ce->empleado->nombres); ?> <?php echo e($ce->empleado->ap_paterno); ?> <?php echo e($ce->empleado->ap_materno); ?></td>
                                        <td class="text-center"><?php echo e($ce->empleado->ci); ?> <?php if($ce->empleado->ci_complemento != null): ?> - <?php echo e($ce->empleado->ci_complemento); ?> <?php endif; ?> <?php echo e($ce->empleado->ci_lugar); ?></td>
                                        <td class="text-center"><?php echo e($ce->cargo->nombre); ?></td>
                                        <td class="text-center"><?php echo e(date('d/m/Y',strtotime($ce->fecha_inicio))); ?></td>
                                        <td class="text-center"><small><?php echo e($ce->tipo_alta); ?></small></td>
                                        <td class="d-flex justify-content-center">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Opciones
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargoEmpleados.store_asignar')): ?>
                                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editarfecha-<?php echo e($ce->id); ?>">Editar fecha de Inicio </a></li>                                                        
                                                            <?php if($ce->tipo_alta ==="INTERINO"): ?>
                                                            <li><a class="dropdown-item" href="<?php echo e(asset('memorandums/' . $ce->archivo_memorandum)); ?>" target="_blank">Ver Memorándum</a></li>     
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargoEmpleados.destroy')): ?>
                                                                    <li><a class="dropdown-item" href="<?php echo e(route('cargoEmpleados.destroy',$ce->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar el Cargo de interino?');">Eliminar Cargo Interino</a></li>
                                                                <?php endif; ?>
                                                            <?php else: ?> 
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargoEmpleados.store_liberar')): ?>
                                                               <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#liberarItemModal-<?php echo e($ce->id); ?>">Liberar Item</a></li>                                                        
                                                             <?php endif; ?>
                                                            <li><a class="dropdown-item" href="<?php echo e(route('cargoEmpleados.interino',$ce->empleado->uuid)); ?>">Agregar Interino</a></li>
                                                            <?php endif; ?>    
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php echo $__env->make('cargoEmpleados.modals._modal_acefalo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('cargoEmpleados.modals._modal_fecha_ini', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                            </tbody>
                        </table>
                    </div>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargoEmpleados/consulta.blade.php ENDPATH**/ ?>