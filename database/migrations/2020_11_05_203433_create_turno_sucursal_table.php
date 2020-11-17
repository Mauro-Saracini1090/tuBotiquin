<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnoSucursalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turno_sucursal', function (Blueprint $table) {
            $table->unsignedBigInteger('turno_id');
            $table->unsignedBigInteger('sucursal_id');
            $table->timestamps();

            $table->foreign('turno_id')->references('id_turno')->on('turno')->onDelete('cascade');
            $table->foreign('sucursal_id')->references('id_sucursal')->on('sucursal')->onDelete('cascade');

            $table->primary(['turno_id','sucursal_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turno_sucursal');
    }
}
