<!-- Modal principal para la noticia -->
<div class="modal fade" id="noticiaModal<?php echo e($noticia->uuid); ?>" tabindex="-1" aria-labelledby="noticiaModalLabel<?php echo e($noticia->uuid); ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticiaModalLabel<?php echo e($noticia->uuid); ?>"><?php echo e($noticia->titulo); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Tipo de Noticia:</strong> <?php echo e($noticia->tipo); ?></p>
                <p><?php echo e($noticia->descripcion); ?></p>
                <p><strong>Fecha de Publicación:</strong> <?php echo e(date('d-m-Y', strtotime($noticia->fecha_publicacion))); ?></p>
                <p><strong>Fecha de Caducidad:</strong> <?php echo e(date('d-m-Y', strtotime($noticia->fecha_caducidad))); ?></p>
                <p><a href="<?php echo e(asset('publicaciones/' . $noticia->documento)); ?>" target="_blank" class="btn btn-secondary">Ver Documento</a></p>
            </div>
            <div class="modal-footer">
            <form action="<?php echo e(route('publicacion.aprobar', $noticia->uuid)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <button type="submit" class="btn btn-primary" name="estado" value="1" onclick="return confirm('¿Está seguro que desea aprobar?');">Aprobar</button>
            </form>
            <form action="<?php echo e(route('publicacion.aprobar', $noticia->uuid)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="estado" value="0">
                <input type="hidden" name="motivo" value="Anulado">
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro que desea rechazar la publicación?');">Rechazar</button>
            </form>

            </div>
        </div>
    </div>
</div>


<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/publicaciones/modal/_modal_publicar.blade.php ENDPATH**/ ?>