<?php

class ModulosController extends \BaseController {

	public function index()
	{
		$order = Input::get('order', 'nombre');
		$modulos = Modulo::paginate($order);
		return View::make('modulos/index')->with('modulos', $modulos);
	}
	public function create()
	{
		$data = array();
		$data['mat_cat'] = MaterialCategoria::all();
		$data['modulo'] = new Modulo;
		return View::make('modulos/form')->with($data);
	}
	public function store()
	{
		$data = Input::all();
		$modulo = new Modulo;
		$modulo->fill($data['modulo']);
		$modulo->save();
		foreach ($data['materiales'] as $index => $m_data) {
			$material = new ModuloVinculacion;
			$material->fill($m_data);
			$material->save();
			$modulo->vinculaciones()->save($material);
		}
		return Redirect::route('modulos.index');
	}
	public function show($id)
	{
		//
	}
	public function edit($id)
	{
		$data = array();
		$data['modulo'] = Modulo::find($id);
		$data['mat_cat'] = MaterialCategoria::all();
		return View::make('modulos/form')->with($data);
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
