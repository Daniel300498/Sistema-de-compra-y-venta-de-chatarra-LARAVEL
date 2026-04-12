<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title">Historial de Contratos</h5>
                    </div>
                    <?php if($contratos_lista && $contratos_lista->count() > 0): ?>
                        <p>Si necesita realizar una corrección del registro previamente ingresado, puede utilizar la opción "Modificar datos" y volver a ingresarlo.</p>
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">Fecha de Inicio</th>
                                    <th class="text-center">Fecha de Finalización</th>
                                    <th class="text-center">Nro de Contrato</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $contratos_lista; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($document->fecha_ini); ?></td>
                                        <td class="text-center"><?php echo e($document->fecha_fin); ?></td>
                                        <td class="text-center"><?php echo e($document->nro_contrato); ?></td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contratos.edit')): ?>
                                                    <li><a class="dropdown-item" target="_blank" href="<?php echo e(asset('contratos/' . $document->documento)); ?>">Ver Contrato</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo e(route('contratos.edit', $document->uuid)); ?>">Modificar Contrato</a></li>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contratos.destroy')): ?>
                                                    <li>
                                                        <form action="<?php echo e(route('contratos.destroy', $document->id)); ?>" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar el contrato?');">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="dropdown-item">Eliminar Contrato</button>
                                                        </form>
                                                    </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center">No hay contratos disponibles en este momento.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/contratos/secciones/contratos.blade.php ENDPATH**/ ?>