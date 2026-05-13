<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('cuentas_bancarias', 'tipo_relacion')) {
            Schema::table('cuentas_bancarias', function (Blueprint $table) {
                $table->string('tipo_relacion', 50)->nullable()->after('nombre_titular_cuenta')
                    ->comment('Relación del titular de la cuenta con el titular principal');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('cuentas_bancarias', 'tipo_relacion')) {
            Schema::table('cuentas_bancarias', function (Blueprint $table) {
                $table->dropColumn('tipo_relacion');
            });
        }
    }
};
