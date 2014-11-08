<?php

class ModulosController extends \BaseController {

	public function index()
	{
		$modulos = Modulo::toShow();
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
			$material->validFill($m_data);
			$material->save();
			$modulo->vinculaciones()->save($material);
		}
		return Redirect::route('modulos.index');
	}
	public function show($id)
	{
		$data = array();
		$data['modulo'] = Modulo::find($id);
		return View::make('modulos/show')->with($data);
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
		$data = Input::all();
		$modulo = Modulo::find($id);
		$modulo->fill($data['modulo']);
		$modulo->save();
		foreach ($data['materiales'] as $index => $m_data) {
			if($m_data['id'] != '') {
				$material = ModuloVinculacion::find($m_data['id']);
			} else {
				$material = new ModuloVinculacion;
			}
			$material->validFill($m_data);
			$material->save();
			$modulo->vinculaciones()->save($material);
		}
		return Redirect::route('modulos.index');
	}
	public function destroy($id)
	{
		$modulo = Modulo::find($id);
		foreach ($modulo->vinculaciones as $vinculacion) {
			$vinculacion->delete();
		}
		$modulo->delete();
		return Redirect::route('modulos.index');
	}
	public function vinc ($modulo_id, $id) {
		if ($id == 'new') {
			$vinculacion = new ModuloVinculacion;
		} else {
			$vinculacion = ModuloVinculacion::find($id);
		}
		$data = array();
		$data['vinculacion'] = $vinculacion;
		$data['mat_cat'] = MaterialCategoria::all();
		$data['modulo_id'] = $modulo_id;
		return View::make('modulos/vinc')->with($data);
	}
	public function vincStore ($modulo_id, $id) {
		if ($id == 'new') {
			$vinculacion = new ModuloVinculacion;
			$vinculacion->modulo_id = $modulo_id;
		} else {
			$vinculacion = ModuloVinculacion::find($id);
		}
		$data = Input::get('vinculacion');
		$vinculacion->fill($data);
		$vinculacion->save();
		return Redirect::route('modulos.edit', $modulo_id);
	}


}
