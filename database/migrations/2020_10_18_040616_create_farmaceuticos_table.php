<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmaceuticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmaceuticos', function (Blueprint $table) {
            $table->bigInteger('usuario_id')->unsigned()->nullable(false);
            $table->integer('cuil');
            $table->integer('cuit');
            $table->integer('dni');
            $table->string('numero_matricula',200);
            $table->timestamps();

            $table->primary('usuario_id');
            $table->foreign('usuario_id')->references('id_usuario')->on('usuario')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmaceuticos');
    }
}
