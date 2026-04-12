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
          <a class="nav-link <?php echo e(isActiveRoute(['empleados.index','empleados.create','empleados.edit','empleados.ficha','empleados.consulta'])); ?>" data-bs-target="#empleados-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person-plus"></i><span>Registro Funcionarios</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="empleados-nav" class="nav-content collapse <?php echo e(mostrar(['empleados.index','empleados.create','empleados.edit','empleados. ficha','cargo_empleados.*','empleados.consulta'])); ?>" data-bs-parent="#sidebar-nav">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.create')): ?>
            <li>
              <a href="<?php echo e(route('empleados.create')); ?>" class="<?php echo e(isActiveSubMenu('empleados.create')); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
            </li>
       
            <?php endif; ?>
            <li>
              <a href="<?php echo e(route('empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['empleados.index','empleados.edit','empleados.ficha','empleados.consulta'])); ?>">
                <i class="bi bi-circle"></i><span>Ver Todos</span>
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.reconocidos')): ?> 
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['empleados.reconocidos'])); ?>" href="<?php echo e(route('empleados.reconocidos')); ?>">
            <i class="bi bi-trophy"></i>
            <span>Miembros Reconocidos</span>
          </a>
        </li>
        <?php endif; ?>
        
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.index')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(isActiveRoute(['documentos.index', 'documentos_empleados.index', 'historialcvs.index','buscar_empleado_historial','historialcvs.create'])); ?>" data-bs-target="#documentos-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-folder-plus"></i><span>Documentación</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="documentos-nav" class="nav-content collapse <?php echo e(mostrar(['documentos.index', 'documentos_empleados.index', 'historialcvs.index','buscar_empleado_historial','historialcvs.create'])); ?>" data-bs-parent="#sidebar-nav">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.create')): ?>
                <li>
                    <a href="<?php echo e(route('documentos_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['documentos_empleados.index', 'documentos.create'])); ?>">
                        <i class="bi bi-circle"></i><span>Nuevo</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.index')): ?>
                <li>
                    <a href="<?php echo e(route('documentos.index')); ?>" class="<?php echo e(isActiveSubMenu(['documentos.index', 'documentos.edit'])); ?>">
                        <i class="bi bi-circle"></i><span>Ver Registrados</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.edit')): ?>
                <li>
                    <a href="<?php echo e(route('historialcvs.index')); ?>" class="<?php echo e(isActiveSubMenu(['historialcvs.index', 'buscar_empleado_historial', 'historialcvs.create'])); ?>">
                        <i class="bi bi-circle"></i><span>Historial Curriculum Vitae</span>
                    </a>
                </li> 
                <li>
                    <a href="<?php echo e(route('documentos.consulta_index')); ?>" class="<?php echo e(isActiveSubMenu(['documentos.consulta_index','documentos.consulta'])); ?>">
                        <i class="bi bi-circle"></i><span>Reportes</span>
                    </a>
                </li>
                <?php endif; ?>
                
            </ul>
        </li>
        <?php endif; ?>
        
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contratos.index')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(isActiveRoute(['contratos.index','contratos.create','contratos.consulta'])); ?>" data-bs-target="#contratos-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-check"></i><span>Contratos</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="contratos-nav" class="nav-content collapse <?php echo e(mostrar(['contratos.index','contratos.create','contratos.consulta'])); ?>" data-bs-parent="#sidebar-nav">
                <li>
                  <a href="<?php echo e(route('contratos.index','contratos.create','contratos,consulta')); ?>" class="<?php echo e(isActiveSubMenu(['contratos.index','contratos.create','contratos.consulta'])); ?>">
                      <i class="bi bi-circle"></i><span>Historial Contratos</span>
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
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('declaraciones.create')): ?>
              <li>
                <a href="<?php echo e(route('declaraciones.create',auth()->user()->empleado_id)); ?>" class="<?php echo e(isActiveSubMenu(['declaraciones.index','declaraciones.create','buscar_empleados'])); ?>">
                  <i class="bi bi-circle"></i><span>Nuevo</span>
                </a>
              </li>
              <?php endif; ?>
            <?php endif; ?>
            <?php if(auth()->user()->rol[0]->id!=4): ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('declaraciones.create')): ?>
                <li>
                  <a href="<?php echo e(route('declaraciones.index')); ?>" class="<?php echo e(isActiveSubMenu(['declaraciones.index','declaraciones.create','buscar_empleados'])); ?>">
                    <i class="bi bi-circle"></i><span>Nuevo</span>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('declaraciones.index')): ?>
                <li>
                  <a href="<?php echo e(route('declaraciones.pdf')); ?>" class="<?php echo e(isActiveSubMenu(['declaraciones.pdf'])); ?>">
                    <i class="bi bi-circle"></i><span>Reporte Contraloria</span>
                  </a>
                </li>
              <?php endif; ?>
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
         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cargoEmpleados.index')): ?>
              <li class="nav-item">
                <a class="nav-link <?php echo e(isActiveRoute(['cargoEmpleados*.*'])); ?>" data-bs-target="#cargoEmpleados-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi-briefcase"></i><span>Cargo de Empleados</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="cargoEmpleados-nav" class="nav-content collapse <?php echo e(mostrar(['cargoEmpleados.buscar_cargo_empleado','cargoEmpleados.acefalo_index','cargoEmpleados.asignar','cargoEmpleados.interino'])); ?>" data-bs-parent="#sidebar-nav">
                  <li>
                    <a href="<?php echo e(route('cargoEmpleados.buscar_cargo_empleado')); ?>" class="<?php echo e(isActiveSubMenu(['cargoEmpleados.buscar_cargo_empleado','cargoEmpleados.interino'])); ?>">
                      <i class="bi bi-circle"></i><span>Cargos de Empleados Activos</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo e(route('cargoEmpleados.acefalo_index')); ?>" class="<?php echo e(isActiveSubMenu(['cargoEmpleados.acefalo_index','cargoEmpleados.asignar'])); ?>">
                      <i class="bi bi-circle"></i><span>Cargos Acéfalos</span>
                    </a>
                  </li>
                </ul>
        <?php endif; ?>
      <?php endif; ?>
     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.index')): ?>
      <li class="nav-heading">MÓDULO ASIGNACIONES FAMILIARES</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['lactancias*.*','lactancias_empleados*','consulta.lactancia*','lactancia_empleado*'])); ?>" data-bs-target="#lactancias-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-suit-heart"></i><span>Registro lactancia</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="lactancias-nav" class="nav-content collapse <?php echo e(mostrar(['lactancias*.*','lactancias_empleados*','consulta.lactancia*','lactancia_empleado*'])); ?>" data-bs-parent="#sidebar-nav">
          
        <?php if(auth()->user()->rol[0]->id==4): ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.index')): ?>
          <li>
            <a href="<?php echo e(route('lactancia_empleado.index')); ?>" class="<?php echo e(isActiveSubMenu(['lactancia_empleado.index'])); ?>">
              <i class="bi bi-circle"></i><span>Historial Lactancias</span>
            </a>
          </li>
          <?php endif; ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.index')): ?>
          <li>
            <a href="<?php echo e(route('lactancia_empleado_firmas.index')); ?>" class="<?php echo e(isActiveSubMenu(['lactancia_empleado_firmas.index'])); ?>">
              <i class="bi bi-circle"></i><span>Historial Firmas Prenatal</span>
            </a>
          </li>
          <?php endif; ?>
        <?php endif; ?>
        <?php if(auth()->user()->rol[0]->id!=4): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.create')): ?>
            <li>
              <a href="<?php echo e(route('lactancias_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['lactancias_empleados.index','lactancias.create*','consulta.lactancia'])); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.index')): ?>
            <li>
              <a href="<?php echo e(route('lactancias.index')); ?>" class="<?php echo e(isActiveSubMenu(['lactancias.index','lactancias.edit'])); ?>">
                <i class="bi bi-circle"></i><span>Ver Registrados</span>
              </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.index')): ?>
            <li>
              <a href="<?php echo e(route('lactancias.indexFirmas')); ?>" class="<?php echo e(isActiveSubMenu(['lactancias.indexFirmas'])); ?>">
                <i class="bi bi-circle"></i><span>Ver Firmas Prenatal</span>
              </a>
            </li>
            <?php endif; ?>
            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.edit')): ?>
            <li>
              <a href="<?php echo e(route('lactancias.bono')); ?>" class="<?php echo e(isActiveSubMenu(['lactancias.bono'])); ?>">
                <i class="bi bi-circle"></i><span>Bono Lactancia</span>
              </a>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.show')): ?>
            <li>
              <a href="<?php echo e(route('lactancias.reporte')); ?>" class="<?php echo e(isActiveSubMenu(['lactancias.reporte'])); ?>">
                <i class="bi bi-circle"></i><span>Reporte</span>
              </a>
            </li>
            <?php endif; ?>
          
        <?php endif; ?>
        </ul>
      </li>
      <?php endif; ?>
      
      <?php if(auth()->user()->hasAnyPermission('archivo_digital.index','servicio_años.index')): ?>
      <li class="nav-heading">MÓDULO DE KARDEX</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['archivo_digital*.*','años_servicio*.*','buscar_empleado_kardex','reportes.kardex','reportes.generate'])); ?>" data-bs-target="#kardex-nav" data-bs-toggle="collapse" href="#">
          <i class="bi-file-earmark-person"></i><span>Kardex</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kardex-nav" class="nav-content collapse <?php echo e(mostrar(['archivo_digital*.*','años_servicio*.*','buscar_empleado_kardex','reportes.kardex','reportes.generate'])); ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(route('archivo_digital.index')); ?>" class="<?php echo e(isActiveSubMenu(['archivo_digital.index','archivo_digital.show','buscar_empleado_kardex'])); ?>">
              <i class="bi bi-circle"></i><span>Archivo Digital</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(route('años_servicio.index')); ?>" class="<?php echo e(isActiveSubMenu(['años_servicio*.*'])); ?>">
              <i class="bi bi-circle"></i><span>Años de Servicio</span>
            </a>
          </li>
           <li>
            <a href="<?php echo e(route('reportes.kardex')); ?>" class="<?php echo e(isActiveSubMenu(['reportes.kardex','reportes.generate'])); ?>">
              <i class="bi bi-circle"></i><span>Reportes</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      
      
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vacaciones.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['vacaciones*.*','buscar_vacaciones','vacaciones_buscar_empleado'])); ?>" data-bs-target="#vacaciones-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-date"></i><span>Vacaciones</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="vacaciones-nav" class="nav-content collapse <?php echo e(mostrar(['vacaciones*.*','buscar_vacaciones','vacaciones_buscar_empleado'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if(auth()->user()->rol[0]->id==4): ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vacaciones.create')): ?>
          <li>
            <a href="<?php echo e(route('vacaciones.create',auth()->user()->empleado_id)); ?>" class="<?php echo e(isActiveSubMenu(['vacaciones.create','vacaciones_buscar_empleado'])); ?>">
              <i class="bi bi-circle"></i><span>Solicitar Vacacion</span>
            </a>
          </li>
          <?php endif; ?>
          <?php endif; ?>
          
          <?php if(auth()->user()->rol[0]->id!=4): ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vacaciones.create')): ?>
          <li>
            <a href="<?php echo e(route('vacaciones.index')); ?>" class="<?php echo e(isActiveSubMenu(['vacaciones.index','buscar_vacaciones','vacaciones.createkardex','vacaciones_buscar_empleado','vacaciones.create'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Dias Disponibles</span>
            </a>
          </li>
          <?php endif; ?>
          <?php endif; ?>
           
          <?php if(auth()->user()->rol[0]->id!=4): ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vacaciones.index')): ?>
          <li>
            <a href="<?php echo e(route('vacaciones.calendario')); ?>" class="<?php echo e(isActiveSubMenu(['vacaciones.calendario'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Calendario</span>
            </a>
          </li>
          <?php endif; ?>
          <?php endif; ?>
          <?php if(auth()->user()->rol[0]->id!=4): ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vacaciones.index')): ?>
          <li>
            <a href="<?php echo e(route('vacaciones.vacaciones_pendientes')); ?>" class="<?php echo e(isActiveSubMenu(['vacaciones.vacaciones_pendientes'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Vacaciones Pendientes</span>
            </a>
          </li>
          <?php endif; ?>
          <?php endif; ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vacaciones.index')): ?>
          <li>
            <a href="<?php echo e(route('vacaciones.vacaciones_solicitadas')); ?>" class="<?php echo e(isActiveSubMenu(['vacaciones.vacaciones_solicitadas'])); ?>">
              <i class="bi bi-circle"></i><span>Historial Vacaciones Solicitadas</span>
            </a>
          </li>
          <?php endif; ?>
        </ul>
      </li>
      <?php endif; ?>
      
     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('enfermedades.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['enfermedad*.*','buscar_empleado_enfermedad'])); ?>" data-bs-target="#enfermedad-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bag-plus"></i><span>Registro Enfermedad Terminal</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="enfermedad-nav" class="nav-content collapse <?php echo e(mostrar(['enfermedad*.*','buscar_empleado_enfermedad'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('enfermedades.create')): ?>
          <li>
            <a href="<?php echo e(route('enfermedades.index')); ?>" class="<?php echo e(isActiveSubMenu(['enfermedades.index','enfermedades.create','buscar_empleado_enfermedad','enfermedades.store'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
           <a href="<?php echo e(route('enfermedades_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['enfermedades_empleados.index','enfermedades.edit'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Registrados</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('complementarios.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('complementarios*.*')); ?>" href="<?php echo e(route('complementarios_empleados.index')); ?>">
          <i class="bi bi-stickies"></i>
          <span>Documentos Complementarios</span>
        </a>
      </li>
      <?php endif; ?>

      <?php if(auth()->user()->hasAnyPermission('licencias.show','orden_salida.show','memorandums.show','comisiones.show')): ?>
      <li class="nav-heading">CONTROL DE PERSONAL</li>
      <?php endif; ?>
      
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.index')): ?>
      <li class="nav-item">
      <a class="nav-link <?php echo e(isActiveRoute(['licencia*.*','buscar_empleado_licencia','buscar_empleado_estado','buscar_empleado_fecha','consulta.licencia','consulta_licencias.index'])); ?>" data-bs-target="#licencia-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-plus"></i><span>Licencias</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="licencia-nav" class="nav-content collapse <?php echo e(mostrar(['licencia*.*','buscar_empleado_licencia','buscar_empleado_estado','buscar_empleado_fecha','consulta.licencia','consulta_licencias.index'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if(auth()->user()->rol[0]->id==4): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.create')): ?>
            <li>
              <a href="<?php echo e(route('licencias.create',auth()->user()->empleado->uuid)); ?>" class="<?php echo e(isActiveSubMenu(['licencia_empleado.index','licencias.create'])); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
          
            </li>
            <?php endif; ?>

              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.index')): ?>
                <li>
                  <a href="<?php echo e(route('licencias_empleado.index')); ?>" class="<?php echo e(isActiveSubMenu(['licencias_empleado.index'])); ?>">
                    <i class="bi bi-circle"></i><span>Historial</span>
                  </a>
                </li>
              <?php endif; ?>
          <?php endif; ?>

          <?php if(auth()->user()->rol[0]->id!=4): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.create')): ?>           
              <li>
                <a href="<?php echo e(route('consulta_licencias.index')); ?>" class="<?php echo e(isActiveSubMenu(['consulta_licencias.index','licencias.create','consulta.licencia'])); ?>">
                 <i class="bi bi-card-checklist"></i><span>Nueva Licencia</span>
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
                <a href="<?php echo e(route('licencias.index')); ?>" class="<?php echo e(isActiveSubMenu(['licencias.index','buscar_empleado_licencia','buscar_empleado_estado','buscar_empleado_fecha','licencias.ficha','licencias.edit'])); ?>">
                  <i class="bi bi-circle"></i><span>Ver Registrados</span>
                </a>
              </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.index')): ?>
              <li>
                <a href="<?php echo e(route('licencias.reporte')); ?>" class="<?php echo e(isActiveSubMenu(['licencias.reporte','licencias.reporte_ver'])); ?>">
                  <i class="bi bi-circle"></i><span>Reporte</span>
                </a>
              </li>
            <?php endif; ?>

          <?php endif; ?>

        </ul>
      </li>
      <?php endif; ?>
      
      
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orden_salida.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['orden_salida*.*','buscar_empleado_orden_salida','consulta_orden_salida*.*','consulta.orden_salida'])); ?>" data-bs-target="#orden_salida-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-plus"></i><span>Orden de Salida</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="orden_salida-nav" class="nav-content collapse <?php echo e(mostrar(['orden_salida*.*','buscar_empleado_orden_salida','consulta_orden_salida*.*','consulta.orden_salida'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if(auth()->user()->rol[0]->id==4): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orden_salida.create')): ?>
            <li>
              <a href="<?php echo e(route('orden_salida.create',auth()->user()->empleado->uuid)); ?>" class="<?php echo e(isActiveSubMenu(['orden_salida.create'])); ?>">
                <i class="bi bi-circle"></i><span>Nuevo</span>
              </a>
            </li>
            <?php endif; ?>

              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orden_salida.index')): ?>
                <li>
                  <a href="<?php echo e(route('orden_salida_empleado.index')); ?>" class="<?php echo e(isActiveSubMenu(['orden_salida_empleado.index'])); ?>">
                    <i class="bi bi-circle"></i><span>Historial</span>
                  </a>
                </li>
              <?php endif; ?>
          <?php endif; ?>


          <?php if(auth()->user()->rol[0]->id!=4): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orden_salida.create')): ?>           
              <li>
                <a href="<?php echo e(route('consulta_orden_salida.index')); ?>" class="<?php echo e(isActiveSubMenu(['consulta_orden_salida.index','orden_salida.create','consulta.orden_salida'])); ?>">
                  <i class="bi bi-circle"></i><span>Nueva Orden</span>
                </a>
              </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orden_salida.index')): ?>
              <li>
                <a href="<?php echo e(route('orden_salida.index')); ?>" class="<?php echo e(isActiveSubMenu(['orden_salida.index'])); ?>">
                  <i class="bi bi-circle"></i><span>Ver Registrados</span>
                </a>
              </li>
            <?php endif; ?>
          <?php endif; ?>

        </ul>
      </li>
     <?php endif; ?>
      
      
      
       
           
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('memorandums.index')): ?>
         <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['memorandums*.*','buscar_empleado_memorandums','mis_memorandums.show','documento_memorandum_create','memorandums.index','documento_memorandum.index','buscar_empleado_documento_memorandum'])); ?>" data-bs-target="#memorandums-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-file-earmark-text"></i><span>Memorandums</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="memorandums-nav" class="nav-content collapse <?php echo e(mostrar(['memorandums*.*','buscar_empleado_memorandums','mis_memorandums.show','documento_memorandum_create','memorandums.index','documento_memorandum.index','buscar_empleado_documento_memorandum','memorandums.edit'])); ?>" data-bs-parent="#sidebar-nav">
            <?php if(auth()->user()->rol[0]->id==4): ?>
              <li>
                <a href="<?php echo e(route('mis_memorandums.show',auth()->user()->empleado_id)); ?>" class="<?php echo e(isActiveSubMenu(['mis_memorandums.show'])); ?>">
                  <i class="bi bi-circle"></i><span>Mis Memorandums</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->rol[0]->id!=4): ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documento_memorandum.create')): ?>
                <li>
                  <a href="<?php echo e(route('memorandums.index')); ?>" class="<?php echo e(isActiveSubMenu(['memorandums.index','memorandums.create','memorandums.edit','buscar_empleado_memorandums'])); ?>">
                    <i class="bi bi-circle"></i><span>Nuevo</span>
                  </a>
                </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documento_memorandum.index')): ?>
                <li>
                  <a href="<?php echo e(route('documento_memorandum.index')); ?>" class="<?php echo e(isActiveSubMenu(['documento_memorandum_create','documento_memorandum.index','buscar_empleado_documento_memorandum'])); ?>">
                    <i class="bi bi-circle"></i><span>Otros Memorandums</span>
                  </a>
                </li>

                
                  <li>
                    <a href="<?php echo e(route('documentomemorandum.reporte')); ?>" class="<?php echo e(isActiveSubMenu(['documento_memorandum.reporte'])); ?>">
                      <i class="bi bi-circle"></i><span>Reporte</span>
                    </a>
                  </li>
                <?php endif; ?>



               
            <?php endif; ?>
          </ul>
        </li> 
        <?php endif; ?>

        
        
        
        
      
      <?php if(auth()->user()->hasAnyPermission('comisiones.index','comisiones.show')): ?>
      <li class="nav-item">
       <a class="nav-link <?php echo e(isActiveRoute(['comisiones.*','mis_comisiones.show','buscar_empleado_comisiones'])); ?>" href="<?php if(auth()->user()->rol[0]->id==4): ?> <?php echo e(route('mis_comisiones.show',auth()->user()->empleado->uuid)); ?> <?php else: ?><?php echo e(route('comisiones.index')); ?><?php endif; ?>">
          <i class="bi-journal-check"></i>
          <span>Comisiones</span>
        </a>
      </li>
      <?php endif; ?>
      
      
      
      
<?php if(auth()->user()->rol[0]->id!=4 && auth()->user()->rol[0]->id!=8): ?>
      <li class="nav-heading">MÓDULO PLANILLAS</li>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('planillas.index')): ?>
       
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute(['sanciones.index','sanciones.consulta'])); ?>" href="<?php echo e(route('sanciones.index')); ?>">
            <i class="bi bi-file-earmark-excel"></i>
            <span>Generar Planilla de Sanciones Disciplinarias</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refrigerios.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('refrigerios.*')); ?>" href="<?php echo e(route('refrigerios.index')); ?>">
            <i class="bi bi-file-earmark-break"></i>
            <span>Generar Planilla de Refrigerios</span>
          </a>
        </li>
        <?php endif; ?>
        
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refrigerios.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('variable.refrigerios')); ?>" href="<?php echo e(route('variable.refrigerios')); ?>">
            <i class="bi bi-file-earmark-break"></i>
            <span>Editar Pago Refrigerios</span>
          </a>
        </li>
        <?php endif; ?>
      
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
      <li class="nav-heading">MÓDULO DE JERARQUIAS, &Aacute;REAS, CARGOS</li>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('jerarquias.create')): ?>
              <li class="nav-item">
                <a class="nav-link <?php echo e(isActiveRoute(['jerarquia*.*','areas.*'])); ?>" data-bs-target="#jerarquia-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi-diagram-3"></i><span>Jerarqu&iacute;a y &Aacute;reas</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="jerarquia-nav" class="nav-content collapse <?php echo e(mostrar(['jerarquia*.*','areas.*'])); ?>" data-bs-parent="#sidebar-nav">
                  <li>
                    <a href="<?php echo e(route('jerarquias.create')); ?>" class="<?php echo e(isActiveSubMenu('jerarquias.create')); ?>">
                      <i class="bi bi-circle"></i><span>Nueva Jerarqu&iacute;a</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo e(route('jerarquias.index')); ?>" class="<?php echo e(isActiveSubMenu(['jerarquias.index'])); ?>">
                      <i class="bi bi-circle"></i><span>Ver Jerarqu&iacute;as</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo e(route('areas.index')); ?>" class="<?php echo e(isActiveSubMenu(['areas.*'])); ?>">
                      <i class="bi bi-circle"></i><span>Ver &Aacute;reas</span>
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

    
    <li class="nav-heading">PUBLICACIONES</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['publicacion.create','publicacion.index','publicacion.show'])); ?>" data-bs-target="#publicaciones-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-newspaper"></i><span>Publicaciones</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="publicaciones-nav" class="nav-content collapse <?php echo e(mostrar(['publicacion.create','publicacion.index','publicacion.show'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publicacion.create')): ?>
          <li>
            <a href="<?php echo e(route('publicacion.create')); ?>" class="<?php echo e(isActiveSubMenu('publicacion.create')); ?>">
              <i class="bi bi-circle"></i><span>Agregar Publicación</span>
            </a>
          </li>
          <?php endif; ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publicacion.index')): ?>
          <li>
            <a href="<?php echo e(route('publicacion.index')); ?>" class="<?php echo e(isActiveSubMenu('publicacion.index')); ?>">
              <i class="bi bi-circle"></i><span>Listar Publicaciones</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
            <a href="<?php echo e(route('publicacion.show')); ?>" class="<?php echo e(isActiveSubMenu('publicacion.show')); ?>">
              <i class="bi bi-circle"></i><span>Ver Publicaciones </span>
            </a>
          </li>
    
        </ul>
      </li>
   
    
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('parametros.index')): ?>
      <li class="nav-heading">PARAMETROS</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['academico.*'])); ?>" data-bs-target="#parametros-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear"></i><span>Parámetros</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="parametros-nav" class="nav-content collapse <?php echo e(mostrar(['academico.*'])); ?>" data-bs-parent="#sidebar-nav">
          <!--<li>
            <a href="" class="">
              <i class="bi bi-circle"></i><span>Refrigerios</span>
            </a>
          </li>-->
          <li>
            <a href="<?php echo e(route('academico.index')); ?>" class="<?php echo e(isActiveSubMenu('academico.*')); ?>">
              <i class="bi bi-circle"></i><span>Académico</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reporte.index')): ?>
       <li class="nav-heading">MODULO DE REPORTES</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('reporte.*')); ?>" href="<?php echo e(route('reporte.general')); ?>">
          <i class="bi bi-printer"></i>
          <span>Reportes</span>
        </a>
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
            <i class="bi bi-sliders"></i>
            <span>Roles</span>
          </a>
        </li>
        <?php endif; ?>
      <?php endif; ?>
    </ul>

  </aside><!-- End Sidebar--><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/layouts/partials/menu.blade.php ENDPATH**/ ?>