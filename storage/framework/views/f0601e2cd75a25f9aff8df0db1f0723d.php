<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" >

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('home')); ?>" href="<?php echo e(route('home')); ?>">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li>  
       <li class="nav-heading">MODULO DE SEGURIDAD DE ACCESOS</li>
       <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('permisos.*')); ?>" href="<?php echo e(route('permisos.index')); ?>">
            <i class="bi bi-people"></i>
            <span>Permisos</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('roles.*')); ?>" href="<?php echo e(route('roles.index')); ?>">
            <i class="bi bi-sliders"></i>
            <span>Roles</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('users.*')); ?>" href="<?php echo e(route('users.index')); ?>">
            <i class="bi bi-people"></i>
            <span>Usuarios</span>
          </a>
        </li>
          </ul>

  </aside><!-- End Sidebar--><?php /**PATH C:\laragon\www\INTEGRADO\dashboard_irca\resources\views/layouts/partials/menu.blade.php ENDPATH**/ ?>