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
            $table->string('doc_carnet')->nullable()->after('estado');
            $table->string('doc_licencia')->nullable()->after('doc_carnet');
        });
    }

    public function down(): void
    {
        Schema::table('operadores_transporte', function (Blueprint $table) {
            $table->dropColumn(['doc_carnet', 'doc_licencia']);
        });
    }
};
