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
    <th>Tipo</th>
    <th>Materiales</th>
  </tr>
  @foreach ($categorias as $categoria) 
    <tr>
      <?php $link = route('materiales_categorias.show', $categoria->id); ?>
      <td>{{link_to($link, $categoria->nombre)}}</td>
      <td>{{$categoria->tipo}}</td>
      <td>{{link_to($link, $categoria->materiales()->count())}}</td>
    </tr>
  @endforeach
</table>

@if (Auth::user()->role != 'normal')
  <div>
    <button onclick="$('#form').toggle()">Nueva Categoria</button>

    {{Form::open(['route' => 'materiales_categorias.store', 'id' => 'form', 'style' => 'display: none;'])}}
      <input name="categoria[nombre]" type="text"> Nombre<br>
      <select name="categoria[tipo]">
        <option value="lamina">Lamina</option>
        <option value="liquido">Liquido</option>
        <option value="paquete">Paquete</option>
        <option value="compuesto">Compuesto</option>
        <option value="unidad">Unidad</option>
        <option value="metro">Metros Lineales</option>
      </select>
      {{Form::submit('Crear Material')}}
    {{Form::close()}}
  </div>
@endif

@stop