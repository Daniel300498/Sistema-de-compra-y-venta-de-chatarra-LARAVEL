<div class="modal fade" id="modalNoticia<?php echo e($noticia->uuid); ?>" tabindex="-1" aria-labelledby="modalNoticiaLabel<?php echo e($noticia->uuid); ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNoticiaLabel<?php echo e($noticia->uuid); ?>"><?php echo e($noticia->titulo); ?></h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Fecha de Publicaci&oacute;n:</strong> <?php echo e(date('d-m-Y', strtotime($noticia->fecha_publicacion))); ?></p>
                <p><strong>Descripci&oacute;n:</strong> <?php echo e($noticia->descripcion); ?></p>
                <p><a href="<?php echo e(asset('publicaciones/' . $noticia->documento)); ?>" target="_blank" class="btn btn-primary">Ver Documento</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/publicaciones/modal/_modal_noticias.blade.php ENDPATH**/ ?>