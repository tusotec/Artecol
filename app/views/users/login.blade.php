@extends ('layout')

@section ('content')
<table class="table-bordered form-vertical"> <tr><td>
<h1>Ingresar</h1>
{{Form::open(['route' => 'users.attempt'])}}
  <input name="user[email]" type="text"> Email <br>
  <input name="user[password]" type="password"> Contraseña <br>
  {{Form::submit('Aceptar')}}
{{Form::close()}}
</td></tr></table>
@stop