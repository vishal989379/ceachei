<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecaudacionDiariaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

		Schema::create('recaudacion_diaria', function ($table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->unsigned();
            $table->datetime('fecha');
            $table->integer('registro');
            $table->integer('nulos');
            $table->integer('efectivo_real');
            $table->integer('redcompra');
            $table->timestamps();
        });

        Schema::create('gastos', function ($table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->unsigned();
            $table->integer('monto');
            $table->string('descripcion');
            $table->enum('choices', array('B', 'F'));
            $table->integer('num_doc');
            $table->integer('recaudacion_id')->unsigned();
            $table->foreign('recaudacion_id')->references('id')->on('recaudacion_diaria')
                ->onUpdate('cascade')->onDelete('cascade');
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
		Schema::drop('recaudacion_diaria');
		Schema::drop('gastos');
	}

}
