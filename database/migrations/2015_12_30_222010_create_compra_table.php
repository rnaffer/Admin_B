<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proveedor_id')->index();
            $table->string('codigo_guia_compra');
            $table->double('total');
            $table->string('observacion');
            $table->double('base_grava');
            $table->integer('estado')->index();
            $table->string('concepto')->index();            
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
        Schema::drop('compra');
    }
}
