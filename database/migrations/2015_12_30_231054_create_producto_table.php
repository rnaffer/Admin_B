<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tiporeten_id')->index();
            $table->integer('marca_id')->index();
            $table->integer('unidad_medida_id')->index();
            $table->integer('ganancia_id')->index();
            $table->string('codigo_barra');
            $table->string('nombre');
            $table->string('descripcion');
            $table->double('costo');
            $table->double('pvp1');
            $table->double('pvp2');
            $table->double('pvp3');
            $table->double('pvp4');
            $table->double('pvp5');
            $table->integer('stock');
            $table->integer('stkmin');
            $table->string('estado');
            $table->string('color');
            $table->string('observaciones');
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
        Schema::drop('producto');
    }
}
