<?php $__env->startSection('titulo','Cargos'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Cargos</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Cargos</li>
        </ol>
        </nav>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargos.create')): ?>
            <a href="<?php echo e(route('cargos.create')); ?>" class="btn btn-primary" title="Crea un nuevo rol con sus permisos">Agregar Nuevo</a>
        <?php endif; ?>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Cargos Registrados</h5>
            
           <!--CONTENIDO -->
           <div class="table-responsive table-sm">
            <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Área</th>
                        <th class="text-center">Nro item</th>
                        <th class="text-center">Denominación del Cargo</th>
                        <th class="text-center">Cargo funcional</th>
                        <th class="text-center">Salario Bs.</th>
                        <th class="text-center">Requisito Mínimo</th>
                        <th class="text-center">Tipo Cargo</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $cargos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cargo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td><small><?php echo e($cargo->area->nombre); ?></small></td>
                            <td class="text-center"><?php echo e($cargo->nro_item); ?></td>
                            <td><small><?php echo e($cargo->denominacion->descripcion); ?></small></td>
                            <td><?php echo e($cargo->nombre); ?></td>
                            <td><?php echo e(number_format($cargo->sueldo,2)); ?></td>
                            <td><small><?php echo e($cargo->requisito_minimo); ?></small></td>
                            <td class="text-center"><small><?php echo e($cargo->tipo_cargo); ?></small></td>
                            <td class="d-flex justify-content-center" >
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargos.edit')): ?>
                                    <a href="<?php echo e(route('cargos.edit',$cargo->id)); ?>" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargos.destroy')): ?>
                                    <a href="<?php echo e(route('cargos.destroy',$cargo->id)); ?>" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar al CARGO?');" ><i class="bi bi-trash"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/cargos/index.blade.php ENDPATH**/ ?>