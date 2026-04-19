<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('camiones', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('placa', 20)->unique();
            $table->string('tipo_vehiculo', 100);
            $table->string('marca', 100);
            $table->string('modelo', 100);
            $table->year('anio');
            $table->decimal('capacidad_kg', 10, 2);
            $table->string('color', 50)->nullable();
            $table->enum('estado', ['Activo', 'Inactivo', 'En mantenimiento'])->default('Activo');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('camiones');
    }
};
