<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_proveedor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proveedor_id')->index();
            $table->string('ip1');
            $table->string('ip2');
            $table->string('ip3');
            $table->string('mas1');
            $table->string('mas2');
            $table->string('mas3');
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
        Schema::drop('detalle_proveedor');
    }
}
