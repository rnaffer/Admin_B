<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalledevolucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_devolucion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('devolucion_id')->index();
            $table->integer('producto_id')->index();
            $table->integer('cantidad');
            $table->double('precio');
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
        Schema::drop('detalle_devolucion');
    }
}
