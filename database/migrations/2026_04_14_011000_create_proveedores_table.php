<?php   
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nombre',200);
            $table->integer('nit')->nullable();
            $table->string('pais',50)->nullable();
            $table->integer('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('direccion',150)->nullable();
            $table->string('tipo_producto',150)->nullable(); 
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
        Schema::dropIfExists('proveedores');
    }
};