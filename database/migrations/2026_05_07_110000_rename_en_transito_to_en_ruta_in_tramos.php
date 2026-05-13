<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Primero ampliar el ENUM para aceptar ambos valores
        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('En tránsito','En ruta','Transbordando','Transbordado','Entregado') NOT NULL DEFAULT 'En ruta'");

        // Migrar registros existentes
        DB::table('tramos')->where('estado', 'En tránsito')->update(['estado' => 'En ruta']);

        // Quitar el valor antiguo del ENUM
        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('En ruta','Transbordando','Transbordado','Entregado') NOT NULL DEFAULT 'En ruta'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('En ruta','En tránsito','Transbordando','Transbordado','Entregado') NOT NULL DEFAULT 'En tránsito'");

        DB::table('tramos')->where('estado', 'En ruta')->update(['estado' => 'En tránsito']);

        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('En tránsito','Transbordando','Transbordado','Entregado') NOT NULL DEFAULT 'En tránsito'");
    }
};
