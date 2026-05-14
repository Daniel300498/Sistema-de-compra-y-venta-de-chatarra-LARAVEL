<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      {{-- Dashboard --}}
      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute('home') }}" href="{{ route('home') }}">
          <i class="bi bi-house"></i>
          <span>Dashboard</span>
        </a>
      </li>

      {{-- Contratos --}}
      @can('contratos.index')
      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute(['contratos.index','contratos.camiones']) }}" href="{{ route('contratos.index') }}">
          <i class="bi bi-file-earmark-text"></i>
          <span>Contratos</span>
        </a>
      </li>
      @endcan

      {{-- PROVEEDORES --}}
      @php $enProveedores = request()->routeIs(['proveedores.index','proveedores.create','proveedores.edit','proveedores.ficha','proveedores.consulta','pagos.proveedores.index']); @endphp
      @if(auth()->user()->can('proveedores.index') || auth()->user()->can('pagos_proveedores.index'))
      <li class="nav-item">
        <a class="nav-link {{ $enProveedores ? '' : 'collapsed' }}"
           data-sidebar-target="menu-proveedores" href="#">
          <i class="bi bi-box-seam"></i>
          <span>Proveedores</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="menu-proveedores"
            class="nav-content sidebar-submenu {{ $enProveedores ? 'submenu-open' : '' }}">
          @can('proveedores.index')
          <li>
            <a href="{{ route('proveedores.index') }}"
               class="{{ isActiveRoute(['proveedores.index','proveedores.create','proveedores.edit','proveedores.ficha','proveedores.consulta']) ? 'active' : '' }}">
              <i class="bi bi-person-lines-fill"></i><span>Lista de Proveedores</span>
            </a>
          </li>
          @endcan
          @can('pagos_proveedores.index')
          <li>
            <a href="{{ route('pagos.proveedores.index') }}"
               class="{{ isActiveRoute(['pagos.proveedores.index']) ? 'active' : '' }}">
              <i class="bi bi-cash-stack"></i><span>Pagos a Proveedores</span>
            </a>
          </li>
          @endcan
        </ul>
      </li>
      @endif

      {{-- TRANSPORTE --}}
      @php $enTransporte = request()->routeIs(['camiones.index','seguimiento.index','pagos.camiones.index']); @endphp
      @if(auth()->user()->can('camiones.index') || auth()->user()->can('seguimiento.index') || auth()->user()->can('pagos_camiones.index'))
      <li class="nav-item">
        <a class="nav-link {{ $enTransporte ? '' : 'collapsed' }}"
           data-sidebar-target="menu-transporte" href="#">
          <i class="bi bi-truck"></i>
          <span>Transporte</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="menu-transporte"
            class="nav-content sidebar-submenu {{ $enTransporte ? 'submenu-open' : '' }}">
          @can('camiones.index')
          <li>
            <a href="{{ route('camiones.index') }}"
               class="{{ isActiveRoute(['camiones.index']) ? 'active' : '' }}">
              <i class="bi bi-truck-front"></i><span>Camiones</span>
            </a>
          </li>
          @endcan
          @can('seguimiento.index')
          <li>
            <a href="{{ route('seguimiento.index') }}"
               class="{{ isActiveRoute(['seguimiento.index']) ? 'active' : '' }}">
              <i class="bi bi-geo-alt"></i><span>Seguimiento de Cargas</span>
            </a>
          </li>
          @endcan
          @can('pagos_camiones.index')
          <li>
            <a href="{{ route('pagos.camiones.index') }}"
               class="{{ isActiveRoute(['pagos.camiones.index']) ? 'active' : '' }}">
              <i class="bi bi-cash-coin"></i><span>Historial Pagos Camiones</span>
            </a>
          </li>
          @endcan
        </ul>
      </li>
      @endif

      {{-- CLIENTES --}}
      @php $enClientes = request()->routeIs(['clientes.index','clientes.create','clientes.edit','clientes.ficha','clientes.consulta','pagos.clientes.index']); @endphp
      @if(auth()->user()->can('clientes.index') || auth()->user()->can('pagos_clientes.index'))
      <li class="nav-item">
        <a class="nav-link {{ $enClientes ? '' : 'collapsed' }}"
           data-sidebar-target="menu-clientes" href="#">
          <i class="bi bi-people"></i>
          <span>Clientes</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="menu-clientes"
            class="nav-content sidebar-submenu {{ $enClientes ? 'submenu-open' : '' }}">
          @can('clientes.index')
          <li>
            <a href="{{ route('clientes.index') }}"
               class="{{ isActiveRoute(['clientes.index','clientes.create','clientes.edit','clientes.ficha','clientes.consulta']) ? 'active' : '' }}">
              <i class="bi bi-person-lines-fill"></i><span>Lista de Clientes</span>
            </a>
          </li>
          @endcan
          @can('pagos_clientes.index')
          <li>
            <a href="{{ route('pagos.clientes.index') }}"
               class="{{ isActiveRoute(['pagos.clientes.index']) ? 'active' : '' }}">
              <i class="bi bi-receipt"></i><span>Cobros a Clientes</span>
            </a>
          </li>
          @endcan
        </ul>
      </li>
      @endif

      {{-- Bancos y Cuentas --}}
      @can('bancos.index')
      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute(['bancos.index']) }}" href="{{ route('bancos.index') }}">
          <i class="bi bi-bank"></i>
          <span>Bancos y Cuentas</span>
        </a>
      </li>
      @endcan

      {{-- Empleados --}}
      @can('empleados.index')
      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute(['empleados.index']) }}" href="{{ route('empleados.index') }}">
          <i class="bi bi-person-badge"></i>
          <span>Empleados</span>
        </a>
      </li>
      @endcan

      @can('gastos_extras.index')
      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute(['gastos_extras.index']) }}" href="{{ route('gastos_extras.index') }}">
          <i class="bi bi-cash-stack"></i>
          <span>Gastos Extra</span>
        </a>
      </li>
      @endcan

      @can('reportes.index')
      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute('reportes.index') }}" href="{{ route('reportes.index') }}">
          <i class="bi bi-graph-up"></i>
          <span>Reportes</span>
        </a>
      </li>
      @endcan

      {{-- ADMINISTRACIÓN --}}
      @if(auth()->user()->can('permisos.index') || auth()->user()->can('roles.index') || auth()->user()->can('users.index'))
      @php $enAdmin = request()->routeIs(['permisos.*','roles.*','users.*']); @endphp
      <li class="nav-item">
        <a class="nav-link {{ $enAdmin ? '' : 'collapsed' }}"
           data-sidebar-target="menu-admin" href="#">
          <i class="bi bi-gear"></i>
          <span>Administración</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="menu-admin"
            class="nav-content sidebar-submenu {{ $enAdmin ? 'submenu-open' : '' }}">
          @can('permisos.index')
          <li>
            <a href="{{ route('permisos.index') }}"
               class="{{ isActiveRoute('permisos.*') ? 'active' : '' }}">
              <i class="bi bi-shield-lock"></i><span>Permisos</span>
            </a>
          </li>
          @endcan
          @can('roles.index')
          <li>
            <a href="{{ route('roles.index') }}"
               class="{{ isActiveRoute('roles.*') ? 'active' : '' }}">
              <i class="bi bi-sliders"></i><span>Roles</span>
            </a>
          </li>
          @endcan
          @can('users.index')
          <li>
            <a href="{{ route('users.index') }}"
               class="{{ isActiveRoute('users.*') ? 'active' : '' }}">
              <i class="bi bi-person-gear"></i><span>Usuarios</span>
            </a>
          </li>
          @endcan
        </ul>
      </li>
      @endif

    </ul>
</aside><!-- End Sidebar-->
