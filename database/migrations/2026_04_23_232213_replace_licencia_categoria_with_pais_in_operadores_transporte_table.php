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
        Schema::table('operadores_transporte', function (Blueprint $table) {
            $table->dropColumn('licencia_categoria');
            $table->string('licencia_pais', 100)->nullable()->after('licencia_numero');
        });
    }

    public function down(): void
    {
        Schema::table('operadores_transporte', function (Blueprint $table) {
            $table->dropColumn('licencia_pais');
            $table->enum('licencia_categoria', ['A','B','C','D','E','F','G'])->nullable()->after('licencia_numero');
        });
    }
};
