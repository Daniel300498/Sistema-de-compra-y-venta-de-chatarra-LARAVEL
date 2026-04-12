<div class="modal fade" id="liberarItemModal-<?php echo e($ce->id); ?>" tabindex="-1" aria-labelledby="liberarItemModalLabel-<?php echo e($ce->id); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('cargoEmpleados.store_liberar', $ce->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="liberarItemModalLabel-<?php echo e($ce->id); ?>">Liberar Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <?php echo e(Form::label('tipo_baja', 'Tipo de Baja')); ?> <span class="text-danger">(*)</span>
                        <select required name="tipo_baja" id="tipo_baja_<?php echo e($ce->id); ?>" class="form-control <?php echo e($errors->has('tipo_baja') ? ' error' : ''); ?>">
                            <option value="">-- SELECCIONE --</option>
                            <option value="PROMOCION">PROMOCION</option>
                            <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                            <option value="AGRADECIMIENTO DE SERVICIOS">AGRADECIMIENTO DE SERVICIOS</option> 
                            <option value="ACEPTACION DE RENUNCIA">ACEPTACION DE RENUNCIA</option>
                            <option value="RETIRO POR ABANDONO">RETIRO POR ABANDONO</option>
                            <?php if($ce->cargo->tipo_cargo == "PERSONAL EVENTUAL" || $ce->cargo->tipo_cargo == "CONSULTOR POR PROGRAMA" || $ce->cargo->tipo_cargo == "CONSULTOR INDIVIDUAL DE LINEA"): ?>
                            <option value="TERMINACION DE CONTRATO">TERMINACION DE CONTRATO </option>
                            <?php endif; ?>
                        </select>
                        <?php if($errors->has('tipo_baja')): ?>
                            <span class="text-danger"><?php echo e($errors->first('tipo_baja')); ?></span>
                        <?php endif; ?>
                    </div>
                
                    <div class="mb-3">
                        <label for="fecha_fin_<?php echo e($ce->id); ?>" class="form-label">Fecha de Finalizacion</label><span class="text-danger">(*)</span>
                        <input type="date" class="form-control" id="fecha_fin_<?php echo e($ce->id); ?>" name="fecha_fin" required>
                    </div>
                    <div class="mb-3" id="memorandum-container_<?php echo e($ce->id); ?>" style="display: none;">
                        <label for="memorandum_<?php echo e($ce->id); ?>" class="form-label">Adjuntar Memorandum</label><span class="text-danger">(*)</span>
                        <input type="file" class="form-control" id="memorandum_<?php echo e($ce->id); ?>" name="memorandum">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Est&aacute; seguro que desea eliminar la relaci&oacute;n?');">Liberar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/forms/mostrarMemo.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargoEmpleados/modals/_modal_acefalo.blade.php ENDPATH**/ ?>