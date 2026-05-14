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

    /*    // Proveedores
        Permission::create(['name' => 'proveedores.index',   'descripcion' => 'Ver todos los Proveedores',  'guard_name' => 'web',  'grupo'=>'PROVEEDORES']);
        Permission::create(['name' => 'proveedores.create',  'descripcion' => 'Agregar Proveedores',        'guard_name' => 'web',  'grupo'=>'PROVEEDORES']);
        Permission::create(['name' => 'proveedores.edit',    'descripcion' => 'Editar Proveedores',         'guard_name' => 'web',  'grupo'=>'PROVEEDORES']);
        Permission::create(['name' => 'proveedores.destroy', 'descripcion' => 'Eliminar Proveedores',       'guard_name' => 'web',  'grupo'=>'PROVEEDORES']);

        $permisos = [
            // Proveedores
            ['name' => 'proveedores.index',   'descripcion' => 'Ver todos los Proveedores',  'grupo' => 'PROVEEDORES'],
            ['name' => 'proveedores.create',  'descripcion' => 'Agregar Proveedores',        'grupo' => 'PROVEEDORES'],
            ['name' => 'proveedores.edit',    'descripcion' => 'Editar Proveedores',         'grupo' => 'PROVEEDORES'],
            ['name' => 'proveedores.destroy', 'descripcion' => 'Eliminar Proveedores',       'grupo' => 'PROVEEDORES'],


            // Clientes
            ['name' => 'clientes.index',   'descripcion' => 'Ver todos los Clientes', 'grupo' => 'CLIENTES'],
            ['name' => 'clientes.create',  'descripcion' => 'Agregar Clientes',       'grupo' => 'CLIENTES'],
            ['name' => 'clientes.edit',    'descripcion' => 'Editar Clientes',        'grupo' => 'CLIENTES'],
            ['name' => 'clientes.destroy', 'descripcion' => 'Eliminar Clientes',      'grupo' => 'CLIENTES'],

            // Camiones
            ['name' => 'camiones.index',   'descripcion' => 'Ver todos los Camiones', 'grupo' => 'CAMIONES'],
            ['name' => 'camiones.create',  'descripcion' => 'Agregar Camiones',       'grupo' => 'CAMIONES'],
            ['name' => 'camiones.edit',    'descripcion' => 'Editar Camiones',        'grupo' => 'CAMIONES'],
            ['name' => 'camiones.destroy', 'descripcion' => 'Eliminar Camiones',      'grupo' => 'CAMIONES'],

            // Operadores de Transporte
            ['name' => 'operadores.index',   'descripcion' => 'Ver todos los Operadores', 'grupo' => 'OPERADORES'],
            ['name' => 'operadores.create',  'descripcion' => 'Agregar Operadores',       'grupo' => 'OPERADORES'],
            ['name' => 'operadores.edit',    'descripcion' => 'Editar Operadores',        'grupo' => 'OPERADORES'],
            ['name' => 'operadores.destroy', 'descripcion' => 'Eliminar Operadores',      'grupo' => 'OPERADORES'],

            // Contratos
            ['name' => 'contratos.index',   'descripcion' => 'Ver todos los Contratos', 'grupo' => 'CONTRATOS'],
            ['name' => 'contratos.create',  'descripcion' => 'Agregar Contratos',       'grupo' => 'CONTRATOS'],
            ['name' => 'contratos.edit',    'descripcion' => 'Editar Contratos',        'grupo' => 'CONTRATOS'],
            ['name' => 'contratos.destroy', 'descripcion' => 'Eliminar Contratos',      'grupo' => 'CONTRATOS'],

            // Usuarios
            ['name' => 'users.index',   'descripcion' => 'Ver todos los Usuarios', 'grupo' => 'USUARIOS'],
            ['name' => 'users.create',  'descripcion' => 'Agregar Usuarios',       'grupo' => 'USUARIOS'],
            ['name' => 'users.edit',    'descripcion' => 'Editar Usuarios',        'grupo' => 'USUARIOS'],
            ['name' => 'users.destroy', 'descripcion' => 'Eliminar Usuarios',      'grupo' => 'USUARIOS'],

            // Roles
            ['name' => 'roles.index',   'descripcion' => 'Ver todos los Roles', 'grupo' => 'ROLES'],
            ['name' => 'roles.create',  'descripcion' => 'Agregar Roles',       'grupo' => 'ROLES'],
            ['name' => 'roles.edit',    'descripcion' => 'Editar Roles',        'grupo' => 'ROLES'],
            ['name' => 'roles.destroy', 'descripcion' => 'Eliminar Roles',      'grupo' => 'ROLES'],

            // Parámetros
            ['name' => 'parametros.index',   'descripcion' => 'Ver todos los Parámetros', 'grupo' => 'PARAMETROS'],
            ['name' => 'parametros.create',  'descripcion' => 'Agregar Parámetros',       'grupo' => 'PARAMETROS'],
            ['name' => 'parametros.edit',    'descripcion' => 'Editar Parámetros',        'grupo' => 'PARAMETROS'],
            ['name' => 'parametros.destroy', 'descripcion' => 'Eliminar Parámetros',      'grupo' => 'PARAMETROS'],

            // Gastos Extras
            ['name' => 'gastos_extras.index',   'descripcion' => 'Ver todos los Gastos Extras', 'grupo' => 'GASTOS_EXTRAS'],
            ['name' => 'gastos_extras.create',  'descripcion' => 'Agregar Gastos Extras',       'grupo' => 'GASTOS_EXTRAS'],
            ['name' => 'gastos_extras.edit',    'descripcion' => 'Editar Gastos Extras',        'grupo' => 'GASTOS_EXTRAS'],
            ['name' => 'gastos_extras.destroy', 'descripcion' => 'Eliminar Gastos Extras',      'grupo' => 'GASTOS_EXTRAS'],

            // Reportes
            ['name' => 'reportes.index',  'descripcion' => 'Ver Reportes',      'grupo' => 'REPORTES'],
            ['name' => 'reportes.export', 'descripcion' => 'Exportar Reportes', 'grupo' => 'REPORTES'],
        ];

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
*/
        // Crear rol superadmin y asignarle todos los permisos
        $role = Role::create([
            'uuid'        => Str::uuid(),
            'name'        => 'superadmin',
            'guard_name'  => 'web',
            'descripcion' => 'Super Administrador',
        ]);

        foreach ($permisos as $p) {
            if (!Permission::where('name', $p['name'])->where('guard_name', 'web')->exists()) {
                Permission::create([
                    'name'        => $p['name'],
                    'descripcion' => $p['descripcion'],
                    'guard_name'  => 'web',
                    'grupo'       => $p['grupo'],
                ]);
            }
        }


        $role = Role::firstOrCreate(
            ['name' => 'superadmin', 'guard_name' => 'web'],
            ['uuid' => Str::uuid(), 'descripcion' => 'Super Administrador']
        );

        $role->givePermissionTo(Permission::all());
    }
}
