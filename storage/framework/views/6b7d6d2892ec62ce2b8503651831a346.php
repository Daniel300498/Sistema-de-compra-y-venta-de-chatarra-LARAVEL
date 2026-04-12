
<?php $__env->startSection('titulo','Empleados'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle mb-0">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>MIEMBROS RECONOCIDOS</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="">Miembros Reconocidos</a></li>
                <li class="breadcrumb-item active">Ver Todos</li>
            </ol>
            </nav>
        </div>
       
    </div>
</div><!-- End Page Title -->

<?php if(count($empleados)>0): ?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Miembros Reconocidos</h5>
                    <p>Para acceder a las opciones de los miembros reconocidos presione sobre el botón <strong>Opciones</strong> para acceder a la opcion de Retirar de miembros reconocidos.</p>
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
                                    <?php $__currentLoopData = $empleados->sortBy('cargo.nro_item'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                        <?php if(request('tipo_cargo') == '' || $e->cargo[0]->tipo_cargo == request('tipo_cargo')): ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php $__currentLoopData = $e->cargo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <small><?php echo e($c->nro_item); ?></small>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                </td>
                                                <td><?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></td>
                                                <td class="text-center"><?php echo e($e->ci); ?> <?php if($e->ci_complemento != null): ?> - <?php echo e($e->ci_complemento); ?> <?php endif; ?> <?php echo e($e->ci_lugar); ?></td>
                                                <td class="text-left">
                                                    <?php $__currentLoopData = $e->cargo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($c->nombre); ?> <br> <small>(<?php echo e($c->tipo_cargo); ?>)</small>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                </td>
                                                <td><?php echo e($e->cargo[0]->area['nombre']); ?></td>
                                                <td><?php echo e(date('d/m/Y',strtotime($e->cargo[0]['pivot']->fecha_inicio))); ?></td>
                                            
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Opciones
                                                            </button>
                                                            <ul class="dropdown-menu">
                                            
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.retirar')): ?>
                                                                <li><a class="dropdown-item" href="<?php echo e(route('empleados.retirar',$e->uuid)); ?>" onclick="return confirm('¿Está seguro que desea retirar al empleado como miembro reconocido de la institución?');">Retirar de Miembros Reconocidos</a></li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                 
                </div>
            </div>
        </div>
    </div>
</section>
<?php else: ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><center>NO HAY MIEMBROS RECONOCIDOS</center></h5>
        </div>
      </div>
    </div>
  </div>

</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/empleados/reconocidos.blade.php ENDPATH**/ ?>