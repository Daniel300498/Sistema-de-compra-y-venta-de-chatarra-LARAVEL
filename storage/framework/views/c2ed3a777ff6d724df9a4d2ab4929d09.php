<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" >

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('home')); ?>" href="<?php echo e(route('home')); ?>">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <?php if(auth()->user()->hasAnyPermission('empleados.index','cargo_empleados.index','documentos.index','declaraciones.index','discapacidades.index')): ?>
        <li class="nav-heading">MÓDULO ADMINISTRACIÓN PERSONAL</li>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['empleados.*'])); ?>" data-bs-target="#empleados-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person-plus"></i><span>Registro Funcionarios</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="empleados-nav" class="nav-content collapse <?php echo e(mostrar(['empleados.*','cargo_empleados.*'])); ?>" data-bs-parent="#sidebar-nav">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.create')): ?>
            <li>
              <a href="<?php echo e(route('empleados.create')); ?>" class="<?php echo e(isActiveSubMenu('empleados.create')); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
            </li>
            <?php endif; ?>
            <li>
              <a href="<?php echo e(route('empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['empleados.index','empleados.edit','empleados.ficha'])); ?>">
                <i class="bi bi-circle"></i><span>Ver Todos</span>
              </a>
            </li>
            <li>
              <a href="<?php echo e(route('cargo_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['cargo_empleados.index','cargo_empleados.edit'])); ?>">
                <i class="bi bi-circle"></i><span>Cargo Empleados</span>
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['documentos*.*'])); ?>" data-bs-target="#documentos-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-file-earmark-text"></i><span>Documentación</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="documentos-nav" class="nav-content collapse <?php echo e(mostrar(['documentos*.*'])); ?>" data-bs-parent="#sidebar-nav">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.create')): ?>
            <li>
              <a href="<?php echo e(route('documentos_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['documentos_empleados.index','documentos.create'])); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
            </li>
            <?php endif; ?>
            <li>
              <a href="<?php echo e(route('documentos.index')); ?>" class="<?php echo e(isActiveSubMenu(['documentos.index','documentos.edit'])); ?>">
                <i class="bi bi-circle"></i><span>Ver Todos</span>
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('declaraciones.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['declaraciones*.*','buscar_empleados'])); ?>"data-bs-target="#declaraciones-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-file-earmark-text"></i><span>Declaraciones Juradas</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="declaraciones-nav" class="nav-content collapse <?php echo e(mostrar(['declaraciones*.*','buscar_empleados',])); ?>" data-bs-parent="#sidebar-nav">
            <?php if(auth()->user()->rol[0]->id==4): ?>
            <li>
              <a href="<?php echo e(route('declaraciones.create',auth()->user()->empleado_id)); ?>" class="<?php echo e(isActiveSubMenu(['declaraciones.index','declaraciones.create','buscar_empleados'])); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
            </li>
            <?php endif; ?>
            <?php if(auth()->user()->rol[0]->id==1): ?>
            <li>
              <a href="<?php echo e(route('declaraciones.index')); ?>" class="<?php echo e(isActiveSubMenu(['declaraciones.index','declaraciones.create','buscar_empleados'])); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
            </li>
            <?php endif; ?>
          <?php if(auth()->user()->rol[0]->id==1): ?>
            <li>
              <a href="<?php echo e(route('declaraciones.pdf')); ?>" class="<?php echo e(isActiveSubMenu(['declaraciones.pdf'])); ?>">
                <i class="bi bi-circle"></i><span>Reporte PDF</span>
              </a>
            </li>
            <?php endif; ?>
            <?php if(auth()->user()->rol[0]->id==1): ?>
            <li>
              <a href="<?php echo e(route('declaraciones.excel')); ?>" class="<?php echo e(isActiveSubMenu(['declaraciones.excel'])); ?>">
                <i class="bi bi-circle"></i><span>Reporte Excel</span>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discapacidades.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['discapacidades*.*'])); ?>" data-bs-target="#discapacidades-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person-check"></i><span>Registro Discapacidades</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="discapacidades-nav" class="nav-content collapse <?php echo e(mostrar(['discapacidades*.*'])); ?>" data-bs-parent="#sidebar-nav">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discapacidades.create')): ?>
            <li>
              <a href="<?php echo e(route('discapacidades_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['discapacidades_empleados.index','discapacidades.create'])); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
            </li>
            <?php endif; ?>
            <li>
              <a href="<?php echo e(route('discapacidades.index')); ?>" class="<?php echo e(isActiveSubMenu(['discapacidades.index','discapacidades.edit'])); ?>">
                <i class="bi bi-circle"></i><span>Ver Registrados</span>
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.index')): ?>
      <li class="nav-heading">MÓDULO ASIGNACIONES FAMILIARES</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['lactancias*.*'])); ?>" data-bs-target="#lactancias-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-suit-heart"></i><span>Registro lactancia</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="lactancias-nav" class="nav-content collapse <?php echo e(mostrar(['lactancias*.*'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.create')): ?>
          <li>
            <a href="<?php echo e(route('lactancias_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['lactancias_empleados.index','lactancias.create'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
            <a href="<?php echo e(route('lactancias.index')); ?>" class="<?php echo e(isActiveSubMenu(['lactancias.index','lactancias.edit'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Registrados</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('kardex.index')): ?>
      <li class="nav-heading">MÓDULO DE KARDEX</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['kardex*.*','años_servicio*.*'])); ?>" data-bs-target="#kardex-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Kardex</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kardex-nav" class="nav-content collapse <?php echo e(mostrar(['kardex*.*','años_servicio*.*'])); ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(route('kardex.index')); ?>" class="<?php echo e(isActiveSubMenu(['kardex.index','kardex.show'])); ?>">
              <i class="bi bi-circle"></i><span>Archivo Digital</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(route('años_servicio.index')); ?>" class="<?php echo e(isActiveSubMenu(['años_servicio*.*'])); ?>">
              <i class="bi bi-circle"></i><span>Años de Servicio</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vacaciones.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['vacaciones*.*','buscar_vacaciones'])); ?>" data-bs-target="#vacaciones-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-date"></i><span>Vacaciones</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="vacaciones-nav" class="nav-content collapse <?php echo e(mostrar(['vacaciones*.*','buscar_vacaciones',])); ?>" data-bs-parent="#sidebar-nav">
          <?php if(auth()->user()->rol[0]->id==4): ?>
          <li>
            <a href="<?php echo e(route('vacaciones.create',auth()->user()->empleado_id)); ?>" class="<?php echo e(isActiveSubMenu(['vacaciones.create'])); ?>">
              <i class="bi bi-circle"></i><span>Solicitar Vacacion</span>
            </a>
          </li>
          <?php endif; ?>
          <?php if(auth()->user()->rol[0]->id==1): ?>
          <li>
            <a href="<?php echo e(route('vacaciones.index')); ?>" class="<?php echo e(isActiveSubMenu(['vacaciones.index','buscar_vacaciones','vacaciones.createkardex'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Dias Disponibles</span>
            </a>
          </li>
          <?php endif; ?>
          <?php if(auth()->user()->rol[0]->id==1): ?>
          <li>
            <a href="<?php echo e(route('vacaciones.calendario')); ?>" class="<?php echo e(isActiveSubMenu(['vacaciones.calendario'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Calendario</span>
            </a>
          </li>
          <?php endif; ?>
          <?php if(auth()->user()->rol[0]->id==1): ?>
          <li>
            <a href="<?php echo e(route('vacaciones.vacaciones_pendientes')); ?>" class="<?php echo e(isActiveSubMenu(['vacaciones.vacaciones_pendientes'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Vacaciones Pendientes</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
            
            <a href="<?php echo e(route('vacaciones.vacaciones_solicitadas')); ?>" class="<?php echo e(isActiveSubMenu(['vacaciones.vacaciones_solicitadas'])); ?>">
              <i class="bi bi-circle"></i><span>Historial Vacaciones Solicitadas</span>
            </a>
          </li>
         
        </ul>
      </li>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('enfermedad.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['enfermedad*.*','buscar_empleado'])); ?>" data-bs-target="#enfermedad-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bag-plus"></i><span>Registro Enfermedad Terminal</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="enfermedad-nav" class="nav-content collapse <?php echo e(mostrar(['enfermedad*.*','buscar_empleado'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('enfermedad.create')): ?>
          <li>
            <a href="<?php echo e(route('enfermedades.index')); ?>" class="<?php echo e(isActiveSubMenu(['enfermedades.index','enfermedades.create','buscar_empleado','enfermedades.store'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
            <a href="<?php echo e(route('enfermedades_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['enfermedades_empleados.index'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Registrados</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('complementarios.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('complementarios*.*')); ?>" href="<?php echo e(route('complementarios_empleados.index')); ?>">
          <i class="bi bi-grid"></i>
          <span>Documentos Complementarios</span>
        </a>
      </li>
      <?php endif; ?>
      <li class="nav-heading">CONTROL DE PERSONAL</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['licencia*.*','buscar_empleado_licencia'])); ?>" data-bs-target="#licencia-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bookmark-x"></i><span>Licencias</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="licencia-nav" class="nav-content collapse <?php echo e(mostrar(['licencia*.*','buscar_empleado_licencia'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if(auth()->user()->empleado_id!=null): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.index')): ?>
              <li>
                <a href="<?php echo e(route('licencias_empleado.index')); ?>" class="<?php echo e(isActiveSubMenu(['licencia_empleado.index'])); ?>">
                  <i class="bi bi-circle"></i><span>Nuevo</span>
                </a>
              </li>
            <?php endif; ?>
          <?php endif; ?>
          <?php if(auth()->user()->rol[0]->id==1): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.create')): ?>           
              <li>
                <a href="<?php echo e(route('licencias_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['licencias_empleados.index','licencias.create'])); ?>">
                  <i class="bi bi-circle"></i><span>Nueva Licencia</span>
                </a>
              </li>
            <?php endif; ?>
          
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.show')): ?>  
              <li>
                <a href="<?php echo e(route('licencias.calendario')); ?>" class="<?php echo e(isActiveSubMenu(['licencias.calendario'])); ?>">
                  <i class="bi bi-circle"></i><span>Ver Calendario</span>
                </a>
              </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.index')): ?>
              <li>
                <a href="<?php echo e(route('licencias.index')); ?>" class="<?php echo e(isActiveSubMenu(['licencias.index'])); ?>">
                  <i class="bi bi-circle"></i><span>Ver Registrados</span>
                </a>
              </li>
            <?php endif; ?>
          <?php endif; ?>

        </ul>
      </li>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('memorandums.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['memorandums*.*','buscar_empleado_memorandum'])); ?>"data-bs-target="#memorandums-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-text"></i><span>Memorandums</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="memorandums-nav" class="nav-content collapse <?php echo e(mostrar(['memorandums*.*','buscar_empleados',])); ?>" data-bs-parent="#sidebar-nav">
          <?php if(auth()->user()->rol[0]->id==4): ?>
          <li>
            <a href="<?php echo e(route('declaraciones.create',auth()->user()->empleado_id)); ?>" class="<?php echo e(isActiveSubMenu(['declaraciones.index','declaraciones.create','buscar_empleados'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <?php if(auth()->user()->rol[0]->id==1): ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('memorandums.create')): ?>
          <li>
            <a href="<?php echo e(route('memorandums.index')); ?>" class="<?php echo e(isActiveSubMenu(['memorandums.index','memorandums.create','buscar_empleado_memorandum'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <?php endif; ?>
        </ul>
      </li>
      <?php endif; ?>
      
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('comisiones.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['comisiones*.*','buscar_empleado_comisiones'])); ?>"data-bs-target="#comisiones-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-text"></i><span>Comisiones</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="comisiones-nav" class="nav-content collapse <?php echo e(mostrar(['comisiones*.*','buscar_empleados',])); ?>" data-bs-parent="#sidebar-nav">
          <?php if(auth()->user()->rol[0]->id==4): ?>
          <li>
            <a href="<?php echo e(route('comisiones.create',auth()->user()->empleado_id)); ?>" class="<?php echo e(isActiveSubMenu(['declaraciones.index','declaraciones.create','buscar_empleados'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <?php if(auth()->user()->rol[0]->id==1): ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('comisiones.create')): ?>
          <li>
            <a href="<?php echo e(route('comisiones.index')); ?>" class="<?php echo e(isActiveSubMenu(['comisiones.index','comisiones.create','buscar_empleado_comisiones'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <?php endif; ?>
        </ul>
      </li>
      <?php endif; ?>
      
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('planillas.create')): ?>
      <li class="nav-heading">MÓDULO PLANILLAS</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('planillas.index')); ?>" href="<?php echo e(route('planillas.index')); ?>">
          <i class="bi bi-calendar"></i>
          <span>Generar Planilla</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('asistencias.index')); ?>" href="<?php echo e(route('asistencias.index')); ?>">
          <i class="bi bi-calendar"></i>
          <span>Ver Asistencia</span>
        </a>
      </li>
      <?php endif; ?>

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('feriados.index')): ?>
      <li class="nav-heading">MÓDULO FERIADOS</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('feriados*.*')); ?>" href="<?php echo e(route('feriados.index')); ?>">
          <i class="bi bi-calendar"></i>
          <span>Feriados</span>
        </a>
      </li>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargos.index')): ?>
      <li class="nav-heading">MÓDULO DE JERARQUIAS, AREAS, CARGOS</li>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('jerarquias.create')): ?>
              <li class="nav-item">
                <a class="nav-link <?php echo e(isActiveRoute(['jerarquia*.*','areas.*'])); ?>" data-bs-target="#jerarquia-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-person-plus"></i><span>Jerarquía y Áreas</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="jerarquia-nav" class="nav-content collapse <?php echo e(mostrar(['jerarquia*.*','areas.*'])); ?>" data-bs-parent="#sidebar-nav">
                  <li>
                    <a href="<?php echo e(route('jerarquias.create')); ?>" class="<?php echo e(isActiveSubMenu('jerarquias.create')); ?>">
                      <i class="bi bi-circle"></i><span>Nuevo</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo e(route('jerarquias.index')); ?>" class="<?php echo e(isActiveSubMenu(['jerarquias.index','areas.create'])); ?>">
                      <i class="bi bi-circle"></i><span>Ver Todos</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo e(route('areas.index')); ?>" class="<?php echo e(isActiveSubMenu(['areas.index'])); ?>">
                      <i class="bi bi-circle"></i><span>Listar Áreas</span>
                    </a>
                  </li>
                
                </ul>
              </li>
            <?php endif; ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargos.index')): ?>
          <li class="nav-item">
            <a class="nav-link <?php echo e(isActiveRoute(['cargos*.*', 'cargoDenominacion.*', 'incrementoSalarial.*'])); ?>" data-bs-target="#cargos-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-award"></i><span>Cargos</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="cargos-nav" class="nav-content collapse <?php echo e(mostrar(['cargos*.*', 'cargoDenominacion.*', 'incrementoSalarial.*'])); ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?php echo e(route('cargos.index')); ?>" class="<?php echo e(isActiveSubMenu('cargos.index')); ?>">
                        <i class="bi bi-circle"></i><span>Ver Cargos</span>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargoDenominacion.index')): ?>
                <li>
                    <a href="<?php echo e(route('cargoDenominacion.index')); ?>" class="<?php echo e(isActiveSubMenu('cargoDenominacion.index')); ?>">
                        <i class="bi bi-circle"></i><span>Denominación del Cargo</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('incrementoSalarial.create')); ?>" class="<?php echo e(isActiveSubMenu('incrementoSalarial.create')); ?>">
                        <i class="bi bi-circle"></i><span>Calcular Aumento salarial</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('parametros.index')): ?>
      <li class="nav-heading">PARAMETROS</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['refrigerios*.*','academico.*'])); ?>" data-bs-target="#kardex-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Parámetros</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kardex-nav" class="nav-content collapse <?php echo e(mostrar(['refrigerios.*','academico.*'])); ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(route('refrigerios.index')); ?>" class="<?php echo e(isActiveSubMenu('refrigerios.*')); ?>">
              <i class="bi bi-circle"></i><span>Refrigerios</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(route('academico.index')); ?>" class="<?php echo e(isActiveSubMenu('academico.*')); ?>">
              <i class="bi bi-circle"></i><span>Académico</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.index')): ?>
        <li class="nav-heading">MODULO DE SEGURIDAD DE ACCESOS</li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('users.*')); ?>" href="<?php echo e(route('users.index')); ?>">
            <i class="bi bi-people"></i>
            <span>Usuarios</span>
          </a>
        </li>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('roles.*')); ?>" href="<?php echo e(route('roles.index')); ?>">
            <i class="bi bi-gear"></i>
            <span>Roles</span>
          </a>
        </li>
        <?php endif; ?>
      <?php endif; ?>
    </ul>

  </aside><!-- End Sidebar--><?php /**PATH C:\laragon\www\gobernacion\sistema_rrhh\resources\views/layouts/partials/menu.blade.php ENDPATH**/ ?>