<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE contrato_camiones MODIFY estado_entrega ENUM('Pendiente','Entregado','Desactivado') NOT NULL DEFAULT 'Pendiente'");
    }

    public function down(): void
    {
        DB::statement("UPDATE contrato_camiones SET estado_entrega = 'Pendiente' WHERE estado_entrega = 'Desactivado'");
        DB::statement("ALTER TABLE contrato_camiones MODIFY estado_entrega ENUM('Pendiente','Entregado') NOT NULL DEFAULT 'Pendiente'");
    }
};
