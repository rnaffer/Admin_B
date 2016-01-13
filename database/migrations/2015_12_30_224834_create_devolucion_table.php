<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevolucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolucion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factcmp_id')->index();
            $table->integer('tipo_cmpbt');
            $table->double('descuento');
            $table->double('iva12');
            $table->double('total');
            $table->string('observacion');
            $table->string('estado');
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
        Schema::drop('devolucion');
    }
}
