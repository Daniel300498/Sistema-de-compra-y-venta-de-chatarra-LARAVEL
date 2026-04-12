<?php

namespace Database\Seeders;

use App\Models\Feriado;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeriadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feriado::create(['nombre'=>'AÑO NUEVO','fecha'=>'2024-01-01','anual'=>true]);
        Feriado::create(['nombre'=>'DIA DEL ESTADO PLURINACIONAL','fecha'=>'2024-01-22','anual'=>true]);
        Feriado::create(['nombre'=>'CARNAVAL','fecha'=>'2024-02-12','anual'=>false]);
        Feriado::create(['nombre'=>'CARNAVAL','fecha'=>'2024-02-13','anual'=>false]);
        Feriado::create(['nombre'=>'VIERNES SANTO','fecha'=>'2024-03-29','anual'=>false]);
        Feriado::create(['nombre'=>'DIA DEL TRABAJO','fecha'=>'2024-05-01','anual'=>true]);
        Feriado::create(['nombre'=>'CORPUS CHRISTI','fecha'=>'2024-05-30','anual'=>false]);
        Feriado::create(['nombre'=>'AÑO NUEVO AYMARA','fecha'=>'2024-06-21','anual'=>true]);
        Feriado::create(['nombre'=>'DIA DE LA INDEPENDENCIA','fecha'=>'2024-08-06','anual'=>true]);
        Feriado::create(['nombre'=>'DIA DE TODOS LOS DIFUNTOS','fecha'=>'2024-11-02','anual'=>true]);
        Feriado::create(['nombre'=>'NAVIDAD','fecha'=>'2024-12-25','anual'=>true]);
    }
}
