<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagos_proveedor', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('contrato_id');
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->enum('tipo_pago', ['adelanto', 'parcial', 'pago_final']);
            $table->decimal('monto', 15, 2);
            $table->string('moneda_pago', 10)->default('BOB');
            $table->decimal('tipo_cambio', 10, 4)->default(1);
            $table->date('fecha_pago');
            $table->enum('metodo_pago', ['efectivo', 'transferencia', 'qr', 'cheque']);
            $table->string('codigo_seguimiento', 100)->nullable();
            $table->unsignedBigInteger('cuenta_origen_id')->nullable(); // cuenta del empleado que pagó
            $table->foreign('cuenta_origen_id')->references('id')->on('cuentas_bancarias');
            $table->unsignedBigInteger('cuenta_destino_id')->nullable(); // cuenta del proveedor/representante
            $table->foreign('cuenta_destino_id')->references('id')->on('cuentas_bancarias');
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
        Schema::dropIfExists('pagos_proveedor');
    }
};
