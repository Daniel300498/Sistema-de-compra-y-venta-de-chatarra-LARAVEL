<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('ci', 20)->nullable()->comment('Cédula de identidad');
            $table->string('cargo', 100)->nullable()->comment('Ej: Administrador, Contador, Operador');
            $table->string('telefono', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->boolean('activo')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
