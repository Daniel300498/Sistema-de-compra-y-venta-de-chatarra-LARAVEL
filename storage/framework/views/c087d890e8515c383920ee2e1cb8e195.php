<aside id="sidebar" class="sidebar" >
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('home')); ?>" href="<?php echo e(route('home')); ?>">
          <i class="bi bi-house"></i>
          <span>Dashboard</span>
        </a>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proveedores.index')): ?>
      </li> 
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['proveedores.index','proveedores.create','proveedores.edit','proveedores.ficha','proveedores.consulta'])); ?>" href="<?php echo e(route('proveedores.index')); ?>">
            <i class="bi bi-box-seam"></i><span>Proveedores</span>
          </a>
        </li>      
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('camiones.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['camiones.index'])); ?>" href="<?php echo e(route('camiones.index')); ?>">
            <i class="bi bi-truck"></i>
            <span>Transporte</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clientes.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['clientes.index','clientes.create','clientes.edit','clientes.ficha','clientes.consulta'])); ?>" href="<?php echo e(route('clientes.index')); ?>">
            <i class="bi bi-people"></i>
            <span>Clientes</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contratos.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['contratos.index'])); ?>" href="<?php echo e(route('contratos.index')); ?>">
            <i class="bi bi-file-earmark-text"></i>
            <span>Contratos</span>
          </a>
        </li>
        <?php endif; ?>        

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permisos.index')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(isActiveRoute('permisos.*')); ?>" href="<?php echo e(route('permisos.index')); ?>">
              <i class="bi bi-shield-lock"></i>
              <span>Permisos</span>
          </a>
        </li>
        <?php endif; ?>
         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles.index')): ?>       
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('roles.*')); ?>" href="<?php echo e(route('roles.index')); ?>">
            <i class="bi bi-sliders"></i>
            <span>Roles</span>
          </a>
        </li>
        <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('usuarios.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('users.*')); ?>" href="<?php echo e(route('users.index')); ?>">
            <i class="bi bi-people"></i>
            <span>Usuarios</span>
          </a>
        </li>
<?php endif; ?>
          </ul>

  </aside><!-- End Sidebar--><?php /**PATH C:\laragon\www\chatarra\resources\views/layouts/partials/menu.blade.php ENDPATH**/ ?>