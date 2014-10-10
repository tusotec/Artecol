<?php

class MaterialesCategoriasController extends \BaseController {

	public function index()
	{
		$categorias = MaterialCategoria::all();
		return View::make('materiales/categorias_index')->with('categorias', $categorias);
	}
	public function create()
	{
		$categoria = new MaterialCategoria;
		$categorias = MaterialCategoria::all();
		$data = ['categoria' => $categoria,'categorias' => $categorias];
		return View::make('materiales/categorias_form')->with($data);
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
		$categoria = MaterialCategoria::find($id);
		$data = ['categoria' => $categoria];
		return View::make('materiales/categorias_form')->with($data);
	}
	public function update($id)
	{
		$data = Input::all();
		$categoria = MaterialCategoria::find($id);
		$categoria->fill($data['categoria']);
		$categoria->save();
		return Redirect::route('materiales_categorias.index');
	}
	public function destroy($id)
	{
		$categoria = MaterialCategoria::find($id);
		$categoria->delete();
		return Redirect::route('materiales_categorias.index');
	}


}
