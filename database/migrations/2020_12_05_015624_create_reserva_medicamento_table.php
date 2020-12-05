<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaMedicamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_medicamento', function (Blueprint $table) {

            $table->unsignedBigInteger('medicamento_id');
            $table->unsignedBigInteger('reserva_id');
            $table->unsignedBigInteger('cantidad');
            $table->timestamps();

            $table->foreign('medicamento_id')->references('id_medicamento')->on('medicamentos')->onDelete('cascade');
            $table->foreign('reserva_id')->references('id_reserva')->on('reserva')->onDelete('cascade');

            $table->primary(['medicamento_id','reserva_id']);

        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_medicamento');
    }
}
