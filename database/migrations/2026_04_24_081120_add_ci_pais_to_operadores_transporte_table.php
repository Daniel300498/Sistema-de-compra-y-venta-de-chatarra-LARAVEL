<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('operadores_transporte', function (Blueprint $table) {
            $table->string('ci_pais', 100)->nullable()->after('ci')->comment('País de expedición del documento de identidad');
        });
    }

    public function down(): void
    {
        Schema::table('operadores_transporte', function (Blueprint $table) {
            $table->dropColumn('ci_pais');
        });
    }
};
