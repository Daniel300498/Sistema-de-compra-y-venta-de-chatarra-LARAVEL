<?php

namespace Database\Seeders;

use App\Models\Contrato;
use Illuminate\Database\Seeder;

class ContratosTableSeeder extends Seeder
{
    public function run()
    {
        Contrato::create([
            'numero_contrato'  => 'CTR-2026-001',
            'tipo_contrato'    => 'Nacional',
            'cliente_id'       => 1,
            'proveedor_id'     => 1,
            'fecha_inicio'     => '2026-01-01',
            'fecha_fin'        => '2026-12-31',
            'cantidad_camiones' => 3,
            'monto_total'      => 150000.00,
            'moneda'           => 'BOB',
            'estado'           => 'Activo',
            'created_by'       => 1,
            'updated_by'       => 1,
        ]);

        Contrato::create([
            'numero_contrato'  => 'CTR-2026-002',
            'tipo_contrato'    => 'Internacional',
            'cliente_id'       => 2,
            'proveedor_id'     => 2,
            'fecha_inicio'     => '2026-02-01',
            'fecha_fin'        => '2026-08-31',
            'cantidad_camiones' => 5,
            'monto_total'      => 320000.00,
            'moneda'           => 'USD',
            'estado'           => 'Activo',
            'created_by'       => 1,
            'updated_by'       => 1,
        ]);

        Contrato::create([
            'numero_contrato'  => 'CTR-2026-003',
            'tipo_contrato'    => 'Nacional',
            'cliente_id'       => 3,
            'proveedor_id'     => 3,
            'fecha_inicio'     => '2026-03-15',
            'fecha_fin'        => null,
            'cantidad_camiones' => 2,
            'monto_total'      => 85000.00,
            'moneda'           => 'BOB',
            'estado'           => 'Borrador',
            'created_by'       => 1,
            'updated_by'       => 1,
        ]);
    }
}
