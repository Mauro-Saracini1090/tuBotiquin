<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmaciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmacia', function (Blueprint $table) {
            $table->id('id_farmacia');
            $table->bigInteger('id_usuario')->unsigned();
            $table->string('nombre_farmacia');
            $table->string('img_farmacia', 250);
            $table->string('descripcion_farmacia', 250);
            $table->bigInteger('cuit')->unique();
            $table->boolean('habilitada');  
            $table->boolean('borrado_logico_farmacia');    
            $table->timestamps();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmacia');
    }
}
