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
    
        // Bancos de Bolivia
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO CENTRAL DE BOLIVIA']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO UNIÓN S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO NACIONAL DE BOLIVIA S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO MERCANTIL SANTA CRUZ S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO BISA S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO DE CRÉDITO DE BOLIVIA S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO ECONÓMICO S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO GANADERO S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO FIE S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO FORTALEZA S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO PYME ECOFUTURO S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO PYME DE LA COMUNIDAD S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCO PRODEM S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'BANCOSOL S.A.']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'DIACONÍA IFD']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'CIDRE IFD']);
        Parametro::create(['tipo' => 'bancos', 'descripcion' => 'CRECER IFD']);
    }
}
