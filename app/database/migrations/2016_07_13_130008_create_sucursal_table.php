<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('sucursal', function ($table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->unsigned();
            $table->string('nombre');
            $table->string('direccion');
            $table->timestamps();
        });

        Schema::table('recaudacion_diaria', function($table)
		{
		    $table->integer('sucursal_id')->unsigned();
            $table->foreign('sucursal_id')->references('id')->on('sucursal')
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
		Schema::drop('sucursal');

        Schema::table('recaudacion_diaria', function(Blueprint $table) {
            $table->dropForeign('sucursal_id');
        });
	}

}
