<?php $__env->startSection('titulo',''); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
     <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
        <h1>Registro de Internaciones</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('internaciones.index')); ?>">Internaciones</a></li>
                <li class="breadcrumb-item active"> Nuevo</li>
            </ol>
            </nav>
        </div>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pacientes.create')): ?>
            <a href="<?php echo e(route('pacientes.create')); ?>" class="btn btn-primary MB-3">Registrar Paciente</a>
        <?php endif; ?>
    </div>
 </div>
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Registrar Internaci&oacute;n</h5>
            <p>Puede <strong>REGISTRAR</strong> o <strong>VER</strong> la informaci&oacute;n de las internaciones de cada paciente registrado, para ello  puede ingresar el nombre o C.I. para ubicarlo en el sistema y acceder a la opci&oacute;n correspondiente. En caso de que el paciente no se encuentre registrado 
            puedo crearlo con el bot&oacute;n <strong>Registrar Paciente</strong></p>

            <form action="<?php echo e(route('buscar_pacientes_internacion')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <label for="nombre" class="col-md-4 col-control label text-right">Nombre del paciente</label>
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
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary">Buscar Pacientes</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
<?php if($pacientes != null): ?>
    <section class="section">
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Paciente(s) encontrados según la busqueda</h5>
                <p class="text-justify">Cada paciente tiene la opción de adjuntar una o varias internaciones <span class="btn btn-warning"><i class="bi-paperclip"></i></span>, solo tiene que presionarlo para acceder al registro correspondiente.</p>
            <!--CONTENIDO -->
                <div class="table-responsive">
                    <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre Completo</th>
                                <th class="text-center">CI</th>
                                <th class="text-center">Opción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></td>
                                    <td class="text-center"><?php echo e($e->ci); ?> <?php if($e->ci_complemento != null): ?> - <?php echo e($e->ci_complemento); ?> <?php endif; ?> <?php echo e($e->ci_lugar); ?></td>
                                    <td class="d-flex justify-content-center" >
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('internaciones.create')): ?>
                                            <a href="<?php echo e(route('internaciones.create',$e->uuid)); ?>" class="btn btn-warning" title="Ver / Registrar"><i class="bi-paperclip"></i></a>
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
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/internaciones/internacion.blade.php ENDPATH**/ ?>