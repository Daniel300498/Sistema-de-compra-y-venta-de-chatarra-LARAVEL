<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Proveedores
        Permission::create(['name' => 'proveedores.index',   'descripcion' => 'Ver todos los Proveedores',  'guard_name' => 'web',  'grupo'=>'PROVEEDORES']);
        Permission::create(['name' => 'proveedores.create',  'descripcion' => 'Agregar Proveedores',        'guard_name' => 'web',  'grupo'=>'PROVEEDORES']);
        Permission::create(['name' => 'proveedores.edit',    'descripcion' => 'Editar Proveedores',         'guard_name' => 'web',  'grupo'=>'PROVEEDORES']);
        Permission::create(['name' => 'proveedores.destroy', 'descripcion' => 'Eliminar Proveedores',       'guard_name' => 'web',  'grupo'=>'PROVEEDORES']);

        // Clientes
        Permission::create(['name' => 'clientes.index',   'descripcion' => 'Ver todos los Clientes', 'guard_name' => 'web',     'grupo'=>'CLIENTES']);
        Permission::create(['name' => 'clientes.create',  'descripcion' => 'Agregar Clientes',       'guard_name' => 'web',     'grupo'=>'CLIENTES']);
        Permission::create(['name' => 'clientes.edit',    'descripcion' => 'Editar Clientes',        'guard_name' => 'web',     'grupo'=>'CLIENTES']);
        Permission::create(['name' => 'clientes.destroy', 'descripcion' => 'Eliminar Clientes',      'guard_name' => 'web',     'grupo'=>'CLIENTES']);

        // Camiones
        Permission::create(['name' => 'camiones.index',   'descripcion' => 'Ver todos los Camiones', 'guard_name' => 'web', 'grupo'=>'CAMIONES']);
        Permission::create(['name' => 'camiones.create',  'descripcion' => 'Agregar Camiones',       'guard_name' => 'web', 'grupo'=>'CAMIONES']);
        Permission::create(['name' => 'camiones.edit',    'descripcion' => 'Editar Camiones',        'guard_name' => 'web', 'grupo'=>'CAMIONES']);
        Permission::create(['name' => 'camiones.destroy', 'descripcion' => 'Eliminar Camiones',      'guard_name' => 'web', 'grupo'=>'CAMIONES']);

        // Operadores de Transporte
        Permission::create(['name' => 'operadores.index',   'descripcion' => 'Ver todos los Operadores', 'guard_name' => 'web', 'grupo'=>'OPERADORES']);
        Permission::create(['name' => 'operadores.create',  'descripcion' => 'Agregar Operadores',       'guard_name' => 'web', 'grupo'=>'OPERADORES']);
        Permission::create(['name' => 'operadores.edit',    'descripcion' => 'Editar Operadores',        'guard_name' => 'web', 'grupo'=>'OPERADORES']);
        Permission::create(['name' => 'operadores.destroy', 'descripcion' => 'Eliminar Operadores',      'guard_name' => 'web', 'grupo'=>'OPERADORES']);

        // Contratos
        Permission::create(['name' => 'contratos.index',   'descripcion' => 'Ver todos los Contratos', 'guard_name' => 'web', 'grupo'=>'CONTRATOS']);
        Permission::create(['name' => 'contratos.create',  'descripcion' => 'Agregar Contratos',       'guard_name' => 'web', 'grupo'=>'CONTRATOS']);
        Permission::create(['name' => 'contratos.edit',    'descripcion' => 'Editar Contratos',        'guard_name' => 'web', 'grupo'=>'CONTRATOS']);
        Permission::create(['name' => 'contratos.destroy', 'descripcion' => 'Eliminar Contratos',      'guard_name' => 'web', 'grupo'=>'CONTRATOS']);

        // Usuarios
        Permission::create(['name' => 'users.index',   'descripcion' => 'Ver todos los Usuarios', 'guard_name' => 'web', 'grupo'=>'USUARIOS']);
        Permission::create(['name' => 'users.create',  'descripcion' => 'Agregar Usuarios',       'guard_name' => 'web', 'grupo'=>'USUARIOS']);
        Permission::create(['name' => 'users.edit',    'descripcion' => 'Editar Usuarios',        'guard_name' => 'web', 'grupo'=>'USUARIOS']);
        Permission::create(['name' => 'users.destroy', 'descripcion' => 'Eliminar Usuarios',      'guard_name' => 'web', 'grupo'=>'USUARIOS']);

        // Roles
        Permission::create(['name' => 'roles.index',   'descripcion' => 'Ver todos los Roles', 'guard_name' => 'web', 'grupo'=>'ROLES']);
        Permission::create(['name' => 'roles.create',  'descripcion' => 'Agregar Roles',       'guard_name' => 'web', 'grupo'=>'ROLES']);
        Permission::create(['name' => 'roles.edit',    'descripcion' => 'Editar Roles',        'guard_name' => 'web', 'grupo'=>'ROLES']);
        Permission::create(['name' => 'roles.destroy', 'descripcion' => 'Eliminar Roles',      'guard_name' => 'web', 'grupo'=>'ROLES']);

        // Parámetros
        Permission::create(['name' => 'parametros.index',   'descripcion' => 'Ver todos los Parámetros', 'guard_name' => 'web', 'grupo'=>'PARAMETROS']);
        Permission::create(['name' => 'parametros.create',  'descripcion' => 'Agregar Parámetros',       'guard_name' => 'web', 'grupo'=>'PARAMETROS']);
        Permission::create(['name' => 'parametros.edit',    'descripcion' => 'Editar Parámetros',        'guard_name' => 'web', 'grupo'=>'PARAMETROS']);
        Permission::create(['name' => 'parametros.destroy', 'descripcion' => 'Eliminar Parámetros',      'guard_name' => 'web', 'grupo'=>'PARAMETROS']);

        // Gastos Extras
        Permission::create(['name' => 'gastos_extras.index',   'descripcion' => 'Ver todos los Gastos Extras', 'guard_name' => 'web', 'grupo'=>'GASTOS_EXTRAS']);
        Permission::create(['name' => 'gastos_extras.create',  'descripcion' => 'Agregar Gastos Extras',       'guard_name' => 'web', 'grupo'=>'GASTOS_EXTRAS']);
        Permission::create(['name' => 'gastos_extras.edit',    'descripcion' => 'Editar Gastos Extras',        'guard_name' => 'web', 'grupo'=>'GASTOS_EXTRAS']);
        Permission::create(['name' => 'gastos_extras.destroy', 'descripcion' => 'Eliminar Gastos Extras',      'guard_name' => 'web', 'grupo'=>'GASTOS_EXTRAS']);

        // Reportes
        Permission::create(['name' => 'reportes.index',   'descripcion' => 'Ver Reportes',      'guard_name' => 'web', 'grupo'=>'REPORTES']);
        Permission::create(['name' => 'reportes.export',  'descripcion' => 'Exportar Reportes', 'guard_name' => 'web', 'grupo'=>'REPORTES']);

        // Permisos (módulo de gestión de permisos)
        Permission::create(['name' => 'permisos.index',   'descripcion' => 'Ver todos los Permisos', 'guard_name' => 'web', 'grupo'=>'PERMISOS']);
        Permission::create(['name' => 'permisos.create',  'descripcion' => 'Agregar Permisos',       'guard_name' => 'web', 'grupo'=>'PERMISOS']);
        Permission::create(['name' => 'permisos.edit',    'descripcion' => 'Editar Permisos',        'guard_name' => 'web', 'grupo'=>'PERMISOS']);
        Permission::create(['name' => 'permisos.destroy', 'descripcion' => 'Eliminar Permisos',      'guard_name' => 'web', 'grupo'=>'PERMISOS']);

        // Conductores
        Permission::create(['name' => 'conductores.index',   'descripcion' => 'Ver asignaciones de conductores',    'guard_name' => 'web', 'grupo'=>'CONDUCTORES']);
        Permission::create(['name' => 'conductores.create',  'descripcion' => 'Asignar conductores a camiones',     'guard_name' => 'web', 'grupo'=>'CONDUCTORES']);
        Permission::create(['name' => 'conductores.edit',    'descripcion' => 'Editar asignaciones de conductores', 'guard_name' => 'web', 'grupo'=>'CONDUCTORES']);
        Permission::create(['name' => 'conductores.destroy', 'descripcion' => 'Eliminar asignaciones de conductores', 'guard_name' => 'web', 'grupo'=>'CONDUCTORES']);

        // Seguimiento de cargas
        Permission::create(['name' => 'seguimiento.index', 'descripcion' => 'Ver seguimiento de cargas', 'guard_name' => 'web', 'grupo'=>'SEGUIMIENTO']);

        // Empleados
        Permission::create(['name' => 'empleados.index',   'descripcion' => 'Ver todos los Empleados', 'guard_name' => 'web', 'grupo'=>'EMPLEADOS']);
        Permission::create(['name' => 'empleados.create',  'descripcion' => 'Agregar Empleados',       'guard_name' => 'web', 'grupo'=>'EMPLEADOS']);
        Permission::create(['name' => 'empleados.edit',    'descripcion' => 'Editar Empleados',        'guard_name' => 'web', 'grupo'=>'EMPLEADOS']);
        Permission::create(['name' => 'empleados.destroy', 'descripcion' => 'Eliminar Empleados',      'guard_name' => 'web', 'grupo'=>'EMPLEADOS']);

        // Bancos y cuentas bancarias
        Permission::create(['name' => 'bancos.index',   'descripcion' => 'Ver bancos y cuentas bancarias', 'guard_name' => 'web', 'grupo'=>'BANCOS']);
        Permission::create(['name' => 'bancos.create',  'descripcion' => 'Agregar bancos y cuentas',       'guard_name' => 'web', 'grupo'=>'BANCOS']);
        Permission::create(['name' => 'bancos.edit',    'descripcion' => 'Editar bancos y cuentas',        'guard_name' => 'web', 'grupo'=>'BANCOS']);
        Permission::create(['name' => 'bancos.destroy', 'descripcion' => 'Eliminar bancos y cuentas',      'guard_name' => 'web', 'grupo'=>'BANCOS']);

        // Cuentas bancarias
        Permission::create(['name' => 'cuentas_bancarias.index',   'descripcion' => 'Ver Cuentas Bancarias',     'guard_name' => 'web', 'grupo'=>'CUENTAS_BANCARIAS']);
        Permission::create(['name' => 'cuentas_bancarias.create',  'descripcion' => 'Agregar Cuentas Bancarias', 'guard_name' => 'web', 'grupo'=>'CUENTAS_BANCARIAS']);
        Permission::create(['name' => 'cuentas_bancarias.edit',    'descripcion' => 'Editar Cuentas Bancarias',  'guard_name' => 'web', 'grupo'=>'CUENTAS_BANCARIAS']);
        Permission::create(['name' => 'cuentas_bancarias.destroy', 'descripcion' => 'Eliminar Cuentas Bancarias','guard_name' => 'web', 'grupo'=>'CUENTAS_BANCARIAS']);

        // Pagos a clientes
        Permission::create(['name' => 'pagos_clientes.index',   'descripcion' => 'Ver Pagos de Clientes',       'guard_name' => 'web', 'grupo'=>'PAGOS_CLIENTES']);
        Permission::create(['name' => 'pagos_clientes.create',  'descripcion' => 'Registrar Pagos de Clientes', 'guard_name' => 'web', 'grupo'=>'PAGOS_CLIENTES']);
        Permission::create(['name' => 'pagos_clientes.edit',    'descripcion' => 'Editar Pagos de Clientes',    'guard_name' => 'web', 'grupo'=>'PAGOS_CLIENTES']);
        Permission::create(['name' => 'pagos_clientes.destroy', 'descripcion' => 'Eliminar Pagos de Clientes',  'guard_name' => 'web', 'grupo'=>'PAGOS_CLIENTES']);

        // Pagos a proveedores
        Permission::create(['name' => 'pagos_proveedores.index',   'descripcion' => 'Ver Pagos a Proveedores',       'guard_name' => 'web', 'grupo'=>'PAGOS_PROVEEDORES']);
        Permission::create(['name' => 'pagos_proveedores.create',  'descripcion' => 'Registrar Pagos a Proveedores', 'guard_name' => 'web', 'grupo'=>'PAGOS_PROVEEDORES']);
        Permission::create(['name' => 'pagos_proveedores.edit',    'descripcion' => 'Editar Pagos a Proveedores',    'guard_name' => 'web', 'grupo'=>'PAGOS_PROVEEDORES']);
        Permission::create(['name' => 'pagos_proveedores.destroy', 'descripcion' => 'Eliminar Pagos a Proveedores',  'guard_name' => 'web', 'grupo'=>'PAGOS_PROVEEDORES']);

        // Pagos a camiones
        Permission::create(['name' => 'pagos_camiones.index',   'descripcion' => 'Ver Pagos a Camiones',       'guard_name' => 'web', 'grupo'=>'PAGOS_CAMIONES']);
        Permission::create(['name' => 'pagos_camiones.create',  'descripcion' => 'Registrar Pagos a Camiones', 'guard_name' => 'web', 'grupo'=>'PAGOS_CAMIONES']);
        Permission::create(['name' => 'pagos_camiones.edit',    'descripcion' => 'Editar Pagos a Camiones',    'guard_name' => 'web', 'grupo'=>'PAGOS_CAMIONES']);
        Permission::create(['name' => 'pagos_camiones.destroy', 'descripcion' => 'Eliminar Pagos a Camiones',  'guard_name' => 'web', 'grupo'=>'PAGOS_CAMIONES']);

        // Crear rol superadmin y asignarle todos los permisos
        $role = Role::create([
            'uuid'        => Str::uuid(),
            'name'        => 'superadmin',
            'guard_name'  => 'web',
            'descripcion' => 'Super Administrador',
        ]);


        $role->givePermissionTo(Permission::all());
    }
}
