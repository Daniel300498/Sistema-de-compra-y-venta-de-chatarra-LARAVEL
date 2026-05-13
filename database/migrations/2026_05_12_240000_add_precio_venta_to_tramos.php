<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tramos', function (Blueprint $table) {
            $table->decimal('precio_por_tonelada', 10, 4)->nullable()->after('peso_llegada')
                ->comment('Precio acordado con el cliente por tonelada entregada');
            $table->string('moneda_venta', 10)->nullable()->after('precio_por_tonelada')
                ->comment('Moneda en que se acordó el precio de venta');
        });
    }

    public function down(): void
    {
        Schema::table('tramos', function (Blueprint $table) {
            $table->dropColumn(['precio_por_tonelada', 'moneda_venta']);
        });
    }
};
