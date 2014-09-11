<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialesTable extends Migration {

	public function up()
	{
		Schema::create('materiales', function($table)
		{
			$table->increments('id');

			$table->string('nombre');
			$table->integer('categoria_id')->unsigned();

			$table->double('precio_compra');
			$table->double('costo');
			$table->float('flete');

			$table->float('alto');
			$table->float('ancho');
			$table->float('cantidad');
			$table->float('rendimiento');
			$table->float('desperdicio');

			$table->text('descripcion')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('materiales');
	}

}
