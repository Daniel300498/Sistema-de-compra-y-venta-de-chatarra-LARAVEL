<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones</title>  
</head>
<body class="body-login">
    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-6">
                <img src="<?php echo e(asset('assets/img/logoh.png')); ?>" alt="Logo" class="img-fluid" style="max-height: 80px;">
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="<?php echo e(route('login')); ?>" class="btn btn-primary back-color-second">Acceder al sistema</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body bg-transparent">
                        </br>
                        <strong><h2 class="text-center">Bienvenido al Portal de Publicaciones!</h2></strong>
                        </br>
                        <p class="text-center">Encontrarás contenido actualizado diariamente para mantenerte informado. Aquí podrás acceder a formatos, comunicados, reglamentos, normativas y formularios de interés. Nuestro objetivo es proporcionarte información relevante y precisa, de una manera fácil y accesible. Navega por las secciones, y accede a la publicacion completa presionando sobre el titulo de la misma</p>
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
</body>
</html>
<?php /**PATH C:\laragon\www\sistema_rrhh\resources\views/publicaciones/shoWelcome.blade.php ENDPATH**/ ?>