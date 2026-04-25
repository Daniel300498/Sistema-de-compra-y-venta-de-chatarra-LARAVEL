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
