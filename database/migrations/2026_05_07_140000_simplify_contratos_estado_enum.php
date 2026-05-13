<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ampliar primero para aceptar ambos conjuntos durante la transición
        DB::statement("ALTER TABLE contratos MODIFY estado ENUM('Borrador','Activo','Finalizado','Cancelado','Concluido') NOT NULL DEFAULT 'Activo'");

        // Migrar valores anteriores → Activo
        DB::table('contratos')->whereIn('estado', ['Borrador', 'Finalizado', 'Cancelado'])->update(['estado' => 'Activo']);

        // Dejar solo los dos estados nuevos
        DB::statement("ALTER TABLE contratos MODIFY estado ENUM('Activo','Concluido') NOT NULL DEFAULT 'Activo'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE contratos MODIFY estado ENUM('Activo','Concluido','Borrador','Finalizado','Cancelado') NOT NULL DEFAULT 'Borrador'");
        DB::statement("ALTER TABLE contratos MODIFY estado ENUM('Borrador','Activo','Finalizado','Cancelado') NOT NULL DEFAULT 'Borrador'");
    }
};
