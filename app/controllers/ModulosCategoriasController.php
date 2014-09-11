<?php

class ModulosCategoriasController extends \BaseController {

	public function index()
	{
		$categorias = ModuloCategoria::all();
		return View::make('modulos/categorias_index')->with('categorias', $categorias);
	}
	public function create()
	{
		//
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
		//
	}
	public function update($id)
	{
		//
	}
	public function destroy($id)
	{
		//
	}


}
