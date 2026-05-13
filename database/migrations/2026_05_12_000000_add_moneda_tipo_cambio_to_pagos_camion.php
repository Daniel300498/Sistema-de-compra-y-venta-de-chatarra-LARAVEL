<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pagos_camion', function (Blueprint $table) {
            $table->string('moneda_pago', 10)->default('BOB')->after('monto');
            // Tipo de cambio respecto al boliviano (1 BOB = 1 siempre; BRL, USD, etc. según el día)
            $table->decimal('tipo_cambio', 10, 4)->default(1)->after('moneda_pago');
        });
    }

    public function down(): void
    {
        Schema::table('pagos_camion', function (Blueprint $table) {
            $table->dropColumn(['moneda_pago', 'tipo_cambio']);
        });
    }
};
