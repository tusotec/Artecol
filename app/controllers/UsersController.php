<?php

class UsersController extends \BaseController {

	public function index()
	{
		$data = array('users' => User::all());
		return View::make('users/index')->with($data);
	}
	public function create()
	{
		return View::make('users/form');
	}
	public function store()
	{
		$data = Input::all()['user'];
		$user = new User;
		if ($user->isValid($data)) {
			$data['password'] = Hash::make($data['password']);
			$user->fill($data);
			$user->save();
			return Redirect::route('users.index');
		}
		return Redirect::route('users.create')->withInput()->withErrors($user->errors);
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

	public function login () {
		return View::make('users/login');
	}
	public function attempt () {
		$data = Input::all()['user'];
		Auth::attempt($data);
		return Redirect::to('/');
	}
	public function logout () {
		Auth::logout();
		return Redirect::route('users.login');
	}


}
