<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" >

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('home')); ?>" href="<?php echo e(route('home')); ?>">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li> 
      <li class="nav-heading">MODULO DE REGISTRO DE PACIENTES</li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['pacientes.index','pacientes.create','pacientes.edit','pacientes.ficha','pacientes.consulta'])); ?>" data-bs-target="#pacientes-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person-plus"></i><span>Registro de Pacientes</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pacientes.index')): ?>
          <ul id="pacientes-nav" class="nav-content collapse <?php echo e(mostrar(['pacientes.index','pacientes.create','pacientes.edit','pacientes. ficha','cargo_pacientes.*','pacientes.consulta'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pacientes.create')): ?>  
          <li>
              <a href="<?php echo e(route('pacientes.create')); ?>" class="<?php echo e(isActiveSubMenu('pacientes.create')); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
            </li>
            <?php endif; ?>
            <li>
              <a href="<?php echo e(route('pacientes.index')); ?>" class="<?php echo e(isActiveSubMenu(['pacientes.index','pacientes.edit','pacientes.ficha','pacientes.consulta'])); ?>">
                <i class="bi bi-circle"></i><span>Ver Todos</span>
              </a>
            </li>
          </ul>
          <?php endif; ?>
        </li>  
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['consultas*.*','buscar_pacientes'])); ?>"data-bs-target="#consultas-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-file-earmark-text"></i><span>Consultas</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="consultas-nav" class="nav-content collapse <?php echo e(mostrar(['consultas*.*','buscar_pacientes',])); ?>" data-bs-parent="#sidebar-nav">
                <li>
                  <a href="<?php echo e(route('consultas.index')); ?>" class="<?php echo e(isActiveSubMenu(['consultas.index','consultas.create','buscar_pacientes'])); ?>">
                    <i class="bi bi-circle"></i><span>Nuevo</span>
                  </a>
                </li>      
          </ul>
        </li>

         <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['internaciones*.*','buscar_pacientes_internacion'])); ?>"data-bs-target="#internaciones-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-file-earmark-text"></i><span>Internaciones</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="internaciones-nav" class="nav-content collapse <?php echo e(mostrar(['internaciones*.*','buscar_pacientes_internacion',])); ?>" data-bs-parent="#sidebar-nav">
                <li>
                  <a href="<?php echo e(route('internaciones.index')); ?>" class="<?php echo e(isActiveSubMenu(['internaciones.index','internaciones.create','buscar_pacientes_internacion'])); ?>">
                    <i class="bi bi-circle"></i><span>Nuevo</span>
                  </a>
                </li>      
          </ul>
        </li>

        <li class="nav-heading">MODULO DE ADMINISTRACION HOSPITALARIA</li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['medicos.index','medicos.create','medicos.edit','medicos.ficha','medicos.consulta'])); ?>" data-bs-target="#medicos-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person-plus"></i><span>Registro de M&eacute;dicos</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="medicos-nav" class="nav-content collapse <?php echo e(mostrar(['medicos.index','medicos.create','medicos.edit','medicos. ficha','cargo_medicos.*','medicos.consulta'])); ?>" data-bs-parent="#sidebar-nav">
            <li>
              <a href="<?php echo e(route('medicos.create')); ?>" class="<?php echo e(isActiveSubMenu('medicos.create')); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
            </li>
            <li>
              <a href="<?php echo e(route('medicos.index')); ?>" class="<?php echo e(isActiveSubMenu(['medicos.index','medicos.edit','medicos.ficha','medicos.consulta'])); ?>">
                <i class="bi bi-circle"></i><span>Ver Todos</span>
              </a>
            </li>
          </ul>
         <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['salas.index','salas.create','salas.edit','salas.ficha','salas.consulta'])); ?>" data-bs-target="#salas-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person-plus"></i><span>Registro de Salas</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="salas-nav" class="nav-content collapse <?php echo e(mostrar(['salas.index','salas.create','salas.edit','salas. ficha','cargo_salas.*','salas.consulta'])); ?>" data-bs-parent="#sidebar-nav">
            <li>
              <a href="<?php echo e(route('salas.create')); ?>" class="<?php echo e(isActiveSubMenu('salas.create')); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
            </li>
            <li>
              <a href="<?php echo e(route('salas.index')); ?>" class="<?php echo e(isActiveSubMenu(['salas.index','salas.edit','salas.ficha','salas.consulta'])); ?>">
                <i class="bi bi-circle"></i><span>Ver Todos</span>
              </a>
            </li>
          </ul>
        </li>  

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.index')): ?>
        <li class="nav-heading">MODULO DE SEGURIDAD DE ACCESOS</li>
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
        <?php endif; ?>
          </ul>

  </aside><!-- End Sidebar--><?php /**PATH C:\laragon\www\integrado\clinica_irca\resources\views/layouts/partials/menu.blade.php ENDPATH**/ ?>