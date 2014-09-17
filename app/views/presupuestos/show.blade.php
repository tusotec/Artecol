<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Presupuesto {{$presupuesto->id}}</title>
  <style type="text/css">
    div {
      margin: 10px;
      padding: 5px;
      border: 1px solid;
    }
  </style>
</head>
<body>
  <div id="data_superior">
    <div id="id">ID: {{$presupuesto->id}}</div>
    <div id="fecha">Fecha: {{$presupuesto->fecha}}</div>
  </div>
  <div id="cliente">
    <?php $cliente = $presupuesto->cliente; ?>
    <div id="nombre">Nombre: {{$cliente->nombreCompleto()}}</div>
    <div id="id">Identificacion: {{$cliente->identificacion}}</div>
    <div id="telefono">Telefono: {{$cliente->telefono}}</div>
  </div>
  <div id="modulos">
    <table>
      <tr>
        <th is="id"></th>
        <th id="nombre">Nombre</th>
        <th id="cantidad">Cantidad</th>
        <th id="posicion">Posicion(es)</th>
        <th id="precio">Precio</th>
      </tr>
      <?php $cuenta = 0; ?>
      @foreach ($presupuesto->modulos as $modulo)
        <tr>
          <td id="id">{{$cuenta++}}</td>
          <td id="nombre">{{$modulo->nombre()}}</td>
          <td id="cantidad">{{$modulo->cantidad}}</td>
          <td id="posicion">{{$modulo->posicion}}</td>
          <td id="precio">{{number_format($modulo->precio, 2)}}</td>
        </tr>
      @endforeach
    </table>
  </div>
  <div id="data_inferior">
    <?php $precio = $presupuesto->precio; ?>
    <div id="precio">Precio: {{number_format($precio, 2)}} </div>
    <div id="precio_iva">Precio+IVA: 
    {{number_format($precio + ($precio * Config::get('artecol.iva', 0) * 0.01), 2)}} </div>
  </div>
</body>
</html>