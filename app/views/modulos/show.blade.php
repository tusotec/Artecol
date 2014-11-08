@extends ('layout')

@section('content')
<h1>Modulo {{$modulo->nombre}}</h1>
<table id="datos">
  <tr>
    <th>Categoría:</th>
    <td>{{$modulo->categoria->nombre}}</td>
    <th>Alto:</th>
    <td>{{round($modulo->alto, 2)}}</td>
    <th>Ancho:</th>
    <td>{{round($modulo->ancho, 2)}}</td>
    <th>Profundo:</th>
    <td>{{round($modulo->profundo, 2)}}</td>
    <th>Margen:</th>
    <td>{{round($modulo->ganancia, 2)}}%</td>
  </tr>
  <tr>
    <th>Precio:</th>
    <td>{{precio($modulo->precio())}}</td>
    <th>Medicion:</th>
    <td>{{$modulo->medicion}}</td>
    <th>Precio Unitario:</th>
    <td>{{precio($modulo->precioUnitario())}}</td>
  </tr>
  <tr>
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
      <td>{{round($vinculacion->medida_1, 2)}}</td>
      <td>{{round($vinculacion->medida_2, 2)}}</td>
      <td>{{precio($vinculacion->precioMaterial())}}</td>
      <td>{{precio($vinculacion->precio())}}</td>
    </tr>
  @endforeach
</table>
@stop