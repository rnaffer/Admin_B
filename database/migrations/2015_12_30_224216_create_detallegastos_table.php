<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallegastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_gastos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gasto_id')->index();
            $table->string('nombre_producto');
            $table->double('costo_unitario');
            $table->integer('cantidad');
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
        Schema::drop('detalle_gastos');
    }
}
