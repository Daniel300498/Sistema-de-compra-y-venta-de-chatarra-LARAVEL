<?php $__env->startSection('titulo','Discapacidad'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>REGISTRO DISCAPACIDADES</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('discapacidades.index')); ?>">Registro Discapacidades</a></li>
            <li class="breadcrumb-item active">Ver Registrados</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleados con Documentos de discapacidad adjuntos</h5>
            <p>Desde esta secci&oacute;n puede modificar, ver documento adjunto y eliminar el registro de discapacidad correspondiente de cada empleado
            <?php if(count($discapacidades) != 0): ?>
             , se accede a estas opciones desde el botón <strong>Opciones</strong>.
            <?php endif; ?>
           </p>
           <div class="table-responsive">
            <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Nro Item</th>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">CI</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">&aacute;rea</th>
                        <th class="text-center">Empleado </th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $discapacidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($e->empleado->cargo[0]->nro_item); ?></td>
                            <td><?php echo e($e->empleado->nombres); ?> <?php echo e($e->empleado->ap_paterno); ?> <?php echo e($e->empleado->ap_materno); ?></td>
                            <td class="text-center"><?php echo e($e->empleado->ci); ?> <?php if($e->empleado->ci_complemento != null): ?> - <?php echo e($e->empleado->ci_complemento); ?> <?php endif; ?> <?php echo e($e->empleado->ci_lugar); ?></td>
                            <td class="text-center"><?php $__currentLoopData = $e->empleado->cargo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <strong><?php echo e($c->nombre); ?></strong>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </td>
                            <td><?php echo e($e->empleado->cargo[0]->area->nombre); ?></td>
                            <td class="text-center">
                                <?php if($e->tutor==1): ?>
                                <h6><span class="badge bg-secondary">CON DISCAPACIDAD</span></h6>
                                <?php else: ?>
                                <h6><span class="badge bg-danger">ES TUTOR</span></h6>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Opciones
                                      </button>
                                       <ul class="dropdown-menu">
                                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discapacidades.edit')): ?>
                                              <li><a class="dropdown-item" href="<?php echo e(route('discapacidades.edit',$e->uuid)); ?>">Modificar Datos</a></li>
                                          <?php endif; ?>
                                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discapacidades.show')): ?>
                                          <?php if($e->adjunto != null ): ?>
                                          <li><a class="dropdown-item" href="<?php echo e(asset('discapacidad/'.$e->adjunto)); ?>" target="_blank">Ver Adjunto</a></li>
                                          <?php endif; ?>
                                          <?php endif; ?>
                                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discapacidades.destroy')): ?>
                                              <li><a class="dropdown-item" href="<?php echo e(route('discapacidades.destroy',$e->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar el registro tambien se eliminara el archivo adjunto?');">Eliminar Registro</a></li>
                                          <?php endif; ?>
                                      </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <br><br>
           </div>
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/discapacidad/index.blade.php ENDPATH**/ ?>