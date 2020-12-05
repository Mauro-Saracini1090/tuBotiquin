<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id('id_estados');
            $table->bigInteger('tipo_estados_id')->unsigned();
            $table->date('fecha_caducidad_estados');
            $table->date('fecha_solicitud_estados');
            $table->timestamps();

            $table->foreign('tipo_estados_id')->references('id_tipo_estados')->on('tipo_estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
