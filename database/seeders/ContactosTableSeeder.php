<?php

namespace Database\Seeders;

use App\Models\Contacto;
use App\Models\Cliente;
use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ContactosTableSeeder extends Seeder
{
    public function run()
    {
        $cliente1   = Cliente::find(1);
        $cliente2   = Cliente::find(2);
        $proveedor1 = Proveedor::find(1);
        $proveedor2 = Proveedor::find(2);

        // Contactos de Cliente 1
        $cliente1->contacts()->create([
            'tipo'       => 'telefono',
            'valor'      => '77812345',
            'principal'  => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        $cliente1->contacts()->create([
            'tipo'       => 'direccion',
            'valor'      => 'Av. Montes N° 123, La Paz',
            'principal'  => false,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // Contactos de Cliente 2
        $cliente2->contacts()->create([
            'tipo'       => 'telefono',
            'valor'      => '+56912345678',
            'principal'  => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // Contactos de Proveedor 1
        $proveedor1->contacts()->create([
            'tipo'       => 'telefono',
            'valor'      => '70011223',
            'principal'  => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        $proveedor1->contacts()->create([
            'tipo'       => 'direccion',
            'valor'      => 'Calle Comercio N° 456, El Alto',
            'principal'  => false,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // Contactos de Proveedor 2
        $proveedor2->contacts()->create([
            'tipo'       => 'telefono',
            'valor'      => '+5491155667788',
            'principal'  => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
