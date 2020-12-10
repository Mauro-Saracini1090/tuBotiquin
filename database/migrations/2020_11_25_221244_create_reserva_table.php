<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->id('id_reserva');
            $table->bigInteger('numero_reserva');
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('usuario_id')->unsigned();
            $table->bigInteger('estados_id')->unsigned();
            $table->date('fecha_solicitud_estados');
            $table->date('fecha_caducidad_estados');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id_usuario')->on('usuario')->onDelete('cascade');
            $table->foreign('estados_id')->references('id_estados')->on('estados')->onDelete('cascade');
            $table->foreign('sucursal_id')->references('id_sucursal')->on('sucursal')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva');
    }
}
