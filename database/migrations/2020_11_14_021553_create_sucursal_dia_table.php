<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalDiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursal_dia', function (Blueprint $table) {
            $table->unsignedBigInteger('sucursal_id');
            $table->unsignedBigInteger('dia_id');
            $table->time('hora_inicio', 0);
            $table->time('hora_fin', 0);
            $table->timestamps();

            $table->foreign('sucursal_id')->references('id_sucursal')->on('sucursal')->onDelete('cascade');
            $table->foreign('dia_id')->references('id_dia')->on('dia')->onDelete('cascade');

            $table->primary(['sucursal_id','dia_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursal_dia');
    }
}
