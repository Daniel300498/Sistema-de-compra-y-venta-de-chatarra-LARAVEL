<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        //Clientes
        Permission::create(['descripcion'=>'Ver todos los Proveedores','name'=>'proveedores.index']);
        Permission::create(['descripcion'=>'Agregar Proveedores','name'=>'proveedores.create']);
        Permission::create(['descripcion'=>'Editar Proveedores','name'=>'proveedores.edit']);
        Permission::create(['descripcion'=>'Eliminar Proveedores','name'=>'proveedores.destroy']);

        //Proveedores
        Permission::create(['descripcion'=>'Ver todos los clientes','name'=>'clientes.index']);
        Permission::create(['descripcion'=>'Agregar Clientes','name'=>'clientes.create']);
        Permission::create(['descripcion'=>'Editar Clientes','name'=>'clientes.edit']);
        Permission::create(['descripcion'=>'Eliminar Clientes','name'=>'clientes.destroy']);

    }
}
