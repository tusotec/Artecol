<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('presupuestos', function(Blueprint $table)
		{
			$table->increments('id');

			$table->date('fecha');
			$table->double('precio');
			$table->integer('cliente_id')->unsigned();
			$table->text('observaciones');

			$table->timestamps();
		});
		Schema::create('modulos_presupuestos', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('modulo_id')->unsigned();
			$table->integer('presupuesto_id')->unsigned();
			$table->double('precio');
			$table->integer('cantidad');
			$table->integer('posicion');

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
		Schema::drop('presupuestos');
		Schema::drop('modulos_presupuestos');
	}

}
