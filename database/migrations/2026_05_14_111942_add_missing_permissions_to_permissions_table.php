<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        $permisos = [
            //clientes
            ['name' => 'clientes.index',   'descripcion' => 'Ver todos los Clientes', 'grupo' => 'CLIENTES'],
            ['name' => 'clientes.create',  'descripcion' => 'Agregar Clientes',       'grupo' => 'CLIENTES'],
            ['name' => 'clientes.edit',    'descripcion' => 'Editar Clientes',        'grupo' => 'CLIENTES'],
            ['name' => 'clientes.destroy', 'descripcion' => 'Eliminar Clientes',     'grupo' => 'CLIENTES'],
            //proveedores
            ['name' => 'proveedores.index',   'descripcion' => 'Ver todos los Proveedores', 'grupo' => 'PROVEEDORES'],
            ['name' => 'proveedores.create',  'descripcion' => 'Agregar Proveedores',       'grupo' => 'PROVEEDORES'],
            ['name' => 'proveedores.edit',    'descripcion' => 'Editar Proveedores',        'grupo' => 'PROVEEDORES'],
            ['name' => 'proveedores.destroy', 'descripcion' => 'Eliminar Proveedores',     'grupo' => 'PROVEEDORES'],
            // Permisos (módulo de gestión de permisos)
            ['name' => 'permisos.index',   'descripcion' => 'Ver todos los Permisos',  'grupo' => 'PERMISOS'],
            ['name' => 'permisos.create',  'descripcion' => 'Agregar Permisos',        'grupo' => 'PERMISOS'],
            ['name' => 'permisos.edit',    'descripcion' => 'Editar Permisos',         'grupo' => 'PERMISOS'],
            ['name' => 'permisos.destroy', 'descripcion' => 'Eliminar Permisos',       'grupo' => 'PERMISOS'],

            // Conductores
            ['name' => 'conductores.index',   'descripcion' => 'Ver asignaciones de conductores',      'grupo' => 'CONDUCTORES'],
            ['name' => 'conductores.create',  'descripcion' => 'Asignar conductores a camiones',       'grupo' => 'CONDUCTORES'],
            ['name' => 'conductores.edit',    'descripcion' => 'Editar asignaciones de conductores',   'grupo' => 'CONDUCTORES'],
            ['name' => 'conductores.destroy', 'descripcion' => 'Eliminar asignaciones de conductores', 'grupo' => 'CONDUCTORES'],

            // Seguimiento de cargas
            ['name' => 'seguimiento.index', 'descripcion' => 'Ver seguimiento de cargas', 'grupo' => 'SEGUIMIENTO'],

            // Empleados
            ['name' => 'empleados.index',   'descripcion' => 'Ver todos los Empleados', 'grupo' => 'EMPLEADOS'],
            ['name' => 'empleados.create',  'descripcion' => 'Agregar Empleados',       'grupo' => 'EMPLEADOS'],
            ['name' => 'empleados.edit',    'descripcion' => 'Editar Empleados',        'grupo' => 'EMPLEADOS'],
            ['name' => 'empleados.destroy', 'descripcion' => 'Eliminar Empleados',      'grupo' => 'EMPLEADOS'],

            // Bancos y cuentas bancarias
            ['name' => 'bancos.index',   'descripcion' => 'Ver bancos y cuentas bancarias', 'grupo' => 'BANCOS'],
            ['name' => 'bancos.create',  'descripcion' => 'Agregar bancos y cuentas',       'grupo' => 'BANCOS'],
            ['name' => 'bancos.edit',    'descripcion' => 'Editar bancos y cuentas',        'grupo' => 'BANCOS'],
            ['name' => 'bancos.destroy', 'descripcion' => 'Eliminar bancos y cuentas',      'grupo' => 'BANCOS'],

            // Cuentas bancarias
            ['name' => 'cuentas_bancarias.index',   'descripcion' => 'Ver Cuentas Bancarias',      'grupo' => 'CUENTAS_BANCARIAS'],
            ['name' => 'cuentas_bancarias.create',  'descripcion' => 'Agregar Cuentas Bancarias',  'grupo' => 'CUENTAS_BANCARIAS'],
            ['name' => 'cuentas_bancarias.edit',    'descripcion' => 'Editar Cuentas Bancarias',   'grupo' => 'CUENTAS_BANCARIAS'],
            ['name' => 'cuentas_bancarias.destroy', 'descripcion' => 'Eliminar Cuentas Bancarias', 'grupo' => 'CUENTAS_BANCARIAS'],

            // Pagos a clientes
            ['name' => 'pagos_clientes.index',   'descripcion' => 'Ver Pagos de Clientes',       'grupo' => 'PAGOS_CLIENTES'],
            ['name' => 'pagos_clientes.create',  'descripcion' => 'Registrar Pagos de Clientes', 'grupo' => 'PAGOS_CLIENTES'],
            ['name' => 'pagos_clientes.edit',    'descripcion' => 'Editar Pagos de Clientes',    'grupo' => 'PAGOS_CLIENTES'],
            ['name' => 'pagos_clientes.destroy', 'descripcion' => 'Eliminar Pagos de Clientes',  'grupo' => 'PAGOS_CLIENTES'],

            // Pagos a proveedores
            ['name' => 'pagos_proveedores.index',   'descripcion' => 'Ver Pagos a Proveedores',       'grupo' => 'PAGOS_PROVEEDORES'],
            ['name' => 'pagos_proveedores.create',  'descripcion' => 'Registrar Pagos a Proveedores', 'grupo' => 'PAGOS_PROVEEDORES'],
            ['name' => 'pagos_proveedores.edit',    'descripcion' => 'Editar Pagos a Proveedores',    'grupo' => 'PAGOS_PROVEEDORES'],
            ['name' => 'pagos_proveedores.destroy', 'descripcion' => 'Eliminar Pagos a Proveedores',  'grupo' => 'PAGOS_PROVEEDORES'],

            // Pagos a camiones
            ['name' => 'pagos_camiones.index',   'descripcion' => 'Ver Pagos a Camiones',       'grupo' => 'PAGOS_CAMIONES'],
            ['name' => 'pagos_camiones.create',  'descripcion' => 'Registrar Pagos a Camiones', 'grupo' => 'PAGOS_CAMIONES'],
            ['name' => 'pagos_camiones.edit',    'descripcion' => 'Editar Pagos a Camiones',    'grupo' => 'PAGOS_CAMIONES'],
            ['name' => 'pagos_camiones.destroy', 'descripcion' => 'Eliminar Pagos a Camiones',  'grupo' => 'PAGOS_CAMIONES'],

            //gastos extras
            ['name' => 'gastos_extras.index',   'descripcion' => 'Ver Gastos Extras',    'grupo' => 'GASTOS_EXTRAS'],
            ['name' => 'gastos_extras.create',  'descripcion' => 'Registrar Gastos Extras', 'grupo' => 'GASTOS_EXTRAS'],
            ['name' => 'gastos_extras.edit',    'descripcion' => 'Editar Gastos Extras',    'grupo' => 'GASTOS_EXTRAS'],
            ['name' => 'gastos_extras.destroy', 'descripcion' => 'Eliminar Gastos Extras',  'grupo' => 'GASTOS_EXTRAS'],

            //reportes
            ['name' => 'reportes.index',   'descripcion' => 'Ver Reportes',    'grupo' => 'REPORTES'],
            ['name' => 'reportes.export',   'descripcion' => 'Exportar Reportes',    'grupo' => 'REPORTES'],

             //usuarios
             ['name' => 'users.index',   'descripcion' => 'Ver todos los Usuarios', 'grupo' => 'USUARIOS'],
             ['name' => 'users.create',  'descripcion' => 'Agregar Usuarios',       'grupo' => 'USUARIOS'],
             ['name' => 'users.edit',    'descripcion' => 'Editar Usuarios',        'grupo' => 'USUARIOS'],
             ['name' => 'users.destroy', 'descripcion' => 'Eliminar Usuarios',      'grupo' => 'USUARIOS'],
             ['name' => 'users.show',   'descripcion' => 'Ver Perfil de Usuario',    'grupo' => 'USUARIOS'],

             //roles
             ['name' => 'roles.index',   'descripcion' => 'Ver todos los Roles', 'grupo' => 'ROLES'],
             ['name' => 'roles.create',  'descripcion' => 'Agregar Roles',       'grupo' => 'ROLES'],
             ['name' => 'roles.edit',    'descripcion' => 'Editar Roles',        'grupo' => 'ROLES'],
             ['name' => 'roles.destroy', 'descripcion' => 'Eliminar Roles',      'grupo' => 'ROLES'],

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

        $superadmin = Role::where('name', 'superadmin')->first();
        if ($superadmin) {
            $superadmin->givePermissionTo(Permission::all());
        }
    }

    public function down(): void
    {
        $nombres = [
            'clientes.index', 'clientes.create', 'clientes.edit', 'clientes.destroy',
            'proveedores.index', 'proveedores.create', 'proveedores.edit', 'proveedores.destroy',
            'permisos.index', 'permisos.create', 'permisos.edit', 'permisos.destroy',
            'conductores.index', 'conductores.create', 'conductores.edit', 'conductores.destroy',
            'seguimiento.index',
            'empleados.index', 'empleados.create', 'empleados.edit', 'empleados.destroy',
            'bancos.index', 'bancos.create', 'bancos.edit', 'bancos.destroy',
            'cuentas_bancarias.index', 'cuentas_bancarias.create', 'cuentas_bancarias.edit', 'cuentas_bancarias.destroy',
            'pagos_clientes.index', 'pagos_clientes.create', 'pagos_clientes.edit', 'pagos_clientes.destroy',
            'pagos_proveedores.index', 'pagos_proveedores.create', 'pagos_proveedores.edit', 'pagos_proveedores.destroy',
            'pagos_camiones.index', 'pagos_camiones.create', 'pagos_camiones.edit', 'pagos_camiones.destroy',
            'gastos_extras.index', 'gastos_extras.create', 'gastos_extras.edit', 'gastos_extras.destroy',
            'reportes.index', 'reportes.export',
        ];

        Permission::whereIn('name', $nombres)->where('guard_name', 'web')->delete();
    }
};
