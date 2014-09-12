@extends ('layout')

@section ('content')
<h1>Cliente {{$cliente->identificacion}}</h1>
<?php 
  function dato ($key, $value) {
    return "<tr><th>$key </th><td>$value </td><tr>";
  }
 ?>
<table>
  {{dato('Nombre', $cliente->nombre)}}
  {{dato('Apellido', $cliente->apellido)}}
  {{dato('Persona', $cliente->personaCompleto())}}
  {{dato('Identificacion', $cliente->identificacion)}}
  {{dato('Dirección', $cliente->direccion)}}
  {{dato('Teléfono', $cliente->telefono)}}
  {{dato('Email', $cliente->email)}}
  {{dato('Celular', $cliente->celular)}}
  {{dato('Sexo', $cliente->sexo)}}
</table>
@stop