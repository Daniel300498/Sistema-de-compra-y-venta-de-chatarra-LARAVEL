<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contrato_camiones', function (Blueprint $table) {
            $table->string('moneda_flete', 10)->default('BOB')->after('monto_acordado');
        });
    }

    public function down(): void
    {
        Schema::table('contrato_camiones', function (Blueprint $table) {
            $table->dropColumn('moneda_flete');
        });
    }
};
