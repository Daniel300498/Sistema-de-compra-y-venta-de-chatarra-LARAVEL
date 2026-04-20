<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css' rel='stylesheet' />
  <title><?php echo $__env->yieldContent('titulo'); ?></title>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php echo $__env->make('layouts.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>var url_global='<?php echo e(url("/")); ?>';</script>
</head>
<body>
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="<?php echo e(route('home')); ?>" class="logo d-flex align-items-center">
        <img src="<?php echo e(asset('assets/img/irca.png')); ?>" alt="">
        <span class="d-none d-lg-block">CONTROL DE CHATARRA </br> Sistema de Gestión</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
     

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo e(Auth::user()->name); ?></span> 
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo e(auth()->user()->name); ?></h6>
              <span></span><br>
              <span></span><br>
              <span></span>
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

</html><?php /**PATH C:\laragon\www\chatarra\resources\views/layouts/app.blade.php ENDPATH**/ ?>