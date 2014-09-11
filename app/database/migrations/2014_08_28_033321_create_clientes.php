<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('nombre');
			$table->string('apellido');
			$table->char('persona', 1);		//n = natural, j = juridica, r = representante
			$table->string('identificacion');
			$table->string('direccion');
			$table->string('telefono', 16);
			$table->string('email');
			$table->string('celular', 16);
			$table->char('sexo', 1);			//m = masculino, f = femenino
			$table->date('nacimiento');
			$table->integer('representante_id')->unsigned();
			$table->text('observaciones');

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
		Schema::drop('clientes');
	}

}
