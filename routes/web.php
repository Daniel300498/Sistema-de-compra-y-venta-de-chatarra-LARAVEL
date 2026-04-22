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
    Route::get('permisos',[App\Http\Controllers\PermissionController::class,'index'])->name('permisos.index')->middleware('permission:permisos.index');
    Route::post('permisos/store',[App\Http\Controllers\PermissionController::class,'store'])->name('permisos.store')->middleware('permission:permisos.create');
    Route::get('permisos/create',[App\Http\Controllers\PermissionController::class,'create'])->name('permisos.create')->middleware('permission:permisos.create');
    Route::put('permisos/{permiso}',[App\Http\Controllers\PermissionController::class,'update'])->name('permisos.update')->middleware('permission:permisos.edit');
    Route::get('permisos/{permiso}',[App\Http\Controllers\PermissionController::class,'show'])->name('permisos.show')->middleware('permission:permisos.show');
    Route::get('permisos/{permiso}/eliminar',[App\Http\Controllers\PermissionController::class,'destroy'])->name('permisos.destroy')->middleware('permission:permisos.destroy');
    Route::get('permisos/{permiso}/edit',[App\Http\Controllers\PermissionController::class,'edit'])->name('permisos.edit')->middleware('permission:permisos.edit');

    //Proveedores
    Route::get('proveedores',[App\Http\Controllers\ProveedorController::class,'index'])->name('proveedores.index')->middleware('permission:proveedores.index');
    Route::get('proveedor/create',[App\Http\Controllers\ProveedorController::class,'create'])->name('proveedores.create')->middleware('permission:proveedores.create');
    Route::post('proveedor/store',[App\Http\Controllers\ProveedorController::class,'store'])->name('proveedores.store')->middleware('permission:proveedores.create');
    Route::get('proveedor/{uuid}',[App\Http\Controllers\ProveedorController::class,'show'])->name('proveedores.show')->middleware('permission:proveedores.show');
    Route::get('proveedor/{uuid}/edit',[App\Http\Controllers\ProveedorController::class,'edit'])->name('proveedores.edit')->middleware('permission:proveedores.edit');
    Route::put('proveedores/{proveedor}',[App\Http\Controllers\ProveedorController::class,'update'])->name('proveedores.update')->middleware('permission:proveedores.edit');
    Route::get('proveedor/{uuid}/destroy',[App\Http\Controllers\ProveedorController::class,'destroy'])->name('proveedores.destroy')->middleware('permission:proveedores.destroy');
    
    //clientes
    Route::get('clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('clientes.index')->middleware('permission:clientes.index');
    Route::get('clientes/create', [App\Http\Controllers\ClienteController::class, 'create'])->name('clientes.create')->middleware('permission:clientes.create');
    Route::post('clientes/store', [App\Http\Controllers\ClienteController::class, 'store'])->name('clientes.store')->middleware('permission:clientes.create');
    Route::get('clientes/{uuid}', [App\Http\Controllers\ClienteController::class, 'show'])->name('clientes.show')->middleware('permission:clientes.show');
    Route::get('clientes/{uuid}/edit', [App\Http\Controllers\ClienteController::class, 'edit'])->name('clientes.edit')->middleware('permission:clientes.edit');
    Route::put('clientes/{cliente}', [App\Http\Controllers\ClienteController::class, 'update'])->name('clientes.update')->middleware('permission:clientes.edit');
    Route::get('clientes/{uuid}/destroy', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('clientes.destroy')->middleware('permission:clientes.destroy');

    //Camiones
    Route::get('camiones',[App\Http\Controllers\CamionController::class,'index'])->name('camiones.index')->middleware('permission:camiones.index');
    Route::post('camion/store',[App\Http\Controllers\CamionController::class,'store'])->name('camiones.store')->middleware('permission:camiones.create');
    Route::put('camion/{camion}',[App\Http\Controllers\CamionController::class,'update'])->name('camiones.update')->middleware('permission:camiones.edit');
    Route::get('camion/{uuid}/destroy',[App\Http\Controllers\CamionController::class,'destroy'])->name('camiones.destroy')->middleware('permission:camiones.destroy');

    //Operadores de Transporte (propietarios y conductores)
    Route::post('operador/store',[App\Http\Controllers\OperadorTransporteController::class,'store'])->name('operadores.store')->middleware('permission:operadores.create');
    Route::put('operador/{operador}',[App\Http\Controllers\OperadorTransporteController::class,'update'])->name('operadores.update')->middleware('permission:operadores.edit');
    Route::get('operador/{uuid}/destroy',[App\Http\Controllers\OperadorTransporteController::class,'destroy'])->name('operadores.destroy')->middleware('permission:operadores.destroy');

    //Contratos
    Route::get('contratos',[App\Http\Controllers\ContratoController::class,'index'])->name('contratos.index')->middleware('permission:contratos.index');
    Route::post('contrato/store',[App\Http\Controllers\ContratoController::class,'store'])->name('contratos.store')->middleware('permission:contratos.create');
    Route::get('contrato/{uuid}/edit',[App\Http\Controllers\ContratoController::class,'edit'])->name('contratos.edit')->middleware('permission:contratos.edit');
    Route::put('contrato/{contrato}',[App\Http\Controllers\ContratoController::class,'update'])->name('contratos.update')->middleware('permission:contratos.edit');
    Route::get('contrato/{uuid}/destroy',[App\Http\Controllers\ContratoController::class,'destroy'])->name('contratos.destroy')->middleware('permission:contratos.destroy');
    Route::get('contrato/{uuid}/camiones',[App\Http\Controllers\ContratoController::class,'camiones'])->name('contratos.camiones')->middleware('permission:contratos.index');

    //Contrato Camiones
    Route::post('contrato-camion/store',[App\Http\Controllers\ContratoCamionController::class,'store'])->name('contrato-camion.store')->middleware('permission:contratos.edit');
    Route::get('contrato-camion/{uuid}/toggle-entrega',[App\Http\Controllers\ContratoCamionController::class,'toggleEntrega'])->name('contrato-camion.toggle-entrega')->middleware('permission:contratos.edit');
    Route::get('contrato-camion/{uuid}/destroy',[App\Http\Controllers\ContratoCamionController::class,'destroy'])->name('contrato-camion.destroy')->middleware('permission:contratos.edit');

    //Asignación de conductores a camiones
    Route::post('conductor/store',[App\Http\Controllers\CamionConductorController::class,'store'])->name('conductores.store')->middleware('permission:conductores.create');
    Route::get('conductor/{uuid}/finalizar',[App\Http\Controllers\CamionConductorController::class,'finalizarAsignacion'])->name('conductores.finalizar')->middleware('permission:conductores.edit');

    //Endpoints de consulta
    Route::get('api/camiones/detalle',[App\Http\Controllers\CamionConductorController::class,'camionesConDetalle'])->name('camiones.detalle');
    Route::get('api/camion/{uuid}/historial',[App\Http\Controllers\CamionConductorController::class,'historialConductores'])->name('camiones.historial');

   });
