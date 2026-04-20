<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->decimal('toneladas_contrato', 10, 3)
                ->nullable()
                ->after('cantidad_camiones')
                ->comment('Total de toneladas pactadas en el contrato');
        });
    }

    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropColumn('toneladas_contrato');
        });
    }
};
