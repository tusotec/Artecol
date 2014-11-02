<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMedicionToModulos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('modulos', function($table)
		{
		  $table->string('medicion');
		});
		Schema::table('modulos_presupuestos', function($table)
		{
		  $table->float('alto');
		  $table->float('ancho');
		  $table->float('profundo');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('modulos', function($table)
		{
		  $table->dropColumn('medicion');
		});
		Schema::table('modulos_presupuestos', function($table)
		{
		  $table->dropColumn('alto');
		  $table->dropColumn('ancho');
		  $table->dropColumn('profundo');
		});
	}

}
