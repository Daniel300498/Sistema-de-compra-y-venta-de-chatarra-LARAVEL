<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tramos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            // Pertenece a una asignación camión-contrato
            $table->unsignedBigInteger('contrato_camion_id');
            $table->foreign('contrato_camion_id')->references('id')->on('contrato_camiones')->cascadeOnDelete();

            // Transbordo: si este tramo nació de otro tramo (división en frontera)
            $table->unsignedBigInteger('tramo_padre_id')->nullable();
            $table->foreign('tramo_padre_id')->references('id')->on('tramos')->nullOnDelete();

            // Camión y conductor que hacen este tramo
            $table->unsignedBigInteger('camion_id');
            $table->foreign('camion_id')->references('id')->on('camiones');
            $table->unsignedBigInteger('conductor_id')->nullable();
            $table->foreign('conductor_id')->references('id')->on('operadores_transporte')->nullOnDelete();

            // Puntos del tramo
            $table->string('origen', 150);
            $table->string('destino', 150);
            $table->enum('tipo_tramo', ['Internacional', 'Nacional'])->default('Nacional');

            // Pesos en cada punto
            $table->decimal('peso_declarado', 10, 3)->nullable()->comment('Lo que declara el proveedor, solo en tramo origen');
            $table->decimal('peso_salida',    10, 3)->nullable()->comment('Pesado al cargar el camión');
            $table->decimal('peso_llegada',   10, 3)->nullable()->comment('Pesado al descargar en destino');

            // Fechas
            $table->date('fecha_salida')->nullable();
            $table->date('fecha_llegada')->nullable();

            // Estado
            $table->enum('estado', ['Pendiente', 'En tránsito', 'En frontera', 'Entregado'])->default('Pendiente');

            $table->text('observaciones')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tramos');
    }
};
