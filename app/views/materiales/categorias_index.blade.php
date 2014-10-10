@extends ('layout')

@section ('content')
<h1>Categorias</h1>
{{$categorias->count()}}
<table>
  <tr>
    <th>Nombre</th>
    <th>Tipo</th>
    <th>Materiales</th>
    <th>Editar</th>
    <th>Eliminar</th>
  </tr>
  @foreach ($categorias as $categoria) 
    <tr>
      <?php $link = route('materiales_categorias.show', $categoria->id); 
            $edit = route('materiales_categorias.edit', $categoria->id); ?>
      <td>{{link_to($link, $categoria->nombre)}}</td>
      <td>{{$categoria->tipo}}</td>
      <td>{{link_to($link, $categoria->materiales()->count())}}</td>
      <td>{{link_to($edit, 'Editar')}}</td>
    </tr>
  @endforeach
</table>

{{link_to(route('materiales_categorias.create'), 'Nueva Categoría')}}

@stop