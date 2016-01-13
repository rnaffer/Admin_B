<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleclienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->index();
            $table->integer('trabajador_id')->index();
            $table->integer('tipo_conexion_id')->index();
            $table->string('ip');
            $table->time('hora');
            $table->string('estado_conexion');
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
        Schema::drop('detalle_cliente');
    }
}
