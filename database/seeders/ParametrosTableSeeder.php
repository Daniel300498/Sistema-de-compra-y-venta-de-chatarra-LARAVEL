<?php

namespace Database\Seeders;

use App\Models\Parametro;
use Illuminate\Database\Seeder;

class ParametrosTableSeeder extends Seeder
{
    public function run()
    {
        // Grupos del sistema
        Parametro::create(['tipo' => 'grupos', 'descripcion' => 'ADMINISTRACION']);
        Parametro::create(['tipo' => 'grupos', 'descripcion' => 'PROVEEDORES']);
        Parametro::create(['tipo' => 'grupos', 'descripcion' => 'CLIENTES']);

        // Países
        Parametro::create(['tipo' => 'paises', 'descripcion' => 'BOLIVIA']);
        Parametro::create(['tipo' => 'paises', 'descripcion' => 'BRASIL']);
        Parametro::create(['tipo' => 'paises', 'descripcion' => 'CHILE']);
        Parametro::create(['tipo' => 'paises', 'descripcion' => 'ARGENTINA']);
        Parametro::create(['tipo' => 'paises', 'descripcion' => 'PARAGUAY']);

        // Lugar de expedición CI
        Parametro::create(['tipo' => 'lugar_ci', 'descripcion' => 'LP']);
        Parametro::create(['tipo' => 'lugar_ci', 'descripcion' => 'CB']);
        Parametro::create(['tipo' => 'lugar_ci', 'descripcion' => 'SC']);
        Parametro::create(['tipo' => 'lugar_ci', 'descripcion' => 'OR']);
        Parametro::create(['tipo' => 'lugar_ci', 'descripcion' => 'PT']);
        Parametro::create(['tipo' => 'lugar_ci', 'descripcion' => 'TA']);
        Parametro::create(['tipo' => 'lugar_ci', 'descripcion' => 'BN']);
        Parametro::create(['tipo' => 'lugar_ci', 'descripcion' => 'PD']);
        Parametro::create(['tipo' => 'lugar_ci', 'descripcion' => 'CH']);
    }
}
