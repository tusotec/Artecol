@extends ('layout')

@section ('header')
<style type="text/css">
.big th, .big { border:1px solid; }
.big td, .small th { border:1px solid lightgray; }
.small { border-collapse: collapse; }
</style>
@stop

@section ('content')
<h1>Categoria - {{$categoria->nombre}}</h1>

<table class="big">
  <tr>
    <th>Nombre</th>
    <th>Categoria</th>
    <th>Precio de Compra</th>
    <th>Costo</th>
    <th>Flete</th>
    <th>Alto</th>
    <th>Ancho</th>
    <th>Cantidad</th>
    <th>Rendimiento</th>
    <th>Desperdicio</th>
    <th>Vinculaciones</th>
    <th>Opciones</th>
  </tr>
  @foreach ($materiales as $material)
    <tr>
      <td>{{$material->nombre}}</td>
      <td>{{$material->categoria()->getResults()->nombre}}</td>
      <td>{{$material->costo}}</td>
      <td>{{$material->costo}}</td>
      <td>{{$material->flete}}</td>
      <td>{{$material->alto}}</td>
      <td>{{$material->ancho}}</td>
      <td>{{$material->cantidad}}</td>
      <td>{{$material->rendimiento}}</td>
      <td>{{$material->desperdicio}}</td>
      <td>
        <table class="small">
          <tr>
            <th>Material</th>
            <th>Cantidad</th>
          </tr>
          @foreach ($material->vinculaciones as $vinculacion)
          <tr>
            <td>{{$vinculacion->hijo->nombre}}</td>
            <td>{{$vinculacion->cantidad}}</td>
          </tr>
          @endforeach
        </table>
      </td>
      <td>
       <a href="#">Borrar</a>
      </td>
    </tr>
  @endforeach
</table>

@stop