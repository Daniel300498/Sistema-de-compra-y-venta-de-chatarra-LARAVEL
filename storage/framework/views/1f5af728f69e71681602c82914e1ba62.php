<div class="modal fade" id="renovarModal<?php echo e($noticia->uuid); ?>" tabindex="-1" aria-labelledby="renovarModalLabel<?php echo e($noticia->uuid); ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="renovarModalLabel<?php echo e($noticia->uuid); ?>"><?php echo e($noticia->titulo); ?></h5> 
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Tipo de Noticia:</strong> <?php echo e($noticia->tipo); ?></p>
                <p><strong>Descripci&oacute;n:</strong></p>
                <p><?php echo e($noticia->descripcion); ?></p>
                <p><strong>Fecha de Caducidad Actual:</strong> Caducado en fecha <?php echo e($noticia->fecha_caducidad); ?></p>
                <p><a href="<?php echo e(asset('publicaciones/' . $noticia->documento)); ?>" target="_blank" class="btn btn-secondary">Ver Documento</a></p>
                <hr>
                <form action="<?php echo e(route('publicacion.renovar', $noticia->uuid)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="fecha_caducidad" class="form-label">Nueva Fecha de Caducidad:</label>
                            <input type="date" id="fecha_caducidad" name="fecha_caducidad" class="form-control" required>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">Renovar Publicaci&oacute;n</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/publicaciones/modal/_modal_renovar.blade.php ENDPATH**/ ?>