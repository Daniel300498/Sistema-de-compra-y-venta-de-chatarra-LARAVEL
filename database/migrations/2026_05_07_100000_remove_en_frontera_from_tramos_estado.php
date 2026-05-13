<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Migrar registros existentes con 'En frontera' → 'Transbordando'
        DB::statement("UPDATE tramos SET estado = 'Transbordando' WHERE estado = 'En frontera'");

        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('En tránsito','Transbordando','Transbordado','Entregado') NOT NULL DEFAULT 'En tránsito'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('En tránsito','En frontera','Transbordando','Transbordado','Entregado') NOT NULL DEFAULT 'En tránsito'");
    }
};
