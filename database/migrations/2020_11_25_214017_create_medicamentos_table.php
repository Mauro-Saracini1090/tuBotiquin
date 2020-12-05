<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id('id_medicamento');
            $table->string('nombre_medicamento',250);
            $table->string('informacion',4000);
            $table->string('img_medicamento', 250);
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('tipo_id');
            $table->timestamps();

            $table->foreign('marca_id')->references('id_marca')->on('marca_medicamentos')->onDelete('cascade');
            $table->foreign('tipo_id')->references('id_tipo')->on('tipo_medicamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicamentos');
    }
}
