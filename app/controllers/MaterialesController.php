<?php

class MaterialesController extends \BaseController {

	public function index()
	{
		$materiales = Material::toShow();
		return View::make('materiales/index')->with('materiales', $materiales);
	}

	public function create()
	{
		$data = array('material' => new Material());
		return View::make('materiales/form')->with($data);
	}

	public function store()
	{
		$data = Input::all();
		//return json_encode($data);
		$material = new Material;
		$material->fill($data['material']);
		$material->save();
		if (isset($data['vinculaciones'])) {
			foreach ($data['vinculaciones'] as $index => $v_data) {
				$vinculacion = new MaterialVinculacion;
				$vinculacion->fill($v_data);
				$vinculacion->save();
				$material->vinculaciones()->save($vinculacion);
			}
		}
		return Redirect::route('materiales.index');
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$data = array('material' => Material::find($id));
		return View::make('materiales/form')->with($data);
	}

	public function update($id)
	{
		//return Input::all();

		$data = Input::all();
		$material = Material::find($id);
		$material->fill($data['material']);
		$material->save();
		return Redirect::route('materiales.index');
	}

	public function destroy()
	{
		$id = Input::get('id');
		$material = Material::find($id);
		$material->delete();
		return Redirect::route('materiales.index');
	}


}
