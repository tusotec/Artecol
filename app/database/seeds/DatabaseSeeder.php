<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		MaterialCategoria::create(array(
			'nombre' => 'Sin Categoria',
			'tipo' => 'unidad',
		));

		ModuloCategoria::create(array(
			'nombre' => 'Sin Categoria',
		));

		Cliente::create(array(
			'nombre' => 'Anonimo',
			'apellido' => 'equis',
			'persona' => 'n',
			'identificacion' => '00000',
			'telefono' => '00000',
			'email' => 'anonimo@xxx.com',
			'celular' => '00000',
			'sexo' => 'm',
			'nacimiento' => '00-00-00'
		));

		User::create(array(
			'username' => 'master',
			'email' => 'master@xxx.com',
			'password' => Hash::make('123456'),
			'role' => 'master',
		));
	}

}
