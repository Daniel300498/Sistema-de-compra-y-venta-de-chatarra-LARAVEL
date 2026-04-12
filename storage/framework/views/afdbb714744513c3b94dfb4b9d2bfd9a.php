

<?php $__env->startSection('titulo','Cargos Asignados'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Cargos asignados</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Cargos Asignados</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Listado de cargos asignados a los empleados</h5>
           <!--CONTENIDO -->
               <div class="table-responsiv">
                <table class="table table-bordered table-hover table-sm" id="datos">
                    <thead>
                        <tr>
                            <th class="text-center">CARGO</th>
                            <th class="text-center">EMPLEADO</th>
                            <th class="text-center">FECHA INICIO</th>
                            <th class="text-center">FECHA FIN</th>
                            <th class="text-center">opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $cargos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ce): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($ce->empleado != null): ?>
                        <tr>
                            <td><?php echo e($ce->cargo->nombre); ?> </td>
                            <td><?php echo e($ce->empleado->nombres); ?> <?php echo e($ce->empleado->ap_paterno); ?> <?php echo e($ce->empleado->ap_materno); ?></td>
                            <td><?php echo e(date('d-m-Y',strtotime($ce->fecha_inicio))); ?></td>
                            <td><?php if($ce->fecha_fin!=null): ?><?php echo e(date('d-m-Y',strtotime($ce->fecha_fin))); ?> <?php endif; ?></td>
                            <td class="d-flex justify-content-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargo_empleados.edit')): ?>
                                <a href="<?php echo e(route('cargo_empleados.edit', $ce->id)); ?>" class="btn btn-warning" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargo_empleados.destroy')): ?>
                                <?php echo Form::open(['route'=>['cargo_empleados.destroy',$ce->id],'method'=>'DELETE']); ?>

                                    <button class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar la ASIGNACION DEL CARGO?');"><i class="bi bi-trash"></i></button>
                                <?php echo Form::close(); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargo_empleados/index.blade.php ENDPATH**/ ?>