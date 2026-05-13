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
        Schema::table('tramos', function (Blueprint $table) {
            $table->decimal('descuento_porcentaje', 5, 2)->nullable()->after('peso_llegada')
                  ->comment('% de descuento aplicado al pago del camionero por calidad de carga');
            $table->text('observaciones_llegada')->nullable()->after('descuento_porcentaje');
        });
    }

    public function down(): void
    {
        Schema::table('tramos', function (Blueprint $table) {
            $table->dropColumn(['descuento_porcentaje', 'observaciones_llegada']);
        });
    }
};
