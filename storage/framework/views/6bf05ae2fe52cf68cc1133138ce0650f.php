<?php $__env->startSection('titulo','Publicaciones'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <div>
            <h1>Publicaciones</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Publicaciones</a></li>
                    <li class="breadcrumb-item active">Listar Publicaciones</li>
                </ol>
            </nav>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publicacion.create')): ?>
            <a href="<?php echo e(route('publicacion.create')); ?>" class="btn btn-primary mb-3">Agregar Publicación</a>     
        <?php endif; ?>
    </div>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Publicaciones Registradas</h5>
                    <p class="mb-0">Desde el botón <strong>Filtrar Publicaciones</strong> puede ver todas las publicaciones.</p>
                    <p></p>
                        
                    <!-- Filter Dropdown -->
                    <div class="dropdown mb-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Filtrar Publicaciones
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item filter-option" href="#" data-filter="ACTIVO">Publicaciones Activas</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="PROGRAMADO">Publicaciones Programadas</a></li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publicacion.renovar')): ?>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="CADUCADO">Publicaciones Caducadas</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="PENDIENTE">Publicaciones Pendientes de Revisi&oacute;n</a></ 
                            <li><a class="dropdown-item filter-option" href="#" data-filter="REVISADA">Publicaciones Pendientes de Publicaci&oacute;n</a></li>
                        </ul>
                    </div>

                    <!-- Filter Title -->
                    <h5 class="filter-title bg-primary text-white text-center p-2 rounded" id="filterTitle" style="display: none;">Publicaciones Programadas</h5>

                    <div class="table-responsive" id="tablaPublicaciones" style="display: none;">    
                        <p class="mb-0">Desde el menú de <strong>Opciones</strong> puede ver el documento adjunto, editar o eliminar una Publicación.</p>
                        <p>Puede utilizar el filtro <strong>Buscador Gral.</strong> para encontrar la Publicación que corresponda.</p>
                        <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Fecha de Registro</th>
                                    <th class="text-center">Fecha de Publicación</th>
                                    <th class="text-center">Fecha de Caducidad</th>
                                    <th class="text-center">Tipo de Noticia</th>
                                    <th class="text-center">T&iacute;tulo</th>
                                    <th class="text-center">Opciones</th>   
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $portal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noticia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="publication-row" data-status="<?php echo e($noticia->custom_status); ?>"
                                    <?php if($noticia->custom_status == 'PROGRAMADO'): ?>
                                    class="bg-info"
                                    <?php elseif($noticia->custom_status == 'ACTIVO'): ?>
                                    class="bg-success"
                                    <?php elseif($noticia->custom_status == 'CADUCADO'): ?>
                                    class="bg-danger"
                                    <?php elseif($noticia->custom_status == 'PENDIENTE'): ?>
                                    class="bg-warning"
                                    <?php endif; ?>>             

                                    <?php if($noticia->motivo): ?>                   
                                    <td class="text-center"><h5><span class="badge bg-danger">ANULADO</span></h5></td>
                                    <?php else: ?>
                                    <td class="text-center"><?php echo e($noticia->estado); ?></td>
                                    <?php endif; ?>
                                    <td class="text-center"><?php echo e($noticia->fecha_registro_format); ?></td>
                                    <?php if($noticia->estado == 0 || $noticia->estado == 1): ?>
                                    <td class="text-center"><?php echo e("NO SE PUBLICÓ"); ?></td>     
                                    <?php else: ?> 
                                    <td class="text-center"><?php echo e($noticia->fecha_publicacion_format); ?></td>
                                    <?php endif; ?>
                                    <?php if($noticia->estado == 2 && $noticia->fecha_caducidad < \Carbon\Carbon::now()->format('Y-m-d')): ?>
                                    <td class="text-center"><?php echo e("Caducado en fecha ".$noticia->fecha_caducidad); ?></td>
                                    <?php else: ?>
                                    <td class="text-center"><?php echo e($noticia->fecha_caducidad_format); ?></td>
                                    <?php endif; ?>
                                    <td class="text-center"><?php echo e($noticia->tipo); ?></td>
                                    <td class="text-center"><?php echo e($noticia->titulo); ?></td>
                                                           
                                    <td class="d-flex justify-content-center">
                                    <div class="btn-group" role="group">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publicacion.publicar')): ?>
                                        <?php if($noticia->estado == 1): ?>     
                                        <form action="<?php echo e(route('publicacion.publicar', $noticia->uuid)); ?>" method="POST" <?php if($noticia->fecha_publicacion < \Carbon\Carbon::now()->format('Y-m-d')): ?> onsubmit="return confirm('La fecha de publicación se actualizará a la fecha de hoy ¿desea continuar?');" <?php else: ?> onsubmit="return confirm('¿Está seguro que desea publicar?');" <?php endif; ?>>
                                        <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-primary btn-sm me-2">Publicar</button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" target="_blank" href="<?php echo e(asset('publicaciones/' . $noticia->documento)); ?>">Ver Documentación</a></li>
                                            <li> 
                                                <?php if($noticia->estado == 2 && $noticia->fecha_caducidad < \Carbon\Carbon::now()->format('Y-m-d')): ?>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#renovarModal<?php echo e($noticia->uuid); ?>">Vista Preliminar / Renovar</a></li>
                                                <?php elseif($noticia->estado == 0): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publicacion.aprobar')): ?>
                                                    <?php if(!$noticia->motivo): ?>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#noticiaModal<?php echo e($noticia->uuid); ?>"> Vista Preliminar / Aprobar - Rechazar</a>
                                                    </li>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </li>            
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publicacion.edit')): ?>
                                                <?php if(!$noticia->motivo): ?>
                                                    <li><a class="dropdown-item" href="<?php echo e(route('publicacion.edit',$noticia->uuid)); ?>">Modificar Publicación</a></li>
                                                <?php endif; ?>
                                            <?php endif; ?>        
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publicacion.destroy')): ?>
                                                <li>
                                                    <form action="<?php echo e(route('publicacion.destroy', $noticia->uuid)); ?>" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar la publicación?');">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="dropdown-item">Eliminar Publicación</button>
                                                    </form>
                                                </li>
                                            <?php endif; ?>          
                                        </ul>
                                    </div>
                                </td>

                                </tr>
                                <?php echo $__env->make('publicaciones.modal._modal_renovar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('publicaciones.modal._modal_publicar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<script src="<?php echo e(asset('assets/js/tablas/publicaciones.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/publicaciones/index.blade.php ENDPATH**/ ?>