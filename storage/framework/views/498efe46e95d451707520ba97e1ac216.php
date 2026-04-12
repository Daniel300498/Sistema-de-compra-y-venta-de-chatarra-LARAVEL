
<?php $__env->startSection('titulo','Areas'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>JERARQU&Iacute;AS Y &Aacute;REAS</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Jearqu&iacute;as y &Aacute;reas</a></li>
            <li class="breadcrumb-item active">Listar &Aacute;reas</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">&Aacute;reas Registradas</h5>
            <p class="mb-0">Desde el menú de <strong>Opciones</strong> puede editar o eliminar un &aacute;rea.</p>
            <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar el &aacute;rea que corresponda.</p>
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            
                            <th class="text-center">Nivel Jer&aacute;rquico</th>
                            <th class="text-center">&Aacute;rea</th>
                            <th class="text-center">Descripci&oacute;n</th>
                            <th class="text-center">Depende De:</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                    <td class="text-center"><?php echo e($a->jerarquia->nombre); ?></td>
                    <td><?php echo e($a->nombre); ?></td>
                    <td><?php echo e($a->descripcion); ?></td>
                    <td class="text-center">
                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($area->id == $a->depende_id): ?>
                    <strong><?php echo e($area->nombre); ?></strong>
                    <?php $dependenciaEncontrada = true; ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!isset($dependenciaEncontrada) && is_null($a->depende_id)): ?>
                   <strong>----Sin Dependencia---</strong>
                    <?php endif; ?>
                                </td>
                                <td class="d-flex justify-content-center" >
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          Opciones
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('areas.edit')): ?>
                                            <li><a class="dropdown-item" href="<?php echo e(route('areas.edit', $a->uuid)); ?>">Modificar &Aacute;rea</a></li>
                                            <?php endif; ?>        
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('areas.destroy')): ?>
                                            <li><a class="dropdown-item" href="<?php echo e(route('areas.destroy',$a->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar el área?');">Eliminar &Aacute;rea</a></li>
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
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/areas/index.blade.php ENDPATH**/ ?>