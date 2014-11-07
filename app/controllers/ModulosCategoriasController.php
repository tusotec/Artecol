<?php

class ModulosCategoriasController extends \BaseController {

	public function index()
	{
		$categorias = ModuloCategoria::all();
		return View::make('modulos/categorias_index')->with('categorias', $categorias);
	}
	public function create()
	{
		$categoria = new ModuloCategoria;
		return View::make('modulos/categorias_form')->with('categoria', $categoria);
	}
	public function store()
	{
		$data = Input::all();
		$categoria = new ModuloCategoria;
		$categoria->fill($data['categoria']);
		$categoria->save();
		return Redirect::route('modulos_categorias.index');
	}
	public function show($id)
	{
		//
	}
	public function edit($id)
	{
		$categoria = ModuloCategoria::find($id);
		return View::make('modulos/categorias_form')->with('categoria', $categoria);
	}
	public function update($id)
	{
		$data = Input::all();
		$categoria = ModuloCategoria::find($id);
		$categoria->fill($data['categoria']);
		$categoria->save();
		return Redirect::route('modulos_categorias.index');
	}
	public function destroy($id)
	{
		if ($id == 1) {
			return 'No se puede eliminar esta categoria';
		}
		$categoria = ModuloCategoria::find($id);
		$sin_cat = ModuloCategoria::find(1);
		foreach ($categoria->modulos as $modulo) {
			$sin_cat->modulos()->save($modulo);
		}
		$categoria->delete();
		return Redirect::route('modulos_categorias.index');
	}


}
