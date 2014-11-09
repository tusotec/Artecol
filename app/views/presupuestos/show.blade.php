<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Presupuesto {{$presupuesto->id}}</title>
  <style type="text/css">
    div {
      margin: 2px;
      padding: 2px;
      border: 0px solid blue;
    }
    table, td, th {
      padding: 0px;
      border: 1px solid red;
      border-collapse: collapse;t
    }
    #encabezado {
     background-color: blue;
	  background-image: url(./images/header-presupuesto.png);
      height: 110px;
	  
    }
	#data_superior ,  #data_superior #id , #data_superior #fecha {
	padding: 2px;
      border: 0px solid green;
	}
	#data_superior #id{
	width: 50px;
	float: left;
	}
	 #data_superior #fecha {
	
	 width: 200px;
	 float: left;
	 padding: 0px;
	 
	 }
	#data_inferior {
	text-align: right;
	}
  </style>
</head>
<body>
<div id="encabezado"></div>
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
  <div id="texto-intro"><strong>Apreciado señor:</strong><br><br>

 Por medio de la presente nos permitimos cotizar  los siguientes Muebles, 

elementos y servicios:
  
  </div>
  <div id="modulos">
    <table width="100%">
      <tr>
        <th is="id" width=5px>id</th>
        <th id="cantidad" width=15px >Cantidad</th>
		 <th id="nombre" width=400px>Nombre</th>
        <th id="precio " width=100px>Precio</th>
        <th id="medidas" colspan="3">Medidas</th>
      </tr>
      <?php $cuenta = 0; ?>
      @foreach ($presupuesto->modulos as $modulo)
        <tr>
          <td id="id">{{$cuenta++}}</td>
		  <td id="cantidad">{{$modulo->cantidad}}</td>
          <td id="nombre">{{$modulo->nombre()}}</td>
          <td id="precio">{{precio($modulo->precio)}}</td>
          <td id="alto">{{$modulo->alto}}</td>
          <td id="ancho">{{$modulo->ancho}}</td>
          <td id="profundo">{{$modulo->profundo}}</td>
        </tr>
      @endforeach
    </table>
  </div>
  <div id="data_inferior">
    <?php $precio = $presupuesto->precio; ?>
    <div id="precio">Precio: {{precio($precio)}} </div>
    <div id="precio_iva">Precio+IVA: 
    {{precio($precio + ($precio * Config::get('artecol.iva', 0) * 0.01))}} </div>
  </div>
</body>
</html>