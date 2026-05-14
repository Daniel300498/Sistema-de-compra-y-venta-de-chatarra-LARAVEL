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
