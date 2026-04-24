<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    public function run()
    {
        Cliente::create([
            'nombre'     => 'INDUSTRIAS MAMANI S.A.',
            'nit'        => '3210987654',
            'pais'       => 'BOLIVIA',
            'email'      => 'gerencia@industriasmamani.com',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Cliente::create([
            'nombre'     => 'FUNDICION CENTRAL',
            'nit'        => '7894561230',
            'pais'       => 'CHILE',
            'email'      => 'compras@fundicioncentral.cl',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Cliente::create([
            'nombre'     => 'EXPORTADORA PACIFICO',
            'nit'        => '1597534682',
            'pais'       => 'PARAGUAY',
            'email'      => 'exportaciones@pacifico.com.py',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
