<div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="background-color: rgba(199, 195, 195, 0.929); border-radius: 10px;">
            <div class="modal-header">
                <div class="modal-footer justify-content-center">
                    <div class="btn-group" role="group" aria-label="Tipos de Documentos">
                        <?php $__currentLoopData = $noticiasFiltradas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo => $noticiasPorTipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" class="btn btn-primary back-color-second" data-bs-target="#newsCarousel" data-bs-slide-to="<?php echo e($loop->index); ?>"><?php echo e($tipo); ?></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #ff0000; font-size: 2.5rem; opacity: 1;"></button>
            </div>
            <div class="modal-body">
                <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php $__currentLoopData = $noticiasFiltradas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo => $noticiasPorTipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php if($loop->first): ?> active <?php endif; ?>">
                                <?php $__currentLoopData = array_chunk($noticiasPorTipo->all(), 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row">
                                        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noticia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-12">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-center"><?php echo e($noticia->titulo); ?></h5>
                                                        <div class="card-body">
                                                            <p class="card-text small"><strong>Descripci&oacute;n:</strong> <?php echo e($noticia->descripcion); ?></p>
                                                            <p class="card-text small"><strong>Fecha de Publicaci&oacute;n:</strong> <?php echo e(date('d-m-Y', strtotime($noticia->fecha_publicacion))); ?></p>
                                                            <p class="card-text small"><strong>Fecha de Caducidad:</strong> <?php echo e(date('d-m-Y', strtotime($noticia->fecha_caducidad))); ?></p>
                                                            <p class="card-text">
                                                                <a href="<?php echo e(asset('publicaciones/' . $noticia->documento)); ?>" target="_blank" class="btn btn-primary">Ver Documento</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/forms/mostrarPublicaciones.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/publicaciones/modal/_modal_ver_noticia.blade.php ENDPATH**/ ?>