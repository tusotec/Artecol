@extends ('layout')

@section('content')
<h1>Modulo {{$modulo->nombre}}</h1>
<table id="datos">
  <tr>
    <th>Precio:</th>
    <td>{{$modulo->precio()}}</td>
  </tr>
  <tr>
    <th>Categoría:</th>
    <td>{{$modulo->categoria->nombre}}</td>
  </tr>
  <tr>
    <th>Alto:</th>
    <td>{{$modulo->alto}}</td>
  </tr>
  <tr>
    <th>Ancho:</th>
    <td>{{$modulo->ancho}}</td>
  </tr>
  <tr>
    <th>Profundo:</th>
    <td>{{$modulo->profundo}}</td>
  </tr>
  <tr>
    <th>Ganancia:</th>
    <td>{{$modulo->ganancia}}%</td>
  </tr>
</table>
<h3>Materiales</h3>
<table id="materiales">
  <tr>
    <th>Nombre</th>
    <th>Categoría</th>
    <th>Cantidad</th>
    <th>Medida 1</th>
    <th>Medida 2</th>
    <th>Precio Material</th>
    <th>Costo Total</th>
  </tr>
  @foreach ($modulo->vinculaciones as $vinculacion)
    <tr>
      <td>{{$vinculacion->nombre()}}</td>
      <td>{{$vinculacion->categoria()}}</td>
      <td>{{$vinculacion->cantidad}}</td>
      <td>{{$vinculacion->medida_1}}</td>
      <td>{{$vinculacion->medida_2}}</td>
      <td>{{precio($vinculacion->precioMaterial())}}</td>
      <td>{{precio($vinculacion->precio())}}</td>
    </tr>
  @endforeach
</table>
@stop