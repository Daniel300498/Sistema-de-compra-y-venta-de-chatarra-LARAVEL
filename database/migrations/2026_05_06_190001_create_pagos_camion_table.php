<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagos_camion', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('contrato_camion_id');
            $table->foreign('contrato_camion_id')->references('id')->on('contrato_camiones')->cascadeOnDelete();

            $table->enum('tipo_pago', ['adelanto', 'flete', 'pago_final']);
            $table->decimal('monto', 12, 2);
            $table->date('fecha_pago');

            // A quién se paga (conductor u operador/propietario)
            $table->string('receptor_type', 100)->nullable();
            $table->unsignedBigInteger('receptor_id')->nullable();

            // Desde qué cuenta de la empresa sale
            $table->unsignedBigInteger('cuenta_origen_id')->nullable();
            $table->foreign('cuenta_origen_id')->references('id')->on('cuentas_bancarias')->nullOnDelete();

            // A qué cuenta del receptor va
            $table->unsignedBigInteger('cuenta_destino_id')->nullable();
            $table->foreign('cuenta_destino_id')->references('id')->on('cuentas_bancarias')->nullOnDelete();

            $table->enum('metodo_pago', ['efectivo', 'transferencia', 'qr', 'cheque']);
            $table->string('codigo_seguimiento', 100)->nullable();
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
        Schema::dropIfExists('pagos_camion');
    }
};
