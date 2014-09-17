@extends ('layout')

@section('content')
<h1>Editar Modulo</h1>
<table>
  <tr>
    <th>Nombre</th>
    <th>Cantidad</th>
    <th>Medida 1</th>
    <th>Medida 2</th>
    <th>Opciones</th>
  </tr>
  @foreach ($modulo->vinculaciones as $vinculacion)
    <tr>
      <td>{{$vinculacion->nombre()}}</td>
      <td>{{$vinculacion->cantidad}}</td>
      <td>{{$vinculacion->medida_1}}</td>
      <td>{{$vinculacion->medida_2}}</td>
      <td>{{link_to(route('modulos.vinc', [$modulo->id, $vinculacion->id]), 'Editar')}}</td>
    </tr>
  @endforeach
</table>
{{link_to(route('modulos.vinc', [$modulo->id, 'new']), 'Agregar Material')}}
@stop