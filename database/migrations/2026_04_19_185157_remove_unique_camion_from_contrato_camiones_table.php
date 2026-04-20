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
            $table->dropForeign(['contrato_id']);
            $table->dropForeign(['camion_id']);
            $table->dropUnique(['contrato_id', 'camion_id']);
            $table->foreign('contrato_id')->references('id')->on('contratos')->cascadeOnDelete();
            $table->foreign('camion_id')->references('id')->on('camiones')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('contrato_camiones', function (Blueprint $table) {
            $table->dropForeign(['contrato_id']);
            $table->dropForeign(['camion_id']);
            $table->unique(['contrato_id', 'camion_id']);
            $table->foreign('contrato_id')->references('id')->on('contratos')->cascadeOnDelete();
            $table->foreign('camion_id')->references('id')->on('camiones')->cascadeOnDelete();
        });
    }
};
