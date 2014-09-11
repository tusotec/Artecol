<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVinculaciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('materiales_vinculaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('padre_id')->unsigned();
			$table->integer('hijo_id')->unsigned();
			$table->float('cantidad');
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
		Schema::drop('materiales_vinculaciones');
	}

}
