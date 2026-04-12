<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" >

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute('home') }}" href="{{ route('home') }}">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li> 
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute(['pacientes.index','pacientes.create','pacientes.edit','pacientes.ficha','pacientes.consulta']) }}" href="{{ route('pacientes.index') }}">
            <i class="bi bi-person-plus"></i><span>Registro de Pacientes</span>
          </a>
        </li>      
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute(['consultas*.*','buscar_pacientes'])  }}"href="{{ route('consultas.index') }}">
            <i class="bi bi-file-earmark-text"></i>
            <span>Consultas</span>
          </a>
        </li>

         <li class="nav-item">
          <a class="nav-link {{ isActiveRoute(['internaciones*.*','buscar_pacientes_internacion'])  }}" href="{{ route('internaciones.index') }}">
            <i class="bi bi-file-earmark-text"></i>
            <span>Internaciones</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute(['medicos.index','medicos.create','medicos.edit','medicos.ficha','medicos.consulta']) }}" href="{{ route('medicos.index') }}">
            <i class="bi bi-person-plus"></i>
            <span>Registro de M&eacute;dicos</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link {{ isActiveRoute(['salas.index','salas.create','salas.edit','salas.ficha','salas.consulta']) }}" href="{{ route('salas.index') }}">
            <i class="bi bi-person-plus"></i>
         <span>Registro de Salas</span>
          </a>
        </li>  
        @can('permisos.index')
        <li class="nav-item">
            <a class="nav-link {{ isActiveRoute('permisos.*') }}" href="{{ route('permisos.index') }}">
              <i class="bi bi-people"></i>
              <span>Permisos</span>
          </a>
        </li>
        @endcan
         @can('roles.index')       
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('roles.*') }}" href="{{ route('roles.index') }}">
            <i class="bi bi-sliders"></i>
            <span>Roles</span>
          </a>
        </li>
        @endcan
        
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('users.*') }}" href="{{ route('users.index') }}">
            <i class="bi bi-people"></i>
            <span>Usuarios</span>
          </a>
        </li>

          </ul>

  </aside><!-- End Sidebar-->