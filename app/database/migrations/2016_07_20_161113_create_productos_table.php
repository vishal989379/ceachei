<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('productos', function ($table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->string('nombre');
            $table->integer('precio_unitario');
            $table->foreign('proveedor_id')->references('id')->on('proveedor')
                ->onUpdate('cascade')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('productos');
	}

}
