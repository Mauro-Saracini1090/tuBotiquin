<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObraSocialFarmaciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obra_social_farmacia', function (Blueprint $table) {
            $table->unsignedBigInteger('obra_social_id');
            $table->unsignedBigInteger('farmacia_id');
            $table->timestamps();

            $table->foreign('obra_social_id')->references('id_obra_social')->on('obra_social')->onDelete('cascade');
            $table->foreign('farmacia_id')->references('id_farmacia')->on('farmacia')->onDelete('cascade');

            $table->primary(['obra_social_id','farmacia_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obra_social_farmacia');
    }
}
