<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBodegaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodega', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cod_producto')->index();
            $table->string('bodega1');
            $table->string('bodega2');
            $table->string('bodega3');
            $table->string('bodega4');
            $table->string('bodega5');
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
        Schema::drop('bodega');
    }
}
