<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('modulos', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('nombre');
			$table->integer('categoria_id')->unsigned();
			$table->float('alto');
			$table->float('ancho');
			$table->float('profundo');
			$table->float('ganancia');

			$table->timestamps();
		});
		Schema::create('modulos_vinculaciones', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('modulo_id')->unsigned();
			$table->integer('material_id')->unsigned();
			$table->float('medida_1');
			$table->float('medida_2');
			$table->float('cantidad');

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('modulos');
		Schema::drop('modulos_vinculaciones');
	}

}
