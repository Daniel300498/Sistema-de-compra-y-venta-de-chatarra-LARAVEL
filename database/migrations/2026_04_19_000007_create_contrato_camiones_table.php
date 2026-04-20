<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contrato_camiones', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('contrato_id');
            $table->unsignedBigInteger('camion_id');
            $table->decimal('toneladas', 10, 3)->comment('Toneladas asignadas a este camión en el contrato');
            $table->unsignedBigInteger('conductor_id')->nullable()->comment('Conductor asignado para este contrato');
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('contrato_id')->references('id')->on('contratos')->cascadeOnDelete();
            $table->foreign('camion_id')->references('id')->on('camiones')->cascadeOnDelete();
            $table->foreign('conductor_id')->references('id')->on('operadores_transporte')->nullOnDelete();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            // Un camión no puede estar dos veces en el mismo contrato
            $table->unique(['contrato_id', 'camion_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contrato_camiones');
    }
};
