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
                    <li class="breadcrumb-item active">Ver Publicaciones</li>
                </ol>
            </nav>
        </div>
    </div>
</div><!-- End Page Title -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body bg-transparent">
                        </br>
                        <strong><h2 class="text-center">Bienvenido al Portal de Publicaciones!</h2></strong>
                        </br>
                        <p class="text-center">Encontrarás contenido actualizado diariamente para mantenerte informado. Aquí podrás acceder a formatos, comunicados, reglamentos, normativas y formularios de interés. Nuestro objetivo es proporcionarte información relevante y precisa, de una manera fácil y accesible. Navega por las secciones, y accede a la publicaci&oacute;n completa presionando sobre el t&iacute;tulo de la misma</p>
                        <?php $__currentLoopData = $grupoPublicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo => $publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-4">
                            <h3 class="text-uppercase text-center"><?php echo e($tipo); ?></h3>
                            <div class="row row-cols-1 row-cols-md-4 g-4"> 
                                <?php $__currentLoopData = $publicacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noticia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col mb-4">
                                    <button type="button" class="btn btn-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalNoticia<?php echo e($noticia->uuid); ?>">
                                        <div class="card position-relative">
                                            <div class="card-body">
                                                <?php if($noticia->es_nuevo): ?>
                                                    <span class="badge btn-primary back-color-second">Nuevo</span>
                                                <?php endif; ?>
                                                <h5 class="card-title"><?php echo e($noticia->titulo); ?></h5>
                                               <p class="card-text"><small class="text-muted">Fecha de Publicaci&oacute;n: <?php echo e(date('d-m-Y', strtotime($noticia->fecha_publicacion))); ?></small></p>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                                <?php echo $__env->make('publicaciones.modal._modal_noticias', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($hayNoticias): ?>
        <?php echo $__env->make('publicaciones.modal._modal_ver_noticia', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/publicaciones/show.blade.php ENDPATH**/ ?>