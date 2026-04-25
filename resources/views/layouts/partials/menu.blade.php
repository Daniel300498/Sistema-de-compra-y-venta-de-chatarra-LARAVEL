<aside id="sidebar" class="sidebar" >
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute('home') }}" href="{{ route('home') }}">
          <i class="bi bi-house"></i>
          <span>Dashboard</span>
        </a>
        @can('proveedores.index')
      </li> 
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute(['proveedores.index','proveedores.create','proveedores.edit','proveedores.ficha','proveedores.consulta']) }}" href="{{ route('proveedores.index') }}">
            <i class="bi bi-box-seam"></i><span>Proveedores</span>
          </a>
        </li>      
        @endcan
        @can('camiones.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute(['camiones.index']) }}" href="{{ route('camiones.index') }}">
            <i class="bi bi-truck"></i>
            <span>Transporte</span>
          </a>
        </li>
        @endcan
        @can('clientes.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute(['clientes.index','clientes.create','clientes.edit','clientes.ficha','clientes.consulta']) }}" href="{{ route('clientes.index') }}">
            <i class="bi bi-people"></i>
            <span>Clientes</span>
          </a>
        </li>
        @endcan
        @can('contratos.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute(['contratos.index']) }}" href="{{ route('contratos.index') }}">
            <i class="bi bi-file-earmark-text"></i>
            <span>Contratos</span>
          </a>
        </li>
        @endcan        

        @can('permisos.index')
        <li class="nav-item">
            <a class="nav-link {{ isActiveRoute('permisos.*') }}" href="{{ route('permisos.index') }}">
              <i class="bi bi-shield-lock"></i>
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
    @can('usuarios.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('users.*') }}" href="{{ route('users.index') }}">
            <i class="bi bi-people"></i>
            <span>Usuarios</span>
          </a>
        </li>
@endcan
          </ul>

  </aside><!-- End Sidebar-->