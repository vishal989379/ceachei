<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('proveedor', function ($table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->unsigned();
            $table->string('nombre');
            $table->string('direccion');
            $table->string('email');
            $table->integer('telefono');
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
		//
		Schema::drop('proveedor');
	}

}
