<?php $__env->startSection('titulo','Documentacion'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Documentación</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Documentación</a></li>
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
            <h5 class="card-title">Empleados Registrados con Documentación</h5>
            <p>Para acceder a las opciones de la documentación presione sobre el botón <strong>Opciones</strong> para acceder a la opcion de modificar o eliminar el registro.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">CI</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <?php if(count($documentos)>0): ?>
                        
                    <tbody>
                        <?php $__currentLoopData = $documentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($e->empleado!=null): ?>
                            <tr>
                                <td><?php echo e($e->empleado->nombres); ?> <?php echo e($e->empleado->ap_paterno); ?> <?php echo e($e->empleado->ap_materno); ?></td>
                                <td class="text-center"><?php echo e($e->empleado->ci); ?> <?php if($e->empleado->ci_complemento != null): ?> - <?php echo e($e->empleado->ci_complemento); ?> <?php endif; ?> <?php echo e($e->empleado->ci_lugar); ?></td>
                                <td class="text-center"><?php echo e($e->empleado->cargo[0]->nombre); ?> <small>(<?php echo e($e->empleado->cargo[0]->tipo_cargo); ?>)</small></td>
                                <td class="d-flex justify-content-center" >
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          Opciones
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.edit')): ?>
                                                <li><a class="dropdown-item" href="<?php echo e(route('documentos.edit',$e->uuid)); ?>">Modificar Registro</a></li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.show')): ?>
                                                <li><a class="dropdown-item" href="<?php echo e(route('documentos.show',$e->uuid)); ?>" target="_blank">Lista Documentos Entregados</a></li>
                                            <?php endif; ?>
                                            
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.show')): ?>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo e(asset('documentos_empleados/' . $e->hoja_vida)); ?>" target="_blank">
                                                        Ver Curriculum
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.show')): ?>
                                                <li><a class="dropdown-item" href="<?php echo e(route('documentos_todos.show',$e->uuid)); ?>" target="_blank">Ver Documentos File</a></li>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.destroy')): ?>
                                            <form action="<?php echo e(route('documentos.destroy', $e->uuid)); ?>" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar la documentación?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="dropdown-item">Eliminar Registro</button>
                                            </form>
                                            <?php endif; ?>
                                        </ul>
                                      </div>
                                
                                
                              
                               </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php endif; ?>
                </table>
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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/documentacion/index.blade.php ENDPATH**/ ?>