<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" >

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('home')); ?>" href="<?php echo e(route('home')); ?>">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li> 
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['pacientes.index','pacientes.create','pacientes.edit','pacientes.ficha','pacientes.consulta'])); ?>" href="<?php echo e(route('pacientes.index')); ?>">
            <i class="bi bi-person-plus"></i><span>Registro de Pacientes</span>
          </a>
        </li>      
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['consultas*.*','buscar_pacientes'])); ?>"href="<?php echo e(route('consultas.index')); ?>">
            <i class="bi bi-file-earmark-text"></i>
            <span>Consultas</span>
          </a>
        </li>

         <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['internaciones*.*','buscar_pacientes_internacion'])); ?>" href="<?php echo e(route('internaciones.index')); ?>">
            <i class="bi bi-file-earmark-text"></i>
            <span>Internaciones</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['medicos.index','medicos.create','medicos.edit','medicos.ficha','medicos.consulta'])); ?>" href="<?php echo e(route('medicos.index')); ?>">
            <i class="bi bi-person-plus"></i>
            <span>Registro de M&eacute;dicos</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['salas.index','salas.create','salas.edit','salas.ficha','salas.consulta'])); ?>" href="<?php echo e(route('salas.index')); ?>">
            <i class="bi bi-person-plus"></i>
         <span>Registro de Salas</span>
          </a>
        </li>  
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permisos.index')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(isActiveRoute('permisos.*')); ?>" href="<?php echo e(route('permisos.index')); ?>">
              <i class="bi bi-people"></i>
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
        
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('users.*')); ?>" href="<?php echo e(route('users.index')); ?>">
            <i class="bi bi-people"></i>
            <span>Usuarios</span>
          </a>
        </li>

          </ul>

  </aside><!-- End Sidebar--><?php /**PATH C:\laragon\www\chatarra\resources\views/layouts/partials/menu.blade.php ENDPATH**/ ?>