<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('cuentas_bancarias', 'nombre_titular_cuenta')) {
            Schema::table('cuentas_bancarias', function (Blueprint $table) {
                $table->string('nombre_titular_cuenta', 150)->nullable()->after('alias')
                    ->comment('Nombre real del titular de la cuenta (puede ser familiar del operador)');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('cuentas_bancarias', 'nombre_titular_cuenta')) {
            Schema::table('cuentas_bancarias', function (Blueprint $table) {
                $table->dropColumn('nombre_titular_cuenta');
            });
        }
    }
};
