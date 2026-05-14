<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('En ruta','Transbordando','Transbordado','Entregado','Entrega Parcial','Desactivado') NOT NULL DEFAULT 'En ruta'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('En ruta','Transbordando','Transbordado','Entregado','Desactivado') NOT NULL DEFAULT 'En ruta'");
    }
};
