<?php

namespace Database\Seeders;

use App\Models\Parametro;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParametrosTableSeeder extends Seeder
{
   
    public function run()
    {
        Parametro::create(['tipo'=>'tipo_lactancia','descripcion'=>'PRENATAL']);
        Parametro::create(['tipo'=>'tipo_lactancia','descripcion'=>'POSTNATAL']);

        Parametro::create(['tipo'=>'lactancia_bono_monto','descripcion'=>'BONO LACTANCIA','valor'=>'2000.0']);

        Parametro::create(['tipo'=>'estado_orden_salida','descripcion'=>'ACEPTADO']);
        Parametro::create(['tipo'=>'estado_orden_salida','descripcion'=>'PENDIENTE']);
        Parametro::create(['tipo'=>'estado_orden_salida','descripcion'=>'ANULADO']);
        Parametro::create(['tipo'=>'tipo_orden','descripcion'=>'SALIDA OFICIAL']);
        Parametro::create(['tipo'=>'tipo_orden','descripcion'=>'SALIDA PARTICULAR']);
        Parametro::create(['tipo'=>'horario_orden_salida','descripcion'=>'DIA COMPLETO']);
        Parametro::create(['tipo'=>'horario_orden_salida','descripcion'=>'MEDIO DIA (MAÑANA)']);
        Parametro::create(['tipo'=>'horario_orden_salida','descripcion'=>'MEDIO DIA (TARDE)']);
        Parametro::create(['tipo'=>'horario_orden_salida','descripcion'=>'OTROS']);


        
        
        
    }
}
