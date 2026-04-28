<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('Pendiente', 'En tránsito', 'En frontera', 'Transbordado', 'Entregado') DEFAULT 'Pendiente'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('Pendiente', 'En tránsito', 'En frontera', 'Entregado') DEFAULT 'Pendiente'");
    }
};
