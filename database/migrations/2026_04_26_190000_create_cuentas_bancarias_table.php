<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cuentas_bancarias', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('banco_id')->constrained('bancos')->cascadeOnDelete();
            $table->enum('tipo_titular', ['proveedor', 'operador', 'empleado', 'cliente'])->nullable();
            $table->unsignedBigInteger('titular_id')->nullable();
            $table->string('titular_type', 100)->nullable();
            $table->string('numero_cuenta', 100);
            $table->string('moneda', 10)->default('BOB');
            $table->string('alias', 150)->nullable();
            $table->string('nombre_titular_cuenta', 150)->nullable();
            $table->string('tipo_relacion', 50)->nullable();
            $table->boolean('activo')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cuentas_bancarias');
    }
};
