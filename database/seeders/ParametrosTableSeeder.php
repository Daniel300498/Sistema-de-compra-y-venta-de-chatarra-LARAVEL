<?php

namespace Database\Seeders;

use App\Models\Parametro;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParametrosTableSeeder extends Seeder
{
   
    public function run()
    {
        /*Parametro::create(['tipo'=>'tipo_cargo','descripcion'=>'ITEM']);
        Parametro::create(['tipo'=>'tipo_cargo','descripcion'=>'PASANTE']);
        Parametro::create(['tipo'=>'tipo_cargo','descripcion'=>'CONSULTOR INDIVIDUAL DE LINEA']);
        Parametro::create(['tipo'=>'tipo_cargo','descripcion'=>'CONSULTOR POR PROGRAMA']);
        Parametro::create(['tipo'=>'tipo_cargo','descripcion'=>'PERSONAL EVENTUAL']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'SOLTERO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'CASADO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'CONCUBINO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'SEPARADO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'DIVORCIADO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'VIUDO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'UNION LIBRE']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'CH']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'LP']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'CB']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'OR']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'PT']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'TA']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'SC']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'BN']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'PD']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'PROFESIONAL A NIVEL LICENCIATURA CON TITULO EN PROVICION NACIONAL']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'PROFESIONAL A NIVEL LICENCIATURA']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'TECNICO SUPERIOR']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'EGRESADO UNIVERSIDAD']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'TECNICO MEDIO']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'ESTUDIANTE UNIVERSIDAD 5TO SEM']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'BACHILLER EN HUMANIDADES']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'EDUCACIÓN PRIMARIA']);
        Parametro::create(['tipo'=>'banco','descripcion'=>'BANCO UNION']);
        Parametro::create(['tipo'=>'banco','descripcion'=>'BANCO BISA']);
        Parametro::create(['tipo'=>'banco','descripcion'=>'BANCO MERCANTIL SANTA CRUZ']);
        Parametro::create(['tipo'=>'banco','descripcion'=>'BANCO GANADERO']);
        Parametro::create(['tipo'=>'afp','descripcion'=>'GESTORA PUBLICA']);
        Parametro::create(['tipo'=>'seguro_salud','descripcion'=>'CAJA NACIONAL DE SALUD']);
        Parametro::create(['tipo'=>'seguro_salud','descripcion'=>'CAJA PETROLERA DE SALUD']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD MAYOR DE SAN ANDRÉS']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD PÚBLICA DE EL ALTO']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD MAYOR DE SAN SIMÓN']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD AUTÓNOMA GABRIEL RENÉ MORENO']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD AMAZÓNICA DE PANDO']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD AUTÓNOMA TOMÁS FRÍAS']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD TÉCNICA DE ORURO']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD MAYOR REAL Y PONTIFICIA DE SAN FRANCISCO XAVIER']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD NACIONAL SIGLO XX']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD AUTÓNOMA DEL BENI JOSÉ BALLIVIÁN']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD AUTÓNOMA JUAN MISAEL SARACHO']);
        
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'MATRIMONIO']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'RIP']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'NACIMIENTO']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'FALLECIMIENTO']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'CENSO']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'OTROS']);
        Parametro::create(['tipo'=>'estado_licencia','descripcion'=>'ACEPTADO']);
        Parametro::create(['tipo'=>'estado_licencia','descripcion'=>'PENDIENTE']);
        Parametro::create(['tipo'=>'estado_licencia','descripcion'=>'DENEGADO']);
        Parametro::create(['tipo'=>'tipo_licencia','descripcion'=>'SIN GOCE']);
        Parametro::create(['tipo'=>'tipo_licencia','descripcion'=>'CON GOCE']);
        Parametro::create(['tipo'=>'tipo_licencia','descripcion'=>'VACACION']);*/
        Parametro::create(['tipo'=>'lugar_trabajo','descripcion'=>'CENTRAL']);
        Parametro::create(['tipo'=>'lugar_trabajo','descripcion'=>'CAMPO FERIAL']);
        Parametro::create(['tipo'=>'lugar_trabajo','descripcion'=>'CASA GALLARDO']);
        Parametro::create(['tipo'=>'lugar_trabajo','descripcion'=>'COLISEO']);
        Parametro::create(['tipo'=>'lugar_trabajo','descripcion'=>'PISCINA OLIMPICA']);
        Parametro::create(['tipo'=>'lugar_trabajo','descripcion'=>'SANTA ISABEL']);
        Parametro::create(['tipo'=>'lugar_trabajo','descripcion'=>'SDIPOP']);
        Parametro::create(['tipo'=>'lugar_trabajo','descripcion'=>'SEDEDE']);
        Parametro::create(['tipo'=>'lugar_trabajo','descripcion'=>'TERMINAL INTERPROVINCIAL']);
        Parametro::create(['tipo'=>'lugar_trabajo','descripcion'=>'VILLA FATIMA']);
        
        
        
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'MATRIMONIO']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'RIP']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'NACIMIENTO']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'FALLECIMIENTO']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'PATERNIDAD']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'BAJA MEDICA']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'CENSO']);
        Parametro::create(['tipo'=>'tipo_motivo_licencia','descripcion'=>'OTROS']);
        Parametro::create(['tipo'=>'estado_licencia','descripcion'=>'ACEPTADO']);
        Parametro::create(['tipo'=>'estado_licencia','descripcion'=>'PENDIENTE']);
        Parametro::create(['tipo'=>'estado_licencia','descripcion'=>'DENEGADO']);
        Parametro::create(['tipo'=>'tipo_licencia','descripcion'=>'SIN GOCE']);
        Parametro::create(['tipo'=>'tipo_licencia','descripcion'=>'CON GOCE']);
        Parametro::create(['tipo'=>'tipo_licencia','descripcion'=>'VACACION']);
        Parametro::create(['tipo'=>'tipo_licencia','descripcion'=>'ESPECIAL']);
        Parametro::create(['tipo'=>'horario_licencia','descripcion'=>'DIA COMPLETO']);
        Parametro::create(['tipo'=>'horario_licencia','descripcion'=>'MEDIO DIA (MAÑANA)']);
        Parametro::create(['tipo'=>'horario_licencia','descripcion'=>'MEDIO DIA (TARDE)']);
        Parametro::create(['tipo'=>'enfermedad_licencia_especial','descripcion'=>'CANCER INFANTIL O ADOLESCENTE']);
        Parametro::create(['tipo'=>'enfermedad_licencia_especial','descripcion'=>'ENFERMEDAD SISTEMICA QUE REQUIERE TRANSPLANTE']);
        Parametro::create(['tipo'=>'enfermedad_licencia_especial','descripcion'=>'ENFERMEDAD NEUROLOGICA QUE REQUIERE TRATAMIENTO QUIRURGICO']);
        Parametro::create(['tipo'=>'enfermedad_licencia_especial','descripcion'=>'INSUFICIENCIA RENAL CRONICA']);
        Parametro::create(['tipo'=>'enfermedad_licencia_especial','descripcion'=>'ENFERMEDAD OSTEOARTICULAR QUE REQUIERE TRATAMIENTO QUIRURGICO Y REHABILITACION']);
        Parametro::create(['tipo'=>'enfermedad_licencia_especial','descripcion'=>'DISCAPACIDAD GRAVE Y MUY GRAVE']);
        Parametro::create(['tipo'=>'enfermedad_licencia_especial','descripcion'=>'ACCIDENTE GRAVE CON RIESGO DE MUERTE O SECUELA FUNCIONAL SEVERA Y PERMANENTE']);
        Parametro::create(['tipo'=>'enfermedad_licencia_especial','descripcion'=>'ACCIDENTE GRAVE']);
        Parametro::create(['tipo'=>'tratamiento_licencia_especial_cancer','descripcion'=>'TRATAMIENTO DEL CANCER']);
        Parametro::create(['tipo'=>'tratamiento_licencia_especial_transplante_otros','descripcion'=>'PREVIO A LA INTERVENCION QUIRURGICA']);
        Parametro::create(['tipo'=>'tratamiento_licencia_especial_transplante_otros','descripcion'=>'DIA DE LA INTERVENCION QUIRURGICA']);
        Parametro::create(['tipo'=>'tratamiento_licencia_especial_transplante_otros','descripcion'=>'POSTERIOR A LA INTERVENCION QUIRURGICA']);
        Parametro::create(['tipo'=>'tratamiento_licencia_especial_insuficiencia','descripcion'=>'HEMODIALISIS']);
        Parametro::create(['tipo'=>'tratamiento_licencia_especial_insuficiencia','descripcion'=>'ESTADO TERMINAL DEL NIÑO/A ADOLESCENTE']);
        Parametro::create(['tipo'=>'tratamiento_licencia_especial_discapacidad','descripcion'=>'ATENCIÓN EN SALUD NIÑO/A ADOLESCENTE']);
        Parametro::create(['tipo'=>'tratamiento_licencia_especial_accidente_muy_grave','descripcion'=>'ATENCIÓN EN SALUD POSTERIOR AL ACCIDENTE O SECUELA']);
        Parametro::create(['tipo'=>'tratamiento_licencia_especial_accidente_grave','descripcion'=>'ATENCIÓN EN SALUD POSTERIOR AL ACCIDENTE']);

        
                
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
