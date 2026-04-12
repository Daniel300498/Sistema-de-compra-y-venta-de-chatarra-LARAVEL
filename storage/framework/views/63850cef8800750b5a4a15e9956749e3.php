
<?php $__env->startSection('titulo','Empleados'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>     
            <h1>REGISTRO FUNCIONARIOS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="">Registro Funcionarios</a></li>
                    <li class="breadcrumb-item active">Ver Todos</li>
                </ol>
            </nav>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.create')): ?>
            <a href="<?php echo e(route('empleados.create')); ?>" class="btn btn-primary MB-3">Agregar Nuevo</a>
        <?php endif; ?>
    </div>
</div>
<section class="section">
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
          <h5 class="card-title">Funcionarios</h5>
          <p>Filtre los empleados por el <strong>TIPO DE CARGO</strong> </p>
            <form action="<?php echo e(route('empleados.consulta')); ?>" method="post" class="mb-4">
            <?php echo csrf_field(); ?>
            <div class="row">
                <label for="tipo_cargo" class="col-md-4 col-control label text-right">Filtrar por Tipo de Cargo:</label>
                <div class="col-lg-6">
                <select name="tipo_cargo" id="tipo_cargo" class="form-control">
                    <option value="">-- SELECCIONE --</option>
                    <?php $__currentLoopData = $cargos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tipo->descripcion); ?>"><?php echo e($tipo->descripcion); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
                </div>
                </div>
            </form>
        </div>
        </div>
      </div>
    </div>
</section>
    <?php if($empleados): ?>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Empleados Registrados</h5>
                            <div class="table-responsive">
                                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Número de Item</th>
                                            <th class="text-center">Nombre Completo</th>
                                            <th class="text-center">CI</th>
                                            <th class="text-center">Cargo</th>
                                            <th class="text-center">Área</th>
                                            <th class="text-center">Fecha Inicio</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <?php if($e->cargo->nro_item): ?>
                                                    <td class="text-center"><?php echo e($e->cargo->nro_item); ?></td>
                                                    <?php else: ?>
                                                    <td class="text-center"><?php echo e($e->cargo->tipo_cargo); ?></td>
                                                    <?php endif; ?>
                                                    <td><?php echo e($e->empleado->nombres); ?> <?php echo e($e->empleado->ap_paterno); ?> <?php echo e($e->empleado->ap_materno); ?></td>
                                                    <td class="text-center"><?php echo e($e->empleado->ci); ?> <?php if(!$e->empleado->ci_complemento): ?> - <?php echo e($e->empleado->ci_complemento); ?> <?php endif; ?> <?php echo e($e->empleado->ci_lugar); ?></td>
                                                    <td class="text-left"><?php echo e($e->cargo->nombre); ?></td>
                                                    <td class="text-left"><?php echo e($e->cargo->area->nombre); ?></td>
                                                    <td class="text-center"><?php echo e(date('d/m/Y',strtotime($e->fecha_inicio))); ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Opciones
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.edit')): ?>
                                                                        <li><a class="dropdown-item" href="<?php echo e(route('empleados.edit',$e->empleado->uuid)); ?>">Modificar Datos</a></li>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.show')): ?>
                                                                    <li><a class="dropdown-item" href="<?php echo e(route('empleados.show',$e->empleado->uuid)); ?>" target="_blank">Ver Ficha</a></li>
                                                                    <?php endif; ?>
                                                                    <?php if($e->cargo->tipo_cargo == 'ITEM'): ?>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.create')): ?>
                                                                        <li><a class="dropdown-item" href="<?php echo e(route('empleados.ficha',$e->empleado->uuid)); ?>">Adjuntar Ficha Firmada</a></li>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.asignar')): ?>
                                                                    <?php if(!$e->empleado->reconocido): ?>
                                                                        <li><a class="dropdown-item" href="<?php echo e(route('empleados.asignar',$e->empleado->uuid)); ?>" onclick="return confirm('¿Está seguro que desea asignar al empleado como miembro reconocido de la institución?');">Asignar Como Miembro Reconocido</a></li>
                                                                    <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.destroy')): ?>
                                                                        <li><a class="dropdown-item" href="<?php echo e(route('empleados.destroy',$e->empleado->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar al empleado?');">Eliminar Empleado</a></li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-center">Seleccione un tipo de cargo para mostrar empleados.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/empleados/index.blade.php ENDPATH**/ ?>