<?php

class MaterialesCategoriasController extends \BaseController {

	public function index()
	{
		$categorias = MaterialCategoria::all();
		return View::make('materiales/categorias_index')->with('categorias', $categorias);
	}
	public function create()
	{
		//
	}
	public function store()
	{
		$data = Input::all();
		$categoria = new MaterialCategoria;
		$categoria->fill($data['categoria']);
		$categoria->save();
		return Redirect::route('materiales_categorias.index');
	}
	public function show($id)
	{
		$categoria = MaterialCategoria::find($id);
		$materiales = $categoria->materiales;
		return View::make('materiales/categorias_show')->with(['categoria' => $categoria, 'materiales' => $materiales]);
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
