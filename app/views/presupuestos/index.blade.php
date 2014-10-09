@extends ('layout')

@section ('header')
<style type="text/css">
.big th, .big { border:1px solid; }
.big td, .small th { border:1px solid lightgray; }
.small { border-collapse: collapse; }
</style>
@stop

@section ('content')
<h1>Listando los Presupuestos:</h1>
<table class='big'>
  <tr>
    <th>ID</th>
    <th>Fecha</th>
    <th>Cliente</th>
    <th>Precio</th>
    <th>Modulos</th>
    <th>Mostrar</th>
  </tr>
  @foreach ($presupuestos as $presupuesto)
    <tr>
      <td>{{$presupuesto->id}}</td>
      <td>{{$presupuesto->fecha}}</td>
      <td>{{$presupuesto->cliente->nombre}}</td>
      <td>{{precio($presupuesto->precio)}}</td>
      <td>
        <table>
          <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Posicion</th>
          </tr>
          @foreach ($presupuesto->modulos as $modulo)
            <tr>
              <td>{{$modulo->modulo->nombre}}</td>
              <td>{{precio($modulo->precio)}}</td>
              <td>{{$modulo->cantidad}}</td>
              <td>{{$modulo->posicion}}</td>
            </tr>
          @endforeach
        </table>
      </td>
      <td>{{link_to(route('presupuestos.show', $presupuesto->id), 'Mostrar')}}</td>
    </tr>
  @endforeach
</table>
@stop