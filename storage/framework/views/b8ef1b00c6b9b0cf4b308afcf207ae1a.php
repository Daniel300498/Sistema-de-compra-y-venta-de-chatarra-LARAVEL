<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css' rel='stylesheet' />
  <title><?php echo $__env->yieldContent('titulo'); ?> | <?php echo e(config('app.name')); ?></title>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php echo $__env->make('layouts.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script>var url_global='<?php echo e(url("/")); ?>';</script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?php echo e(route('home')); ?>" class="logo d-flex align-items-center">
        <img src="<?php echo e(asset('assets/img/logo_oficial.jpg')); ?>" alt="">
        <span class="d-none d-lg-block">SISTEMA INTEGRADO DE ADMINISTRACI&Oacute;N DE<br>PERSONAL GADLP-SIAP</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
      <?php if(auth()->user()->rol[0]->id!=9): ?>
      <?php if(auth()->user()->rol[0]->id!=4): ?>
      <?php $suma=0; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.index')): ?> <?php if($licenciaRequests > 0): ?> <?php $suma+= 1; ?> <?php endif; ?> <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orden_salida.index')): ?> <?php if($ordenSalidaRequests > 0): ?> <?php $suma+= 1; ?> <?php endif; ?> <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publicacion.index')): ?> <?php if($publicacionRequests > 0): ?> <?php $suma+= 1; ?> <?php endif; ?> <?php endif; ?> 
      <?php if($publicacionHoy > 0): ?><?php $suma+= 1; ?> <?php endif; ?>
        <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-bell"></i>
              <span class="badge bg-primary badge-number"><?php echo e($suma); ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
              <li class="dropdown-header" style="width: 300px;"> Tienes nuevas solicitudes </li>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.index')): ?>
              <?php if($licenciaRequests > 0): ?>
              <li><hr class="dropdown-divider"></li>
              <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                  <h4>Solicitudes Licencia</h4>
                  <p>Tienes <?php echo e($licenciaRequests); ?> solicitudes pendientes</p>
                  <p><a href="<?php echo e(route('licencias.index')); ?>"><span class="badge rounded-pill bg-primary p-2 ms-2">Ver todas</span></a></p>
                </div>
              </li>
              <?php endif; ?>
              <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orden_salida.index')): ?>
              <?php if($ordenSalidaRequests > 0): ?>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                  <h4>Solicitudes Orden de Salida</h4>
                  <p>Tienes <?php echo e($ordenSalidaRequests); ?> solicitudes pendientes</p>
                  <p><a href="<?php echo e(route('orden_salida.index')); ?>"><span class="badge rounded-pill bg-primary p-2 ms-2">Ver todas</span></a></p>
                </div>
              </li>
              <?php endif; ?>
              <?php endif; ?>
           
              <li><hr class="dropdown-divider"></li>
              <?php if($publicacionHoy+$publicacionRequests>0): ?>
                <?php if($publicacionHoy): ?>
                <li class="notification-item">
                  <i class="bi bi-check-circle text-success"></i>
                  <div>
                    <h4>Publicaciones</h4>
                      <p>Existe <?php echo e($publicacionHoy); ?> Publicaci��n/es de hoy, <?php echo e(\Carbon\Carbon::now()->format('d/m/Y')); ?>.</p>
                      <p><a href="<?php echo e(route('publicacion.show')); ?>"><span class="badge rounded-pill bg-primary p-2 ms-2">Ver Publicaciones</span></a></p>              
                  </div>
                </li>
                <?php endif; ?>
                <?php if($publicacionRequests): ?>
                <li class="notification-item">
                  <i class="bi bi-exclamation-circle text-danger"></i>
                  <div>
                    <h4>Publicaciones</h4>
                    <p>Existe <?php echo e($publicacionRequests); ?> Publicaci&oacute;n/es Pendiente/s de Aprobaci&oacute;n </p>
                    <p><a href="<?php echo e(route('publicacion.index')); ?>"><span class="badge rounded-pill bg-primary p-2 ms-2">Ver Pendientes</span></a></p>
                  </div>
                </li>
                <?php endif; ?>
              <?php endif; ?>
        
              <li class="dropdown-footer"> <a href="#">Show all notifications</a> </li>
            </ul>
        </li>
        <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo e(asset('assets/avatar/'.Auth::user()->avatar)); ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo e(Auth::user()->name); ?></span> 
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo e(auth()->user()->name); ?></h6>
              <span><?php echo e(auth()->user()->rol[0]->name); ?></span><br>
              <span><?php if(auth()->user()->empleado_id != null): ?>CARGO: <?php echo e(auth()->user()->empleado->cargo[0]->nombre); ?><?php endif; ?></span><br>
              <span><?php if(auth()->user()->empleado_id != null): ?>AREA: <?php echo e(auth()->user()->empleado->cargo[0]->area->nombre); ?><?php endif; ?></span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('users.show',auth()->user()->uuid)); ?>">
                <i class="bi bi-person"></i>
                <span>Mis Datos</span>
              </a>
            </li> <hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center text-danger" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Salir</span>
              </a>
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
  <?php echo $__env->make('layouts.partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <main id="main" class="main"> <?php echo $__env->yieldContent('content'); ?></main>
  <footer id="footer" class="footer"></footer>
  <?php echo $__env->make('layouts.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/layouts/app.blade.php ENDPATH**/ ?>