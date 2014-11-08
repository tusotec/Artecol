<?php

class PresupuestosController extends \BaseController {

	public function index()
	{
		$presupuestos = Presupuesto::toShow();
		$data = array('presupuestos' => $presupuestos);
		return View::make('presupuestos/index')->with($data);
	}
	public function create()
	{
		$presupuesto = new Presupuesto;
		$data = array('presupuesto' => $presupuesto);
		return View::make('presupuestos/form')->with($data);
	}
	public function store()
	{
		$data = Input::all();
		$cliente = Cliente::find($data['presupuesto']['cliente_id']);
		$presupuesto = new Presupuesto;
		$presupuesto->fill($data['presupuesto']);
		$presupuesto->cliente()->associate($cliente);
		$presupuesto->save();
		foreach($data['modulos'] as $index => $m_data) {
			$modulo = new ModuloPresupuesto;
			$modulo->fill($m_data);
			$presupuesto->modulos()->save($modulo);
			$modulo->save();
		}
		return Redirect::route('presupuestos.index');
	}
	public function show($id)
	{
		$presupuesto = Presupuesto::find($id);
		$data = array('presupuesto' => $presupuesto);
		//return View::make('presupuestos/show')->with($data);

    $pdf = App::make('dompdf');
    $pdf->loadHTML(View::make('presupuestos/show')->with($data));
    return $pdf->stream();
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
