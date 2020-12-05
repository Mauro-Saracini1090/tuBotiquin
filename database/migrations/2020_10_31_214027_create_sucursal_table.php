<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursal', function (Blueprint $table) {
            $table->id('id_sucursal');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('id_farmacia');
            $table->string('descripcion_sucursal', 250)->nullable();;
            $table->string('cufe_sucursal')->unique();
            $table->string('email_sucursal');
            $table->bigInteger('telefono_fijo')->nullable();
            $table->bigInteger('telefono_movil')->nullable();
            $table->string('direccion_sucursal', 250);
            $table->boolean('habilitado');
            $table->boolean('borrado_logico_sucursal');  
            $table->decimal('sucursal_latitud', 18, 15);  
            $table->decimal('sucursal_longitud', 18, 15);  
            
            $table->timestamps();

            $table->foreign('usuario_id')->references('id_usuario')->on('usuario')->onDelete('cascade');
            $table->foreign('id_farmacia')->references('id_farmacia')->on('farmacia')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursal');
    }
}
