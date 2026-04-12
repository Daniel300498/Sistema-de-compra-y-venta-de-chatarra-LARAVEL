<div class="modal fade" id="editarfecha-<?php echo e($ce->id); ?>" tabindex="-1" aria-labelledby="editarfechaLabel-<?php echo e($ce->id); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('cargoEmpleados.store_fecha', $ce->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    
                    <h5 class="modal-title" id="editarfechaLabel-<?php echo e($ce->id); ?>">Editar Fecha Inicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
            
                    <div class="mb-3">
                        <label for="fecha_inicio_<?php echo e($ce->id); ?>" class="form-label">Fecha de Inicio</label><span class="text-danger">(*)</span>
                        <input type="date" class="form-control" id="fecha_inicio_<?php echo e($ce->id); ?>" name="fecha_inicio" value="<?php echo e(old('fecha_inicio', $ce->fecha_inicio)); ?>" required>

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Está seguro que desea cambiar la fecha de inicio?');">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/cargoEmpleados/modals/_modal_fecha_ini.blade.php ENDPATH**/ ?>