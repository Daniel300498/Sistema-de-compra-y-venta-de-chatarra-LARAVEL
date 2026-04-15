<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


    Route::get('/', function () {
        return view('auth.login');
    });
    
    Auth::routes();
    //Route::middleware(['auth'])->group(function(){
    Route::middleware(['auth', 'checkPasswordChange'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
      
    //Roles
    Route::post('roles/store',[App\Http\Controllers\RoleController::class,'store'])->name('roles.store')->middleware('permission:roles.create');
    Route::get('roles',[App\Http\Controllers\RoleController::class,'index'])->name('roles.index')->middleware('permission:roles.index');
    Route::get('roles/create',[App\Http\Controllers\RoleController::class,'create'])->name('roles.create')->middleware('permission:roles.create');
    Route::put('roles/{role}',[App\Http\Controllers\RoleController::class,'update'])->name('roles.update')->middleware('permission:roles.edit');
    Route::get('roles/{uuid}',[App\Http\Controllers\RoleController::class,'show'])->name('roles.show')->middleware('permission:roles.show');
    Route::get('roles/{uuid}/destroy',[App\Http\Controllers\RoleController::class,'destroy'])->name('roles.destroy')->middleware('permission:roles.destroy');
    Route::get('roles/{uuid}/edit',[App\Http\Controllers\RoleController::class,'edit'])->name('roles.edit')->middleware('permission:roles.edit');

    //User
    Route::post('users/store',[App\Http\Controllers\UserController::class,'store'])->name('users.store')->middleware('permission:users.create');
    Route::get('users',[App\Http\Controllers\UserController::class,'index'])->name('users.index')->middleware('permission:users.index');
    Route::get('users/create',[App\Http\Controllers\UserController::class,'create'])->name('users.create')->middleware('permission:users.create');
    Route::put('users/{user}',[App\Http\Controllers\UserController::class,'update'])->name('users.update')->middleware('permission:users.edit');
    Route::put('profile/{user}',[App\Http\Controllers\UserController::class,'update_profile'])->name('users.update_profile');
    Route::get('mis_datos/{uuid}',[App\Http\Controllers\UserController::class,'show'])->name('users.show')->middleware('permission:users.show');
    Route::get('usuario/{uuid}/destroy',[App\Http\Controllers\UserController::class,'destroy'])->name('users.destroy')->middleware('permission:users.destroy');
    Route::get('users/{uuid}/edit',[App\Http\Controllers\UserController::class,'edit'])->name('users.edit')->middleware('permission:users.edit');
    Route::get('datos_empleado',[App\Http\Controllers\UserController::class,'datos_empleado'])->name('datos.empleado');
    Route::post('/change-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change.password');
    
      //Permisos
    Route::post('permisos/store',[App\Http\Controllers\PermissionController::class,'store'])->name('permisos.store')->middleware('permission:permisos.create');
    Route::get('permisos',[App\Http\Controllers\PermissionController::class,'index'])->name('permisos.index')->middleware('permission:permisos.index');
    Route::get('permisos/create',[App\Http\Controllers\PermissionController::class,'create'])->name('permisos.create')->middleware('permission:permisos.create');
    Route::put('permisos/{permiso}',[App\Http\Controllers\PermissionController::class,'update'])->name('permisos.update')->middleware('permission:permisos.edit');
    Route::get('permisos/{permiso}',[App\Http\Controllers\PermissionController::class,'show'])->name('permisos.show')->middleware('permission:permisos.show');
    Route::get('permisos/{permiso}/eliminar',[App\Http\Controllers\PermissionController::class,'destroy'])->name('permisos.destroy')->middleware('permission:permisos.destroy');
    Route::get('permisos/{permiso}/edit',[App\Http\Controllers\PermissionController::class,'edit'])->name('permisos.edit')->middleware('permission:permisos.edit');

    //Proveedores
    Route::post('proveedor/store',[App\Http\Controllers\ProveedorController::class,'store'])->name('proveedores.store')->middleware('permission:proveedores.create');
    Route::get('proveedores',[App\Http\Controllers\ProveedorController::class,'index'])->name('proveedores.index')->middleware('permission:proveedores.index');
    Route::post('proveedores/consulta', [App\Http\Controllers\ProveedorController::class, 'consulta'])->name('proveedores.consulta')->middleware('permission:proveedores.index');
    Route::get('proveedor/create',[App\Http\Controllers\ProveedorController::class,'create'])->name('proveedores.create')->middleware('permission:proveedores.create');
    Route::put('proveedor/{proveedor}',[App\Http\Controllers\ProveedorController::class,'update'])->name('proveedores.update')->middleware('permission:proveedores.edit');
    Route::get('proveedor/{uuid}',[App\Http\Controllers\ProveedorController::class,'show'])->name('proveedores.show')->middleware('permission:proveedores.show');
    Route::get('proveedor/{uuid}/destroy',[App\Http\Controllers\ProveedorController::class,'destroy'])->name('proveedores.destroy')->middleware('permission:proveedores.destroy');
    Route::get('proveedor/{uuid}/edit',[App\Http\Controllers\ProveedorController::class,'edit'])->name('proveedores.edit')->middleware('permission:proveedores.edit');
    
    //consultas
    Route::post('consultas/store', [App\Http\Controllers\ConsultaController::class, 'store'])->name('consultas.store')->middleware('permission:consultas.create');
    Route::get('consultas/{uuidPaciente}/add', [App\Http\Controllers\ConsultaController::class, 'create'])->name('consultas.create')->middleware('permission:consultas.create');
    Route::get('todas_consultas/{uuidPaciente}', [App\Http\Controllers\ConsultaController::class, 'show'])->name('consultas.show')->middleware('permission:consultas.show');
    Route::get('consultas/{uuid}/destroy', [App\Http\Controllers\ConsultaController::class, 'destroy'])->name('consultas.destroy')->middleware('permission:consultas.destroy');
    Route::get('consultas/edit/{uuid}', [App\Http\Controllers\ConsultaController::class, 'edit'])->name('consultas.edit')->middleware('permission:consultas.edit');
    Route::put('consultas/updated/{consulta}', [App\Http\Controllers\ConsultaController::class, 'updated'])->name('consultas.update')->middleware('permission:consultas.edit');
    Route::get('consultas', [App\Http\Controllers\ConsultaController::class, 'index'])->name('consultas.index')->middleware('permission:consultas.index');
    Route::post('buscar_proveedores', [App\Http\Controllers\ConsultaController::class, 'buscar_paciente'])->name('buscar_proveedores')->middleware('permission:consultas.index');   

     //internaciones
    Route::post('internaciones/store', [App\Http\Controllers\InternacionController::class, 'store'])->name('internaciones.store')->middleware('permission:internaciones.create');
    Route::get('internaciones/{uuidPaciente}/add', [App\Http\Controllers\InternacionController::class, 'create'])->name('internaciones.create')->middleware('permission:internaciones.create');
    Route::get('todas_internaciones/{uuidPaciente}', [App\Http\Controllers\InternacionController::class, 'show'])->name('internaciones.show')->middleware('permission:internaciones.show');
    Route::get('internaciones/{uuid}/destroy', [App\Http\Controllers\InternacionController::class, 'destroy'])->name('internaciones.destroy')->middleware('permission:internaciones.destroy');
    Route::get('internaciones/edit/{uuid}', [App\Http\Controllers\InternacionController::class, 'edit'])->name('internaciones.edit')->middleware('permission:internaciones.edit');
    Route::put('internaciones/updated/{internacion}', [App\Http\Controllers\InternacionController::class, 'updated'])->name('internaciones.update')->middleware('permission:internaciones.edit');
    Route::get('internaciones', [App\Http\Controllers\InternacionController::class, 'index'])->name('internaciones.index')->middleware('permission:internaciones.index');
    Route::post('buscar_proveedores_internacion', [App\Http\Controllers\InternacionController::class, 'buscar_paciente_internacion'])->name('buscar_proveedores_internacion')->middleware('permission:internaciones.index');
 
    //Medicos
    Route::post('medico/store',[App\Http\Controllers\MedicoController::class,'store'])->name('medicos.store')->middleware('permission:medicos.create');
    Route::get('medicos',[App\Http\Controllers\MedicoController::class,'index'])->name('medicos.index')->middleware('permission:medicos.index');
    Route::post('medicos/consulta', [App\Http\Controllers\MedicoController::class, 'consulta'])->name('medicos.consulta')->middleware('permission:medicos.index');
    Route::get('medico/create',[App\Http\Controllers\MedicoController::class,'create'])->name('medicos.create')->middleware('permission:medicos.create');
    Route::put('medico/{medico}',[App\Http\Controllers\MedicoController::class,'update'])->name('medicos.update')->middleware('permission:medicos.edit');
    Route::get('medico/{uuid}',[App\Http\Controllers\MedicoController::class,'show'])->name('medicos.show')->middleware('permission:medicos.show');
    Route::get('medico/{uuid}/destroy',[App\Http\Controllers\MedicoController::class,'destroy'])->name('medicos.destroy')->middleware('permission:medicos.destroy');
    Route::get('medico/{uuid}/edit',[App\Http\Controllers\MedicoController::class,'edit'])->name('medicos.edit')->middleware('permission:medicos.edit');
   

    //sala
    Route::post('sala', [App\Http\Controllers\SalaController::class, 'store'])->name('salas.store')->middleware('permission:salas.create');
    Route::get('sala', [App\Http\Controllers\SalaController::class, 'index'])->name('salas.index')->middleware('permission:salas.index');
    Route::get('sala/create', [App\Http\Controllers\SalaController::class, 'create'])->name('salas.create')->middleware('permission:salas.create');
    Route::get('sala/{uuid}', [App\Http\Controllers\SalaController::class, 'show'])->name('salas.show')->middleware('permission:salas.show');
    Route::get('sala/{uuid}/edit', [App\Http\Controllers\SalaController::class, 'edit'])->name('salas.edit')->middleware('permission:salas.edit');
    Route::put('sala/{sala}', [App\Http\Controllers\SalaController::class, 'update'])->name('salas.update')->middleware('permission:salas.edit');
    Route::get('sala/{uuid}/destroy', [App\Http\Controllers\SalaController::class, 'destroy'])->name('salas.destroy')->middleware('permission:salas.destroy');

    //camas
    Route::post('camas/store',[App\Http\Controllers\CamasController::class,'store'])->name('camas.store')->middleware('permission:camas.create');
    Route::get('camas',[App\Http\Controllers\CamasController::class,'index'])->name('camas.index')->middleware('permission:camas.index');
    Route::get('camas/{uuidSala}/add',[App\Http\Controllers\CamasController::class,'create'])->name('camas.create')->middleware('permission:camas.create');
    Route::get('cama/{uuid}/edit', [App\Http\Controllers\CamasController::class, 'edit'])->name('camas.edit')->middleware('permission:camas.edit');
    Route::get('cama/{uuid}/destroy', [App\Http\Controllers\CamasController::class, 'destroy'])->name('camas.destroy')->middleware('permission:camas.destroy');
    Route::put('cama/{cama}', [App\Http\Controllers\CamasController::class, 'update'])->name('camas.update')->middleware('permission:camas.edit');
    
    //academico
    Route::get('academico',[App\Http\Controllers\AcademicoController::class,'index'])->name('academico.index')->middleware('permission:academico.index');
    Route::post('academico/store',[App\Http\Controllers\AcademicoController::class,'store'])->name('academico.store')->middleware('permission:academico.create');
    Route::get('academico/{uuid}/edit',[App\Http\Controllers\AcademicoController::class,'edit'])->name('academico.edit')->middleware('permission:academico.edit');
    Route::put('academico/{parametro}',[App\Http\Controllers\AcademicoController::class,'update'])->name('academico.update')->middleware('permission:academico.update');
    Route::get('academico/{uuid}/destroy',[App\Http\Controllers\AcademicoController::class,'destroy'])->name('academico.destroy')->middleware('permission:academico.destroy');

    //enfermedad terminal
    Route::post('buscar_empleado_enfermedad',[App\Http\Controllers\EnfermedadTerminalController::class,'buscar_empleado'])->name('buscar_empleado_enfermedad')->middleware('permission:enfermedades.show');
    Route::post('enfermedad_terminal/store',[App\Http\Controllers\EnfermedadTerminalController::class,'store'])->name('enfermedades.store')->middleware('permission:enfermedades.create');
    Route::get('enfermedad_terminal/{uuid}/add',[App\Http\Controllers\EnfermedadTerminalController::class,'create'])->name('enfermedades.create')->middleware('permission:enfermedades.create');
    Route::put('enfermedad/{enfermedadTerminal}/{empleado}',[App\Http\Controllers\EnfermedadTerminalController::class,'update'])->name('enfermedades.update')->middleware('permission:enfermedades.edit');
    Route::get('enfermedad/{et_uuid}/edit',[App\Http\Controllers\EnfermedadTerminalController::class,'edit'])->name('enfermedades.edit')->middleware('permission:enfermedades.edit');
    Route::get('enfermedades/{et_uuid}/destroy',[App\Http\Controllers\EnfermedadTerminalController::class,'destroy'])->name('enfermedades.destroy')->middleware('permission:enfermedades.destroy');
    Route::get('ver_enfermedades',[App\Http\Controllers\EnfermedadTerminalController::class,'index'])->name('enfermedades.index')->middleware('permission:enfermedades.index');
    Route::get('empleados_enfermedades',[App\Http\Controllers\EnfermedadTerminalController::class,'empleados'])->name('enfermedades_empleados.index')->middleware('permission:enfermedades.index');
    
     
    //kardex
    Route::get('kardex_empleados',[App\Http\Controllers\KardexController::class,'index'])->name('archivo_digital.index')->middleware('permission:archivo_digital.index');
    Route::get('kardex/{uuidEmpleado}',[App\Http\Controllers\KardexController::class,'show'])->name('archivo_digital.show')->middleware('permission:archivo_digital.show');
    Route::post('buscar_empleado_kardex',[App\Http\Controllers\KardexController::class,'buscar_empleado'])->name('buscar_empleado_kardex')->middleware('permission:archivo_digital.show');
    Route::get('reportes_kardex',[App\Http\Controllers\KardexController::class,'reporte'])->name('reportes.kardex')->middleware('permission:archivo_digital.show');
    Route::post('reportes_kardex/generate',[App\Http\Controllers\KardexController::class,'reporte_store'])->name('reportes.generate')->middleware('permission:archivo_digital.show');
    Route::post('reportes_kardex/pdf',[App\Http\Controllers\KardexController::class,'reporte_stores'])->name('reportes.pdfs')->middleware('permission:archivo_digital.show');
    Route::post('reportes_kardex/excel', [App\Http\Controllers\KardexController::class, 'reporte_excel'])->name('reportes.excel')->middleware('permission:archivo_digital.show');

    //Años de servicio
    Route::post('años_servicio/store',[App\Http\Controllers\KardexController::class,'años_store'])->name('años_servicio.store')->middleware('permission:servicio_años.create');
    Route::get('años_servicio',[App\Http\Controllers\KardexController::class,'años_index'])->name('años_servicio.index')->middleware('permission:servicio_años.index');
    Route::get('años_servicio/{uuidEmpleado}/agregar',[App\Http\Controllers\KardexController::class,'años_create'])->name('años_servicio.create')->middleware('permission:servicio_años.create');
    Route::get('documento_agrupado/{uuidEmpleado}',[App\Http\Controllers\KardexController::class,'años_show'])->name('años_servicio.show')->middleware('permission:servicio_años.show');
    Route::get('años_servicio/{uuid}/destroy',[App\Http\Controllers\KardexController::class,'años_destroy'])->name('años_servicio.destroy')->middleware('permission:servicio_años.destroy');
    
    Route::post('institucion_formacion',[App\Http\Controllers\EmpleadoController::class,'institucion_store'])->name('institucion.store');
    Route::post('institucion_formacion',[App\Http\Controllers\EmpleadoController::class,'institucion_store'])->name('institucion.store');
    Route::post('profesion',[App\Http\Controllers\EmpleadoController::class,'profesion_store'])->name('profesion.store');
    Route::post('formacion',[App\Http\Controllers\EmpleadoController::class,'formacion_store'])->name('formacion.store');
       
    //Licencias
    Route::post('licencias/empleados/resultado',[App\Http\Controllers\LicenciaController::class,'consulta'])->name('consulta.licencia')->middleware('permission:licencias.index');
    Route::get('licencia/buscar_empleado',[App\Http\Controllers\LicenciaController::class,'consulta_index'])->name('consulta_licencias.index')->middleware('permission:licencias.index');
    Route::get('licencias/empleados',[App\Http\Controllers\LicenciaController::class,'empleados'])->name('licencias_empleados.index')->middleware('permission:licencias.index');
    Route::get('ver_licencias',[App\Http\Controllers\LicenciaController::class,'ver_licencia'])->name('ver_licencias.index');
    Route::get('licencias/index',[App\Http\Controllers\LicenciaController::class,'index'])->name('licencias.index')->middleware('permission:licencias.index');
    Route::get('licencias/{uuid}/create',[App\Http\Controllers\LicenciaController::class,'create'])->name('licencias.create')->middleware('permission:licencias.create');
    Route::post('licencias/store',[App\Http\Controllers\LicenciaController::class,'store'])->name('licencias.store')->middleware('permission:licencias.create');
    Route::put('licencias/{licencia}/{parametro}',[App\Http\Controllers\LicenciaController::class,'update'])->name('licencias.update')->middleware('permission:licencias.edit');
    Route::get('licencia/{uuid}/show',[App\Http\Controllers\LicenciaController::class,'show'])->name('licencias.show')->middleware('permission:licencias.show');
    Route::get('licencias/indexEmpleado',[App\Http\Controllers\LicenciaController::class,'indexEmpleado'])->name('licencias_empleado.index')->middleware('permission:licencias.index');
    Route::delete('licencia/{licencia}/destroy',[App\Http\Controllers\LicenciaController::class,'destroy'])->name('licencias.destroy')->middleware('permission:licencias.destroy');
    Route::post('licencia_ficha/store',[App\Http\Controllers\LicenciaController::class,'ficha_store'])->name('ficha_comprobante.store')->middleware('permission:licencias.upload');
    Route::get('licencia/{uuid}/ficha',[App\Http\Controllers\LicenciaController::class,'ficha'])->name('licencias.ficha')->middleware('permission:licencias.upload');
    Route::get('licencias/{empleado}/{uuid}/edit',[App\Http\Controllers\LicenciaController::class,'edit'])->name('licencias.edit')->middleware('permission:licencias.edit');
    Route::get('licencias/reportes',[App\Http\Controllers\LicenciaController::class,'reporte'])->name('licencias.reporte')->middleware('permission:licencias.index');
    Route::post('licencias/reporte_ver',[App\Http\Controllers\LicenciaController::class,'reporte_ver'])->name('licencias.reporte_ver');
    Route::post('licencias/reporte_descargar',[App\Http\Controllers\LicenciaController::class,'reporte_descargar'])->name('licencias.reporte_descargar');

    Route::get('licencias_calendario', [App\Http\Controllers\LicenciaController::class, 'calendario'])->name('licencias.calendario')->middleware('permission:licencias.show');
    Route::get('apiLicencia',[App\Http\Controllers\LicenciaController::class,'apiLicencia'])->name('apiLicencia');
    Route::get('licencias/{licencia}/update_estado',[App\Http\Controllers\LicenciaController::class,'update_estado'])->name('licencias_estado.update')->middleware('permission:licencias.edit');
    
    
    //Vacaciones
    Route::get('ver_vacaciones', [App\Http\Controllers\VacacionController::class, 'index'])->name('vacaciones.index')->middleware('permission:vacaciones.index');
    Route::post('vacaciones_buscar_empleado', [App\Http\Controllers\VacacionController::class, 'buscar_empleado'])->name('vacaciones_buscar_empleado')->middleware('permission:vacaciones.show');
    Route::get('vacaciones_solicitadas', [App\Http\Controllers\VacacionController::class, 'vacaciones_solicitadas'])->name('vacaciones.vacaciones_solicitadas')->middleware('permission:vacaciones.index');
    Route::get('vacaciones_pendientes', [App\Http\Controllers\VacacionController::class, 'vacaciones_pendientes'])->name('vacaciones.vacaciones_pendientes')->middleware('permission:vacaciones.index');
    Route::get('vacacion/{empleado}', [App\Http\Controllers\VacacionController::class, 'show'])->name('vacacion.show')->middleware('permission:vacaciones.show');
    Route::get('vacaciones_create/{uuid}', [App\Http\Controllers\VacacionController::class, 'create'])->name('vacaciones.create')->middleware('permission:vacaciones.create');
    Route::get('vacacion/{vacacion_uuid}/edit', [App\Http\Controllers\VacacionController::class, 'edit'])->name('vacacion.edit')->middleware('permission:vacaciones.edit');
    Route::post('vacacion_aprobada', [App\Http\Controllers\VacacionController::class, 'vacacion_aprobada'])->name('vacacion.aprobada')->middleware('permission:vacaciones.create');
    Route::post('vacacion_rechazo/', [App\Http\Controllers\VacacionController::class, 'vacacion_rechazada'])->name('vacacion.rechazo')->middleware('permission:vacaciones.updated');
    Route::post('vacaciones_store', [App\Http\Controllers\VacacionController::class, 'store'])->name('vacaciones.store')->middleware('permission:vacaciones.create');
    Route::put('vacaciones/{vacacion}', [App\Http\Controllers\VacacionController::class, 'update'])->name('vacaciones.update')->middleware('permission:vacaciones.edit');
    Route::get('vacaciones_calendario', [App\Http\Controllers\VacacionController::class, 'calendario'])->name('vacaciones.calendario')->middleware('permission:vacaciones.show');
    Route::get('api',[App\Http\Controllers\VacacionController::class,'api'])->name('api');
    Route::get('solicitud_vacacion/{vacacion_uuid}/reporte', [App\Http\Controllers\VacacionController::class, 'solicitud_vacacion'])->name('vacacion.solicitud_vacacion')->middleware('permission:vacaciones.show');
       


    //Feriados
    Route::get('feriados',[App\Http\Controllers\FeriadoController::class,'index'])->name('feriados.index')->middleware('permission:feriados.index');
    Route::post('feriados/store',[App\Http\Controllers\FeriadoController::class,'store']);
    Route::get('obtener_feriados',[App\Http\Controllers\FeriadoController::class,'listar']);
    Route::delete('feriados/{feriado}/destroy',[App\Http\Controllers\FeriadoController::class,'destroy']);

    //Cargos
    Route::post('cargos/store',[App\Http\Controllers\CargoController::class,'store'])->name('cargos.store')->middleware('permission:cargos.create');
    Route::get('cargos',[App\Http\Controllers\CargoController::class,'index'])->name('cargos.index')->middleware('permission:cargos.index');
    Route::get('cargos/create',[App\Http\Controllers\CargoController::class,'create'])->name('cargos.create')->middleware('permission:cargos.create');
    Route::put('cargos/{cargo}',[App\Http\Controllers\CargoController::class,'update'])->name('cargos.update')->middleware('permission:cargos.edit');
    Route::get('cargos/{cargo}',[App\Http\Controllers\CargoController::class,'show'])->name('cargos.show')->middleware('permission:cargos.show');
    Route::get('cargos/{uuid}/destroy',[App\Http\Controllers\CargoController::class,'destroy'])->name('cargos.destroy')->middleware('permission:cargos.destroy');
    Route::get('cargos/{uuid}/edit',[App\Http\Controllers\CargoController::class,'edit'])->name('cargos.edit')->middleware('permission:cargos.edit');

    Route::post('refrigerios/store',[App\Http\Controllers\RefrigerioController::class,'store'])->name('refrigerios.store')->middleware('permission:refrigerios.create');
   // Route::get('refrigerios',[App\Http\Controllers\RefrigerioController::class,'index'])->name('refrigerios.index')->middleware('permission:refrigerios.index');
    Route::get('refrigerios/create',[App\Http\Controllers\RefrigerioController::class,'create'])->name('refrigerios.create')->middleware('permission:refrigerios.create');
    Route::put('refrigerios/{refrigerio}',[App\Http\Controllers\RefrigerioController::class,'update'])->name('refrigerios.update')->middleware('permission:refrigerios.edit');
    Route::get('refrigerios/{refrigerio}',[App\Http\Controllers\RefrigerioController::class,'show'])->name('refrigerios.show')->middleware('permission:refrigerios.show');
    Route::delete('refrigerios/{refrigerio}',[App\Http\Controllers\RefrigerioController::class,'destroy'])->name('refrigerios.destroy')->middleware('permission:refrigerios.destroy');
    Route::get('refrigerios/{refrigerio}/edit',[App\Http\Controllers\RefrigerioController::class,'edit'])->name('refrigerios.edit')->middleware('permission:refrigerios.edit');

    Route::get('refrigerios', [App\Http\Controllers\RefrigerioController::class, 'consulta_index'])->name('refrigerios.index');
    Route::post('refrigerios/consulta', [App\Http\Controllers\RefrigerioController::class, 'consulta'])->name('refrigerios.consulta');
    Route::post('export/excel', [App\Http\Controllers\RefrigerioController::class, 'exportToExcel'])->name('export.excel');
    Route::post('export/pdf', [App\Http\Controllers\RefrigerioController::class, 'exportToPDF'])->name('export.pdf');
    
    Route::get('refrigerios_variable', [App\Http\Controllers\RefrigerioController::class, 'edit_variables'])->name('variable.refrigerios')->middleware('permission:refrigerios.edit');
    Route::get('pago_variables', [App\Http\Controllers\RefrigerioController::class, 'pago_variables'])->name('variable.pagos');
    Route::get('update_variables',[App\Http\Controllers\RefrigerioController::class,'update_variable'])->name('variable.update');
    
  
      
    //Memorandum
    Route::post('memorandum/{empleado}/store', [App\Http\Controllers\MemorandumController::class, 'store'])->name('memorandums.store')->middleware('permission:memorandums.create');
    Route::get('memorandum', [App\Http\Controllers\MemorandumController::class, 'index'])->name('memorandums.index')->middleware('permission:memorandums.index');
    Route::post('buscar_empleado_memorandums', [App\Http\Controllers\MemorandumController::class, 'buscar_empleado'])->name('buscar_empleado_memorandums')->middleware('permission:memorandums.show');
    Route::get('memorandum/{uuid}', [App\Http\Controllers\MemorandumController::class, 'create'])->name('memorandums.create')->middleware('permission:memorandums.create');
    Route::get('memorandum_ficha/{mem_uuid}',[App\Http\Controllers\MemorandumController::class,'show'])->name('memorandums.show')->middleware('permission:memorandums.show');
    Route::get('memorandum_estado',[App\Http\Controllers\MemorandumController::class,'estado'])->name('memorandums.estado')->middleware('permission:memorandums.edit');
    Route::get('memorandum_destroy',[App\Http\Controllers\MemorandumController::class,'destroy'])->name('memorandums.destroy')->middleware('permission:memorandums.destroy');
    Route::get('mis_memorandums/{empleado}',[App\Http\Controllers\MemorandumController::class,'mis_memorandums'])->name('mis_memorandums.show')->middleware('permission:memorandums.show');
    Route::get('ver_memorandums',[App\Http\Controllers\MemorandumController::class,'memorandums_empleado'])->name('memorandums.estado');
    Route::put('memorandum/updated/{memorandum}', [App\Http\Controllers\MemorandumController::class, 'updated'])->name('memorandums.updated')->middleware('permission:memorandums.edit');
    Route::get('memorandum/edit/{mem_uuid}', [App\Http\Controllers\MemorandumController::class, 'editar'])->name('memorandums.edit')->middleware('permission:memorandums.edit');
    

    
    
    
    
       
    
    ///Memorandums Documentos
    Route::get('documento_memorandum', [App\Http\Controllers\DocumentMemorandumController::class, 'index'])->name('documento_memorandum.index')->middleware('permission:documento_memorandum.index');
    Route::post('documento_memorandum_buscar_empleados', [App\Http\Controllers\DocumentMemorandumController::class, 'buscar_empleado'])->name('buscar_empleado_documento_memorandum')->middleware('permission:documento_memorandum.show');
    Route::get('documento_memorandum/{uuid}',[App\Http\Controllers\DocumentMemorandumController::class,'create'])->name('documento_memorandum_create')->middleware('permission:documento_memorandum.create');
    Route::post('documento_memorandum/store',[App\Http\Controllers\DocumentMemorandumController::class,'store'])->name('documento_memorandum_store')->middleware('permission:documento_memorandum.create');
    Route::get('todas_documentos_memorandums/{empleado}',[App\Http\Controllers\DocumentMemorandumController::class,'show'])->name('documento_memorandum_show')->middleware('permission:documento_memorandum.show');
    Route::get('documento_memorandum/{documentoMemorandum}/destroy', [App\Http\Controllers\DocumentMemorandumController::class, 'destroy'])->name('documento_memorandum_destroy')->middleware('permission:documento_memorandum.destroy');
    
    //----------------------------------
    Route::get('documento_memorandum_reporte',[App\Http\Controllers\DocumentMemorandumController::class,'reporte'])->name('documentomemorandum.reporte')->middleware('permission:documento_memorandum.index');
    Route::post('documento_memorandum_reporte_ver',[App\Http\Controllers\DocumentMemorandumController::class,'reporte_ver'])->name('documentomemorandum.reporte_ver');
    Route::post('documento_memorandum_reporte/reporte_descargar',[App\Http\Controllers\DocumentMemorandumController::class,'reporte_descargar'])->name('documentomemorandum.reporte_descargar');


    
    
   //Comisiones
    Route::get('comisiones', [App\Http\Controllers\ComisionController::class, 'index'])->name('comisiones.index')->middleware('permission:comisiones.index');
    Route::post('comisiones_buscar_empleado', [App\Http\Controllers\ComisionController::class, 'buscar_empleado'])->name('buscar_empleado_comisiones')->middleware('permission:comisiones.show');
    Route::get('comisiones/{uuidEmpleado}', [App\Http\Controllers\ComisionController::class, 'create'])->name('comisiones.create')->middleware('permission:comisiones.create');
    Route::post('comisiones/store', [App\Http\Controllers\ComisionController::class, 'store'])->name('comisiones.store')->middleware('permission:comisiones.create');
    Route::get('comisiones_pdf/{uuid}',[App\Http\Controllers\ComisionController::class,'show'])->name('comisiones.show')->middleware('permission:comisiones.show');
    Route::get('comisiones/{uuid}/edit',[App\Http\Controllers\ComisionController::class,'edit'])->name('comisiones.edit')->middleware('permission:comisiones.edit');
    Route::put('comisiones/{comision}',[App\Http\Controllers\ComisionController::class,'update'])->name('comisiones.update')->middleware('permission:comisiones.edit');
    Route::get('comisiones/{uuid}/destroy',[App\Http\Controllers\ComisionController::class,'destroy'])->name('comisiones.destroy')->middleware('permission:comisiones.destroy');
    Route::post('comisiones_ficha/store',[App\Http\Controllers\ComisionController::class,'ficha_store'])->name('comisiones_ficha_firmada.store')->middleware('permission:comisiones.create');
    Route::get('comisiones_ficha/{uuid}',[App\Http\Controllers\ComisionController::class,'ficha'])->name('comisiones.ficha')->middleware('permission:comisiones.show');
    Route::get('mis_comisiones/{uuidEmpleado}',[App\Http\Controllers\ComisionController::class,'mis_comisiones'])->name('mis_comisiones.show')->middleware('permission:comisiones.show');

        //Cargo empleados
    Route::get('cargo_empleados',[App\Http\Controllers\CargoEmpleadoController::class,'index'])->name('cargoEmpleados.index')->middleware('permission:cargoEmpleados.index');
    Route::get('cargo_empleados/agregar_interino/{uuidEmpleado}',[App\Http\Controllers\CargoEmpleadoController::class,'interino'])->name('cargoEmpleados.interino')->middleware('permission:cargoEmpleados.store_asignar');
    Route::get('buscar_empleados/cargos', [App\Http\Controllers\CargoEmpleadoController::class, 'buscar_cargo_empleado'])->name('cargoEmpleados.buscar_cargo_empleado')->middleware('permission:cargoEmpleados.index');
    Route::get('cargo_empleados/cargos_acefalo',[App\Http\Controllers\CargoEmpleadoController::class,'acefalo_index'])->name('cargoEmpleados.acefalo_index')->middleware('permission:cargoEmpleados.acefalo_index');
    Route::get('cargo_empleados/asignar/{uuidCargo}',[App\Http\Controllers\CargoEmpleadoController::class,'asignar'])->name('cargoEmpleados.asignar')->middleware('permission:cargoEmpleados.asignar');
    Route::post('cargos_asignados/{cargo}',[App\Http\Controllers\CargoEmpleadoController::class,'store_asignar'])->name('cargoEmpleados.store_asignar')->middleware('permission:cargoEmpleados.store_asignar');
    Route::Post('cargo_empleados/liberar/{cargoEmpleado}', [App\Http\Controllers\CargoEmpleadoController::class,'store_liberar'])->name('cargoEmpleados.store_liberar')->middleware('permission:cargoEmpleados.store_liberar');
    Route::Post('cargo_empleados/store_fecha/{cargoEmpleado}', [App\Http\Controllers\CargoEmpleadoController::class,'store_fecha'])->name('cargoEmpleados.store_fecha')->middleware('permission:cargoEmpleados.store_asignar');
    Route::Post('cargo_empleados/interino/{cargoEmpleado}', [App\Http\Controllers\CargoEmpleadoController::class,'store_interino'])->name('cargoEmpleados.store_interino')->middleware('permission:cargoEmpleados.store_asignar');
    Route::get('cargo_empleados/{uuid}/destroy',[App\Http\Controllers\CargoEmpleadoController::class,'destroy'])->name('cargoEmpleados.destroy')->middleware('permission:cargoEmpleados.destroy');
   
    //cargoDenominacion
    Route::post('cargoDenominacion/store',[App\Http\Controllers\CargoDenominacionController::class,'store'])->name('cargoDenominacion.store')->middleware('permission:cargoDenominacion.create');
    Route::get('cargoDenominacion',[App\Http\Controllers\CargoDenominacionController::class,'index'])->name('cargoDenominacion.index')->middleware('permission:cargoDenominacion.index');
    Route::get('cargoDenominacion/create',[App\Http\Controllers\CargoDenominacionController::class,'create'])->name('cargoDenominacion.create')->middleware('permission:cargoDenominacion.create');
    Route::get('cargoDenominacion/{uuid}/edit', [App\Http\Controllers\CargoDenominacionController::class, 'edit'])->name('cargoDenominacion.edit')->middleware('permission:cargoDenominacion.edit');
    Route::get('cargoDenominacion/{uuid}/destroy', [App\Http\Controllers\CargoDenominacionController::class, 'destroy'])->name('cargoDenominacion.destroy')->middleware('permission:cargoDenominacion.destroy');
    Route::put('cargoDenominacion/{cargoDenominacion}', [App\Http\Controllers\CargoDenominacionController::class, 'update'])->name('cargoDenominacion.update')->middleware('permission:cargoDenominacion.edit');

    //incrementosalarial
    Route::post('incrementoSalarial/store',[App\Http\Controllers\IncrementoSalarialController::class,'store'])->name('incrementoSalarial.store')->middleware('permission:incrementoSalarial.create');
    Route::get('incrementoSalarial/create',[App\Http\Controllers\IncrementoSalarialController::class,'create'])->name('incrementoSalarial.create')->middleware('permission:incrementoSalarial.create');
    Route::get('incrementoSalarial/{incrementoSalarial}/edit', [App\Http\Controllers\IncrementoSalarialController::class, 'edit'])->name('incrementoSalarial.edit')->middleware('permission:incrementoSalarial.edit');
    Route::delete('incrementoSalarial/{incrementoSalarial}', [App\Http\Controllers\IncrementoSalarialController::class, 'destroy'])->name('incrementoSalarial.destroy')->middleware('permission:incrementoSalarial.destroy');
    Route::put('incrementoSalarial/{incrementoSalarial}', [App\Http\Controllers\IncrementoSalarialController::class, 'update'])->name('incrementoSalarial.update')->middleware('permission:incrementoSalarial.update');
    Route::post('motivo', [App\Http\Controllers\IncrementoSalarialController::class, 'motivo_store'])->name('motivo.store');
   
    //Planillas
    Route::post('planillas/generar',[App\Http\Controllers\PlanillaController::class,'generar'])->name('planillas.generar')->middleware('permission:planillas.create');
    Route::get('planillas',[App\Http\Controllers\PlanillaController::class,'index'])->name('planillas.index')->middleware('permission:planillas.create');
    
    
    //Planilla Sueldos

    Route::get('PlanillaSueldos', [App\Http\Controllers\SancionesController::class, 'consulta_index'])->name('sanciones.index');
    Route::post('PlanillaSueldos/consulta', [App\Http\Controllers\SancionesController::class, 'consulta'])->name('sanciones.consulta');
    Route::post('PlanillaExport/excel', [App\Http\Controllers\SancionesController::class, 'exportToExcel'])->name('export.planilla.excel');
    Route::post('PlanillaExport/pdf', [App\Http\Controllers\SancionesController::class, 'exportToPDF'])->name('export.planilla.pdf');

    //Asistencia
    
    Route::get('asistencias',[App\Http\Controllers\AsistenciaController::class,'index'])->name('asistencias.index')->middleware('permission:asistencias.index');
    Route::post('asistencias',[App\Http\Controllers\AsistenciaController::class,'show'])->name('asistencias.show')->middleware('permission:asistencias.index');
    
    //Cargo empleados
    /*Route::post('asistencias/store',[App\Http\Controllers\CargoEmpleadoController::class,'store'])->name('asistencias.store')->middleware('permission:asistencias.create');
    Route::get('asistencias',[App\Http\Controllers\CargoEmpleadoController::class,'index'])->name('asistencias.index')->middleware('permission:asistencias.index');
    Route::get('asistencias/create',[App\Http\Controllers\CargoEmpleadoController::class,'create'])->name('asistencias.create')->middleware('permission:asistencias.create');
    Route::put('asistencias/{cargoEmpleado}',[App\Http\Controllers\CargoEmpleadoController::class,'update'])->name('asistencias.update')->middleware('permission:asistencias.edit');
    Route::delete('asistencias/{cargoEmpleado}',[App\Http\Controllers\CargoEmpleadoController::class,'destroy'])->name('asistencias.destroy')->middleware('permission:asistencias.destroy');
    Route::get('asistencias/{cargoEmpleado}/edit',[App\Http\Controllers\CargoEmpleadoController::class,'edit'])->name('asistencias.edit')->middleware('permission:asistencias.edit');
    */
     
    //Reporte
    Route::get('reportes_general',[App\Http\Controllers\ReporteController::class,'reporte'])->name('reporte.general')->middleware('permission:reportes.show');
    Route::post('reportes_generales/pdf',[App\Http\Controllers\ReporteController::class,'reporte_store'])->name('reporte.pdf')->middleware('permission:reportes.show');
    Route::post('reportes_generales/pdfs',[App\Http\Controllers\ReporteController::class,'reporte_stores'])->name('reporte.pdfs')->middleware('permission:reportes.show');
    Route::post('reportes_generales/excel', [App\Http\Controllers\ReporteController::class, 'reporte_excel'])->name('reporte.excel')->middleware('permission:reportes.show');

   //HISTORIAL CVS
    Route::get('historial_cvs', [App\Http\Controllers\HistorialCvsController::class, 'index'])->name('historialcvs.index');
    Route::post('historial_buscar_empleados', [App\Http\Controllers\HistorialCvsController::class, 'buscar_empleado'])->name('buscar_empleado_historial');
    Route::get('historial/{uuidEmpleado}', [App\Http\Controllers\HistorialCvsController::class, 'create'])->name('historialcvs.create');
    Route::post('historial', [App\Http\Controllers\HistorialCvsController::class, 'store'])->name('historialcvs.store');
    
    Route::get('planilla_refrigerios',[App\Http\Controllers\PlanillaRefrigerioController::class,'index'])->name('planilla_refrigerios.index')->middleware('permission:planillas.create');
    Route::post('planilla_refrigerios',[App\Http\Controllers\PlanillaRefrigerioController::class,'calcular_refrigerios'])->name('planilla_refrigerios.calcular')->middleware('permission:planillas.create');
    Route::post('planilla_refrigerios_excel',[App\Http\Controllers\PlanillaRefrigerioController::class,'refrigerios_excel'])->name('planilla_refrigerios.excel')->middleware('permission:planillas.create');
    Route::post('planilla_refrigerios_pdf',[App\Http\Controllers\PlanillaRefrigerioController::class,'refrigerios_pdf'])->name('planilla_refrigerios.pdf')->middleware('permission:planillas.create');

});
