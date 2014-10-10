@extends ('layout')

@section('content')
<?php 

  $empty = $categoria->materiales()->count() < 1;

  $tipos = [
    ['lamina', 'Lámina'],
    ['liquido', 'Líquido'],
    ['paquete', 'Paquete'],
    ['compuesto', 'Compuesto'],
    ['unidad', 'Unidad'],
    ['metro', 'Metros Lineales'],
  ];

  if ($categoria->exists) {
    $route = ['materiales_categorias.update', $categoria->id];
  } else {
    $route = 'materiales_categorias.store';
  }
 ?>
<div>
  {{Form::model($categoria, ['route' => $route, 'id' => 'form'])}}
    <input name="categoria[nombre]" type="text" value="{{$categoria->nombre}}"> Nombre<br>
    @if ($empty)
    <select name="categoria[tipo]">
      @foreach ($tipos as $tipo)
        <option value="{{$tipo[0]}}">{{$tipo[1]}}</option>
      @endforeach
    </select>
    @else
      <p>La Categoría no debe tener ningun material para poder modificar el tipo</p>
    @endif
    {{Form::submit('Crear Categoria')}}
  {{Form::close()}}
 @if ($empty && $categoria->exists)
  {{Form::open(['route' => ['materiales_categorias.destroy', $categoria->id],
    'id' => 'form', 'method' => 'delete', 'onsubmit' => 'return confirm("Eliminar Categoria?");'])}}
    {{Form::submit('Eliminar Categoria')}}
  {{Form::close()}}
 @endif
</div>
@stop