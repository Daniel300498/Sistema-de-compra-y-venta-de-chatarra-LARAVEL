<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('En tránsito','En frontera','Transbordando','Transbordado','Entregado')");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tramos MODIFY estado ENUM('En tránsito','En frontera','Transbordado','Entregado')");
    }
};
