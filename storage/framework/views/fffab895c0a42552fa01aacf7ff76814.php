<?php $__env->startSection('titulo','Roles Sistema'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>Roles de Acceso</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
            </nav>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles.create')): ?>
            <a href="<?php echo e(route('roles.create')); ?>" class="btn btn-primary" title="Crea un nuevo rol con sus permisos">Agregar Nuevo</a>
        <?php endif; ?>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Roles de accceso registrados</h5>
           <!--CONTENIDO -->
           <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Rol</th>
                        <th class="text-center ">Descripción</th>
                        <th class="text-center ">Nro usuarios <br>con el rol</th>
                        <th class="text-center" >Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="fw-bold"><?php echo e($role->name); ?></td>
                            <td class="text-wrap"><?php echo e($role->descripcion); ?></td>
                            <td class="text-wrap text-center"><h5><span class="badge bg-secondary"><?php echo e($role->users_count); ?> Usuarios</span></h5></td>
                            <td class="d-flex justify-content-center" >
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      Opciones
                                    </button>
                                    <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="<?php echo e(route('roles.show',$role->uuid)); ?>">Ver Permisos asignados</a></li> 
                                            <li><a class="dropdown-item" href="<?php echo e(route('roles.edit',$role->uuid)); ?>">Modificar Permisos</a></li>
                                            <li><a class="dropdown-item" href="<?php echo e(route('roles.destroy',$role->uuid)); ?>" onclick="return confirm('¿Está seguro que desea eliminar el ROL?');">Eliminar Rol</a></li>
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
<script src="<?php echo e(asset('js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/roles/index.blade.php ENDPATH**/ ?>