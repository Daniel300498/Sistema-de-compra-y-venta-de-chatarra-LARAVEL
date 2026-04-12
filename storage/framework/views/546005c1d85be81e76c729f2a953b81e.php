

<?php $__env->startSection('titulo','Feriados'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Feriados</h1>
    <div class="d-flex align-items-center justify-content-between">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Feriados Nacionales y Generales</li>
          </ol>
        </nav>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('feriados.create')): ?>
            <button class="btn btn-success" onclick="create();" ><i class="bi bi-plus"></i>Agregar Nuevo</button>
        <?php endif; ?>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Listado de feriados</h5>
           <!--CONTENIDO -->
           <p>En el listado de feriados el tipo <strong>General</strong> indica que son fechas que se repiten todos los años, y <strong>Anual</strong> indica que es una feriado solo para el año en curso.</p>
            <div class="table-responsive table-sm">
                <input type="hidden" value="<?php echo e(auth()->user()->can('feriados.destroy')); ?>" id='can_destroy'>
                <input type="hidden" value="<?php echo e(auth()->user()->can('feriados.edit')); ?>" id='can_edit'>
                <table class="table table-bordered table-hover table-sm" id="datos">
                    <thead>
                        <tr>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Descripción</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
    <?php echo $__env->make('feriados._modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/forms/crudFeriados.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/feriados/index.blade.php ENDPATH**/ ?>