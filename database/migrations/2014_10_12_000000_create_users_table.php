<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('direccion');
            $table->string('nick');
            $table->string('ruc');
            $table->string('telefono');
            $table->string('celular');
            $table->string('email')->unique();
            $table->string('web');
            $table->string('observacion');
            $table->string('almacen');
            $table->string('password', 60);
            $table->integer('tipo_id')->index();
            $table->integer('ciudad_id')->index();
            $table->integer('sexo_id')->index();
            $table->integer('civil_id')->index();
            $table->integer('estado_id')->index();
            $table->integer('cobrador_id')->index();
            $table->integer('codigo_afiliado')->index();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
