<?php

class ClientesController extends \BaseController {

	public function index()
	{
		$clientes = Cliente::toShow();
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
		$cliente = Cliente::find($id);
		$data = array('cliente' => $cliente);
		return View::make('clientes/show')->with($data);
	}
	public function edit($id)
	{
		$cliente = CLiente::find($id);
		$data = array('cliente' => $cliente);
		return View::make('clientes/form')->with($data);
	}
	public function update($id)
	{
		$cliente = Cliente::find($id);
		$data = Input::get('cliente');
		$cliente->fill($data);
		$cliente->save();
		return Redirect::route('clientes.show', $id);
	}
	public function destroy($id)
	{
		//
	}


}
