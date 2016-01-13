<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contador_id')->index();
            $table->integer('representante_id')->index();
            $table->integer('ciudad_id')->index();
            $table->string('razon_social');
            $table->string('ruc');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('celular');
            $table->string('web');
            $table->string('correo');
            $table->string('numero_factura');
            $table->integer('conse_productos');
            $table->string('numero_entrada');
            $table->integer('conse_cliente');

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
        Schema::drop('empresa');
    }
}
