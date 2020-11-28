<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('nombre_usuario');
            $table->string('email')->unique();
            $table->unsignedBigInteger('telefono_movil')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->bigInteger('cod_postal')->unsigned();
            $table->bigInteger('cuil')->nullable();
            $table->bigInteger('cuit')->nullable();
            $table->bigInteger('dni')->nullable();
            $table->string('numero_matricula',200)->nullable();
            $table->string('img_perfil', 250)->nullable();;
            $table->boolean('habilitado');
            $table->timestamps();

            $table->foreign('cod_postal')->references('codigo_postal')->on('localidad')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
