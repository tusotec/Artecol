@extends ('layout')

@section ('header')
<style type="text/css">
table, th { border:1px solid; }
td { border:1px solid lightgray; }
</style>
@stop

@section ('content')
<h1>Categorias</h1>
<table>
  <tr>
    <th>Nombre</th>
    <th>Modulos</th>
    <th colspan="2">Opciones</th>
  </tr>
  @foreach ($categorias as $categoria) 
    <tr>
      <td>{{$categoria->nombre}}</td>
      <td>{{$categoria->modulos()->count()}}</td>
      <td>{{link_to(route('modulos_categorias.edit', $categoria->id), 'Modificar')}}</td>
      <td>
        {{Form::open(['route' => ['modulos_categorias.destroy', $categoria->id], 'method' => 'delete'])}}
          {{Form::submit('Eliminar')}}
        {{Form::close()}}
      </td>
    </tr>
  @endforeach
</table>


@if (Auth::user()->role != 'normal')
  {{link_to(route('modulos_categorias.new'), 'Nueva Categoria')}}
@endif

@stop