<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operadores_transporte', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nombre', 150);
            $table->string('apellido', 150);
            $table->string('ci', 20)->unique()->comment('Cédula de identidad');
            $table->string('telefono', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->enum('tipo_operador', ['propietario', 'chofer', 'ambos'])->default('chofer');
            $table->string('licencia_numero', 30)->nullable()->comment('Requerido si tipo_operador es chofer o ambos');
            $table->enum('licencia_categoria', ['A', 'B', 'C', 'D', 'E', 'F', 'G'])->nullable();
            $table->date('licencia_vencimiento')->nullable();
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
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
        Schema::dropIfExists('operadores_transporte');
    }
};
