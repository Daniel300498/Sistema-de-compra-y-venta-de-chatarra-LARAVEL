<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contrato_camiones', function (Blueprint $table) {
            $table->enum('estado_entrega', ['Pendiente', 'Entregado'])
                  ->default('Pendiente')
                  ->after('toneladas')
                  ->comment('Estado de entrega de las toneladas al cliente');
        });
    }

    public function down(): void
    {
        Schema::table('contrato_camiones', function (Blueprint $table) {
            $table->dropColumn('estado_entrega');
        });
    }
};
