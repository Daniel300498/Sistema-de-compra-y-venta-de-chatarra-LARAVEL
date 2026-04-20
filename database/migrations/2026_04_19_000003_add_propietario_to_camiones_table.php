<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('camiones', function (Blueprint $table) {
            $table->unsignedBigInteger('propietario_id')->nullable()->after('estado');
            $table->foreign('propietario_id')->references('id')->on('operadores_transporte')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('camiones', function (Blueprint $table) {
            $table->dropForeign(['propietario_id']);
            $table->dropColumn('propietario_id');
        });
    }
};
