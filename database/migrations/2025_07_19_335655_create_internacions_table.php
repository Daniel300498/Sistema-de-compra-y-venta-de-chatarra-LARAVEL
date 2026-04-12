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
        Schema::create('internacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('cama_id');
            $table->unsignedBigInteger('medico_id')->nullable();
            $table->dateTime('fecha_ocupacion');
            $table->dateTime('fecha_desocupacion')->nullable();
            $table->text('motivo');
            $table->text('observaciones')->nullable();  
            $table->string('nombre_cobertura')->nullable(); // Ej: "Caja Nacional", "SOAT", "Particular"
            $table->string('tipo_cobertura')->nullable(); // Ej: "Seguro público", "Seguro privado", etc.
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreign('cama_id')->references('id')->on('camas');
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internacions');
    }
};
