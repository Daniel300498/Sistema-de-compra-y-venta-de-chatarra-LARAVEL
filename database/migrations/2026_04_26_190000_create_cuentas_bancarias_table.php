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
        $table->string('banco', 100);
        $table->string('alias')->nullable();
         $table->text('numero_cuenta');
        $table->string('numero_cuenta_ultimos', 4)->nullable();
        $table->string('titular', 150);
        $table->boolean('activa')->default(true);
        $table->text('descripcion')->nullable();
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_bancarias');
    }
};
