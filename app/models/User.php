<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';

	protected $hidden = array('password', 'remember_token');

  protected $fillable = array(
    'username', 'email', 'password', 'role'
  );

  public function getAuthIdentifier()
  {
    return $this->getKey();
  }

  public function getAuthPassword()
  {
    return $this->password;
  }

  public function getRememberToken() {
    return $this->remember_token;
  }


  public function setRememberToken($value) {
    $this->remember_token = $value;
  }


  public function getRememberTokenName() {
    return 'remember_token';
  }

	public $errors;
    
  public function isValid ($data)
  {
    $rules = array(
	    'email'     => 'required|email|unique:users',
	    'username' => 'required|min:4|max:40',
	    'password'  => 'required|min:4|confirmed'
    );
    $validator = Validator::make($data, $rules);
    if ($validator->passes())
    {
      return true;
    }
    $this->errors = $validator->errors();
    return false;
  }

}
