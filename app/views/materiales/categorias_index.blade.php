@extends ('layout')

@section ('content')
<h1>Categorias</h1>
{{$categorias->count()}}
<table>
  <tr>
    <th>Nombre</th>
    <th>Tipo</th>
    <th>Materiales</th>
    <th colspan="2">Opciones</th>
  </tr>
  @foreach ($categorias as $categoria) 
    <tr>
      <?php $link = route('materiales_categorias.show', $categoria->id); 
            $edit = route('materiales_categorias.edit', $categoria->id); 
            $destroy = ['materiales_categorias.destroy', $categoria->id]; ?>
      <td>{{link_to($link, $categoria->nombre)}}</td>
      <td>{{$categoria->tipo}}</td>
      <td>{{link_to($link, $categoria->materiales()->count())}}</td>
      <td>{{link_to($edit, 'Editar')}}</td>
      <td>
        {{Form::open(['route' => $destroy, 'method' => 'delete'])}}
          {{Form::submit('Eliminar')}}
        {{Form::close()}}
      </td>
    </tr>
  @endforeach
</table>

{{link_to(route('materiales_categorias.create'), 'Nueva Categoría')}}

@stop