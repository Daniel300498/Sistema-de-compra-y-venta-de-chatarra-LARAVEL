<?php

namespace Database\Seeders;

use App\Models\Camion;
use Illuminate\Database\Seeder;

class CamionesTableSeeder extends Seeder
{
    public function run()
    {
        // Propietario id=1 (JUAN CARLOS MAMANI), sin chofer asignado aún
        Camion::create([
            'placa'          => 'ABC-1234',
            'tipo_vehiculo'  => 'CAMION VOLQUETA',
            'marca'          => 'VOLVO',
            'modelo'         => 'FH 460',
            'anio'           => 2018,
            'capacidad_kg'   => 20000.00,
            'color'          => 'BLANCO',
            'estado'         => 'Activo',
            'propietario_id' => 1,
            'created_by'     => 1,
            'updated_by'     => 1,
        ]);

        Camion::create([
            'placa'          => 'XYZ-5678',
            'tipo_vehiculo'  => 'CAMION PLATAFORMA',
            'marca'          => 'MERCEDES BENZ',
            'modelo'         => 'ACTROS 2545',
            'anio'           => 2020,
            'capacidad_kg'   => 25000.00,
            'color'          => 'ROJO',
            'estado'         => 'Activo',
            'propietario_id' => 1,
            'created_by'     => 1,
            'updated_by'     => 1,
        ]);

        // Propietaria id=3 (MARIA CHOQUE), propietaria y conductora
        Camion::create([
            'placa'          => 'QRS-9012',
            'tipo_vehiculo'  => 'CAMION TOLVA',
            'marca'          => 'SCANIA',
            'modelo'         => 'R 450',
            'anio'           => 2019,
            'capacidad_kg'   => 18000.00,
            'color'          => 'AZUL',
            'estado'         => 'Activo',
            'propietario_id' => 3,
            'created_by'     => 1,
            'updated_by'     => 1,
        ]);
    }
}
