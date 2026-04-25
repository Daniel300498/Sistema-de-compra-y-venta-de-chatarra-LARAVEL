<?php $__env->startSection('titulo','Permisos'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>Permisos</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item active">Permisos</li>
            </ol>
            </nav>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permisos.create')): ?>
            <a href="<?php echo e(route('permisos.create')); ?>" class="btn btn-primary" title="Crea un nuevo rol con sus permisos">Agregar Nuevo</a>
        <?php endif; ?>
    </div>
 </div>
        
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Permisos Registrados</h5>
                <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle me-1"></i>
                    Los permisos son las acciones específicas que se pueden habilitar o restringir dentro del sistema (ver, crear, editar, eliminar).
                    Se agrupan por módulo y se asignan a los roles para controlar con precisión el acceso de cada usuario.
                </p>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm">
                        <thead >
                            <tr>
                                <th class="text-center">Nombre del acceso o ruta</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Grupo</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $permisos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-bold"><?php echo e($p->name); ?></td>
                                    <td class="text-center"><?php echo e($p->descripcion); ?></td>
                                    <td class="text-center"><?php echo e($p->grupo); ?></td>
                                    <td class="text-center">
                                      <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Opciones</button>
                                            <ul class="dropdown-menu">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proveedores.edit')): ?>
                                                <li><a class="dropdown-item" href="<?php echo e(route('permisos.edit',$p->id)); ?>"> <i class="bi bi-pencil"></i> Modificar</a></li>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proveedores.destroy')): ?>
                                                <li><a class="dropdown-item text-danger" href="<?php echo e(route('proveedores.destroy', $p->id)); ?>" onclick="return confirm('¿Eliminar este cliente?')"><i class="bi bi-trash"></i> Eliminar</a></li>
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
<script src="<?php echo e(asset('js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\chatarra\resources\views/permisos/index.blade.php ENDPATH**/ ?>