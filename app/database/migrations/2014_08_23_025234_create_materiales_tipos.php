<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialesTipos extends Migration {

	/**
	 * La Migracion se llama "Materiales tipos" pero la tabla y los modelos en realidad son "Materiales Categorias".
	 */
	public function up()
	{
		Schema::create('materiales_categorias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->string('tipo');
			$table->text('descripcion')->nullable();
			$table->timestamps();
		});
	}
	public function down()
	{
		Schema::drop('materiales_categorias');
	}

}
