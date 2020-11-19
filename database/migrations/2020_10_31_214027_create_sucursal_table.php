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
            //$table->bigInteger('id_usuario');
            $table->unsignedBigInteger('id_farmacia');
            $table->string('descripcion_sucursal', 250);
            $table->string('cufe_sucursal')->unique();
            $table->string('email_sucursal');
            $table->integer('telefono_sucursal');
            $table->string('direccion_sucursal', 250);
            $table->boolean('habilitado');
            $table->boolean('borrado_logico_sucursal');  
            
            $table->timestamps();

            //$table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
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
