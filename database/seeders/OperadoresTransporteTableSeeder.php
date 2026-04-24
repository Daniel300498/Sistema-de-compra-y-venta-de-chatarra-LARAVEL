<?php

namespace Database\Seeders;

use App\Models\OperadorTransporte;
use Illuminate\Database\Seeder;

class OperadoresTransporteTableSeeder extends Seeder
{
    public function run()
    {
        // Propietario (sin licencia requerida)
        OperadorTransporte::create([
            'nombre'             => 'JUAN CARLOS',
            'apellido'           => 'MAMANI QUISPE',
            'ci'                 => '4512367',
            'telefono'           => '76543210',
            'email'              => 'jcmamani@gmail.com',
            'direccion'          => 'Villa Fátima, La Paz',
            'tipo_operador'      => 'propietario',
            'estado'             => 'Activo',
            'created_by'         => 1,
            'updated_by'         => 1,
        ]);

        // Chofer con licencia
        OperadorTransporte::create([
            'nombre'               => 'PEDRO',
            'apellido'             => 'FLORES CONDORI',
            'ci'                   => '7823456',
            'telefono'             => '71234567',
            'email'                => 'pflores@gmail.com',
            'direccion'            => 'El Alto, zona Villa Adela',
            'tipo_operador'        => 'chofer',
            'licencia_numero'      => 'LC-78234',
            'licencia_categoria'   => 'C',
            'licencia_vencimiento' => '2027-06-30',
            'estado'               => 'Activo',
            'created_by'           => 1,
            'updated_by'           => 1,
        ]);

        // Propietario y chofer a la vez
        OperadorTransporte::create([
            'nombre'               => 'MARIA',
            'apellido'             => 'CHOQUE LAURA',
            'ci'                   => '6234789',
            'telefono'             => '68901234',
            'email'                => null,
            'direccion'            => 'Cochabamba, Quillacollo',
            'tipo_operador'        => 'ambos',
            'licencia_numero'      => 'LC-62347',
            'licencia_categoria'   => 'B',
            'licencia_vencimiento' => '2026-12-15',
            'estado'               => 'Activo',
            'created_by'           => 1,
            'updated_by'           => 1,
        ]);
    }
}
