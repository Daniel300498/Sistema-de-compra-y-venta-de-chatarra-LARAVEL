

<?php $__env->startSection('titulo','DATOS REFRIGERIO'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>PLANILLA REFRIGERIO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Refrigerios</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Llenado de datos para pago de refrigerios</h5>
           <!--CONTENIDO -->
           <?php echo Form::open(['route'=>'refrigerios.store','class'=>'form-horizontal']); ?>

                <?php echo $__env->make('refrigerios._form',['texto' => 'Registrar','color'=>'primary'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Llenado de datos para pago de refrigerios</h5>
           <!--CONTENIDO -->
           <div class="table-responsive">
            <table class="table table-bordered" id="datos">
                <thead>
                    <tr>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">CI</th>
                        <?php for($i = 1; $i <= 31; $i++): ?>
                              <th class="text-center"><?php echo e($i); ?></th>
                             <?php endfor; ?>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $refrigerios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                         
                            <td class="text-left"><?php echo e($r->mes); ?></td>
                            <td class="text-left"> <?php echo e($r->ap_paterno); ?> <?php echo e($r->ap_materno); ?> <?php echo e($r->nombres); ?></td>
                            <td class="text-left"><?php echo e($r->descripcion); ?></td>
                            <td class="text-left"><?php echo e($r->ci); ?></td>
                             <?php for($i = 1; $i <= 31; $i++): ?>
                                            <?php $valor = $r->{'col_'.$i}; ?>
                                            <td class="text-left"><?php echo e($valor); ?></td>
                                        <?php endfor; ?>
                            <td class="d-flex align-items-center justify-content-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refrigerios.edit')): ?>
                                    <a href="<?php echo e(route('refrigerios.edit',$r->id)); ?>" class="btn btn-primary btn-sm">Editar</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refrigerios.destroy')): ?>
                                    <a href="<?php echo e(route('refrigerios.destroy',$r->id)); ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
    <script>
        $("#funcionario_id").select2({
            placeholder: '--SELECCIONE--',
            width: 'resolve'
        }).on('select2-open', function () {
            // Adding Custom Scrollbar
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/refrigerios/create.blade.php ENDPATH**/ ?>