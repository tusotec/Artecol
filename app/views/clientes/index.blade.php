@extends ('layout')

@section ('header')
<style type="text/css">
table, th { border:1px solid; }
td { border:1px solid lightgray; }
</style>
@stop

@section ('content')
<h1>Clientes</h1>
<?php 
  
  $table = array();

  $table['names'] = array(
    'Nombre',
    'Apellido',
    'Identificacion',
    'Persona',
    'Opciones',
  );

  $table['function'] = function ($cliente) {
    return array(
      $cliente->nombre,
      $cliente->apellido,
      $cliente->identificacion,
      $cliente->personaCompleto(),
      link_to(route('clientes.show', $cliente->id), 'Ver').' '.
      link_to(route('clientes.edit', $cliente->id), 'Editar'),
    );
  };

  $table['data'] = $clientes;

 ?>

@include ('table')

<div class="buscar">
  {{Form::open(['route' => Route::currentRouteName(), 'method' => 'get'])}}
    <select name="searchkey">
      <option value="nombre">Nombre</option>
      <option value="apellido">Apellido</option>
      <option value="identificacion">Identificacion</option>
    </select>
    <input type="text" name="searchvalue">
    {{Form::submit('Buscar')}}
  {{Form::close()}}
</div>

{{link_to(route('clientes.create'), 'Nuevo Cliente')}}

@stop