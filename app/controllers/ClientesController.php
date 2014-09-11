<?php

class ClientesController extends \BaseController {

	public function index()
	{
		$clientes = Cliente::paginate();
		$data = array('clientes' => $clientes);
		return View::make('clientes/index')->with($data);
	}
	public function create()
	{
		$cliente = new Cliente;
		$data = array('cliente' => $cliente);
		return View::make('clientes/form')->with($data);
	}
	public function store()
	{
		$data = Input::all();
		$cliente = new Cliente;
		$cliente->fill($data['cliente']);
		if ($data['cliente']['persona'] == 'j') {
			$representante = new Cliente;
			$representante->fill($data['representante']);
			$representante->save();
			$representante->representados()->save($cliente);
		}
		$cliente->save();
		return Redirect::route('clientes.index');
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
