<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE cuentas_bancarias MODIFY tipo_titular ENUM('proveedor','operador','empleado','cliente')");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE cuentas_bancarias MODIFY tipo_titular ENUM('proveedor','operador','empleado')");
    }
};
