<?php $__env->startSection('titulo','PLANILLA REFRIGERIO'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>PLANILLA REFRIGERIO</h1>
    <div class="d-flex align-items-center justify-content-between">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Planilla Refrigerio</li>
          </ol>
        </nav>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refrigerios.create')): ?>
            <a href="<?php echo e(route('refrigerios.create')); ?>" class="btn btn-primary">Agregar Información</a>
        <?php endif; ?>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Información registrada por día para el refrigerio</h5>
           <!--CONTENIDO -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Nobre Empleado</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">CI</th>
                            <?php for($i = 1; $i <= 31; $i++): ?>
                            <th class="text-center"><?php echo e($i); ?></th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <?php
                        $empleado='';
                    ?>
                    <tbody>
                        <?php $__currentLoopData = $funcionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr> 
                            <td><?php echo e($f->nombre); ?></td>
                            <td><?php echo e($f->cargo); ?></td>
                            <td><?php echo e($f->ci); ?></td>
                            <?php for($i = 1; $i <= 31; $i++): ?>
                            <td>
                                <?php $__currentLoopData = $refrigerios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($r->funcionario_id==$f->id): ?>
                                        <?php if($r->dia == $i): ?>
                                        <?php echo e($r->tipo_dato); ?>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <?php endfor; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/refrigerios/index.blade.php ENDPATH**/ ?>