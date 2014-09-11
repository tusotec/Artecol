@extends ('layout')

@section ('header')
<style type="text/css">
table, th { border:1px solid; }
td { border:1px solid lightgray; }
</style>
@stop

@section ('content')
<h1>Categorias</h1>
{{$categorias->count()}}
<table>
  <tr>
    <th>Nombre</th>
    <th>Modulos</th>
  </tr>
  @foreach ($categorias as $categoria) 
    <tr>
      <td>{{$categoria->nombre}}</td>
      <td>{{$categoria->modulos()->count()}}</td>
    </tr>
  @endforeach
</table>

@if (Auth::user()->role != 'normal')
  <div>
    <button onclick="$('#form').toggle()">Nueva Categoria</button>

    {{Form::open(['route' => 'modulos_categorias.store', 'id' => 'form', 'style' => 'display: none;'])}}
      <input name="categoria[nombre]" type="text"> Nombre
      {{Form::submit('Crear Categoria')}}
    {{Form::close()}}
  </div>
@endif

@stop