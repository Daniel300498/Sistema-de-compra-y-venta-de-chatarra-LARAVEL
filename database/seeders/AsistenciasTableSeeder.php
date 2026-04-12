<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Asistencia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AsistenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $empleados=Empleado::all();
        foreach ($empleados as $empleado) {
            Asistencia::create([
                'empleado_id'=>$empleado->id,'gestion'=>'2024'
                ,'enero'=>$faker->numberBetween(14320, 14400)
                ,'febrero'=>$faker->numberBetween(14320, 14400)
                ,'marzo'=>$faker->numberBetween(14320, 14400)
                ,'abril'=>$faker->numberBetween(14320, 14400)
                ,'mayo'=>$faker->numberBetween(14320, 14400)
            ]);
        }
    }
}
