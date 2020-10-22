<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_permisos', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('permiso_id');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id_usuario')->on('usuario')->onDelete('cascade');
            $table->foreign('permiso_id')->references('id_permiso')->on('permisos')->onDelete('cascade');

            $table->primary(['usuario_id','permiso_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_permisos');
    }
}
