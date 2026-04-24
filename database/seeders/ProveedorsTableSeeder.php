<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorsTableSeeder extends Seeder
{
    public function run()
    {
        Proveedor::create([
            'nombre'        => 'CHATARRA DEL NORTE S.R.L.',
            'nit'           => '1234567890',
            'pais'          => 'BOLIVIA',
            'email'         => 'contacto@chatarranorte.com',
            'tipo_producto' => 'HIERRO Y ACERO',
            'created_by'    => 1,
            'updated_by'    => 1,
        ]);

        Proveedor::create([
            'nombre'        => 'METALES DEL SUR LTDA.',
            'nit'           => '9876543210',
            'pais'          => 'ARGENTINA',
            'email'         => 'ventas@metalesdelsur.com',
            'tipo_producto' => 'ALUMINIO Y COBRE',
            'created_by'    => 1,
            'updated_by'    => 1,
        ]);

        Proveedor::create([
            'nombre'        => 'RECICLAJES ORIENTE',
            'nit'           => '4561237890',
            'pais'          => 'BRASIL',
            'email'         => 'info@reciclajesoriente.com',
            'tipo_producto' => 'CHATARRA MIXTA',
            'created_by'    => 1,
            'updated_by'    => 1,
        ]);
    }
}
