@extends ('layout')

@section ('content')
<h1>Usuarios</h1>
<table>
  <tr>
    <th>Nombre</th>
    <th>Email</th>
    <th>Tipo</th>
  </tr>
  @foreach ($users as $user) {
    <tr>
      <td>{{$user->username}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->role}}</td>
    </tr>
  @endforeach
</table>
@stop