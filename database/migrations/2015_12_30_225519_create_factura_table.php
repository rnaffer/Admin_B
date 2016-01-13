<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_factura');
            $table->integer('empresa_id')->index();
            $table->integer('cliente_id')->index();
            $table->integer('vendedor_id')->index();
            $table->double('descuento');
            $table->string('observacion');
            $table->double('iva12');
            $table->double('total');
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
        Schema::drop('factura');
    }
}
