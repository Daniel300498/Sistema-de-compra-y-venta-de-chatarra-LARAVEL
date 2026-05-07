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
        Schema::create('cuentas_bancarias', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('banco_id');
            $table->foreign('banco_id')->references('id')->on('bancos');
            // Polimórfico: empresa, proveedor, conductor
            $table->enum('tipo_titular', ['empresa', 'proveedor', 'propietario', 'conductor']);
            $table->unsignedBigInteger('titular_id')->nullable();
            $table->string('titular_type', 100)->nullable();
            $table->string('numero_cuenta', 100);
            $table->string('moneda', 10)->default('BOB');
            $table->string('alias', 150)->nullable();
            $table->boolean('activo')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_bancarias');
    }
};
