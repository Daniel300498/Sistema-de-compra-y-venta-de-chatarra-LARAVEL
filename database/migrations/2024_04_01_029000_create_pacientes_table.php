<?php   
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('ci')->unique();
            $table->string('ci_complemento',4)->nullable();
            $table->string('ci_lugar',4);
            $table->string('nombres',200);
            $table->string('ap_paterno',150);
            $table->string('ap_materno',150)->qnullable();
            $table->date('fecha_nacimiento');
            $table->boolean('sexo')->comment('1=Femenino, 0=Masculino');
            $table->string('nro_celular',20)->nullable();
            $table->string('direccion')->nullable();
            $table->string('contacto_nombre',150);
            $table->string('contacto_telefono',15);
            $table->string('contacto_parentesco',150); 
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
        Schema::dropIfExists('pacientes');
    }
};