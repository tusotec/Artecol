@extends ('layout')

@section ('content')
<h1>Nuevo Usuario</h1>
{{Form::open(['route' => 'users.store'])}}
  <input name="user[username]" type="text"> Nombre <br>
  <input name="user[email]" type="text"> Email <br>
  <input name="user[password]" type="password"> Contraseña <br>
  <input name="user[password_confirmation]" type="password"> Confirmar <br>
  <select name="user[role]">
    @foreach (Config::get('artecol.users_roles') as $tipo) {
      <option value="{{$tipo}}">{{$tipo}}</option>
    @endforeach
  </select>
  {{Form::submit('Aceptar')}}
{{Form::close()}}
@stop