<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SucursalMedicamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sucursal_medicamento', function (Blueprint $table) {
            $table->unsignedBigInteger('medicamento_id');
            $table->unsignedBigInteger('sucursal_id');
            $table->unsignedBigInteger('cantidad');
            $table->unsignedBigInteger('cantidadTotal');
            $table->timestamps();

            $table->foreign('medicamento_id')->references('id_medicamento')->on('medicamentos')->onDelete('cascade');
            $table->foreign('sucursal_id')->references('id_sucursal')->on('sucursal')->onDelete('cascade');

            $table->primary(['medicamento_id','sucursal_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('sucursal_medicamento');
    }
}
