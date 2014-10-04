<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



Route::get('login', ['uses' => 'UsersController@login', 'as' => 'users.login']);
Route::post('users/login', ['uses' => 'UsersController@attempt', 'as' => 'users.attempt']);
Route::get('users/logout', ['uses' => 'UsersController@logout', 'as' => 'users.logout']);

Route::group(['before' => 'normal'], function () {

  Route::get('/', function()
  {
    return View::make('index');
  });

  Route::get('materiales/categorias', 
    ['uses' => 'MaterialesCategoriasController@index', 'as' => 'materiales_categorias.index']);
  Route::get('materiales/categorias/{id}', 
    ['uses' => 'MaterialesCategoriasController@show', 'as' => 'materiales_categorias.show']);

  Route::post('materiales/categorias', [
    'uses' => 'MaterialesCategoriasController@store',
    'as' => 'materiales_categorias.store',
    'before' => 'admin'
  ]);

  Route::get('materiales', ['uses' => 'MaterialesController@index', 'as' => 'materiales.index']);

  Route::get('materiales/new', ['uses' => 'MaterialesController@create', 'as' => 'materiales.create',
    'before' => 'admin']);
  Route::post('materiales', ['uses' => 'MaterialesController@store', 'as' => 'materiales.store',
    'before' => 'admin']);
  Route::delete('materiales', ['uses' => 'MaterialesController@destroy', 'as' => 'materiales.destroy',
    'before' => 'admin']);

  Route::get('modulos/categorias', 
    ['uses' => 'ModulosCategoriasController@index', 'as' => 'modulos_categorias.index']);
  Route::get('modulos/categorias/{id}', 
    ['uses' => 'ModulosCategoriasController@show', 'as' => 'modulos_categorias.show']);
  Route::post('modulos/categorias', [
    'uses' => 'ModulosCategoriasController@store',
    'as' => 'modulos_categorias.store',
    'before' => 'admin'
  ]);

  Route::get('modulos', ['uses' => 'ModulosController@index', 'as' => 'modulos.index']);
  Route::get('modulos/new', ['uses' => 'ModulosController@create', 'as' => 'modulos.create',
    'before' => 'admin']);
  Route::post('modulos', ['uses' => 'ModulosController@store', 'as' => 'modulos.store',
    'before' => 'admin']);
  Route::get('modulos/{id}/edit', ['uses' => 'ModulosController@edit', 'as' => 'modulos.edit',
    'before' => 'admin']);
  Route::post('modulos/{id}', ['uses' => 'ModulosController@update', 'as' => 'modulos.update',
    'before' => 'admin']);

  Route::get('modulos/{modulo_id}/vinc/{id}', ['uses' => 'ModulosController@vinc',
    'as' => 'modulos.vinc', 'before' => 'admin']);

  Route::post('modulos/{modulo_id}/vinc/{id}', ['uses' => 'ModulosController@vincStore',
    'as' => 'modulos.vinc.store', 'before' => 'admin']);


  Route::get('clientes', ['uses' => 'ClientesController@index', 'as' => 'clientes.index']);
  Route::get('cliente/{id}', ['uses' => 'ClientesController@show', 'as' => 'clientes.show']);
  Route::get('clientes/new', ['uses' => 'ClientesController@create', 'as' => 'clientes.create']);
  Route::post('clientes', ['uses' => 'ClientesController@store', 'as' => 'clientes.store']);
  Route::get('cliente/{id}/edit', ['uses' => 'ClientesController@edit',
    'as' => 'clientes.edit', 'before' => 'master']);
  Route::post('clientes/{id}', ['uses' => 'ClientesController@update',
    'as' => 'clientes.update', 'before' => 'master']);

  Route::get('presupuestos', ['uses' => 'PresupuestosController@index', 'as' => 'presupuestos.index']);
  Route::get('presupuestos/new', ['uses' => 'PresupuestosController@create', 'as' => 'presupuestos.create']);
  Route::get('presupuestos/{id}', ['uses' => 'PresupuestosController@show', 'as' => 'presupuestos.show']);
  Route::post('presupuestos', ['uses' => 'PresupuestosController@store', 'as' => 'presupuestos.store']);

  Route::get('users', ['uses' => 'UsersController@index', 'as' => 'users.index', 'before' => 'master']);
  Route::get('users/new', ['uses' => 'UsersController@create', 'as' => 'users.create', 'before' => 'master']);
  Route::post('users/new', ['uses' => 'UsersController@store', 'as' => 'users.store', 'before' => 'master']);

});
