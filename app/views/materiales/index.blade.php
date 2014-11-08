@extends ('layout')

@section ('header')

<style type="text/css">
.big th, .big, table, th { border:1px solid; }
.big td, .small th, td { border:1px solid lightgray; }
.small { border-collapse: collapse; }
</style>

<?php 

  function order_link ($name, $display) {
    return link_to(route('materiales.index', ['order' => $name]), $display);
  }

 ?>

@stop

@section ('content')

<?php 

  $table = array();

  $table['names'] = array(
    'Nombre',
    'Categoria',
    'Precio de Compra',
    'Costo',
    'Flete',
    'Alto',
    'Ancho',
    'Cantidad',
    'Rendimiento',
    'Desperdicio',
    'Vinculaciones',
    'Editar',
    'Borrar',
  );

  $table['order'] = array(
    'Nombre' => 'nombre',
    'Precio de Compra' => 'precio_compra',
    'Costo' => 'costo',
  );

  $table['function'] = function ($material) {
    $boton_borrar = "";
    $boton_borrar .= Form::model($material, ['route' => 'materiales.destroy', 'method' => 'delete']);
    $boton_borrar .= Form::hidden('id', $material->id);
    $boton_borrar .= Form::submit('Eliminar');
    $boton_borrar .= Form::close();
    return array(
      $material->nombre,
      $material->categoria->nombre,
      precio($material->precio_compra),
      precio($material->costo),
      $material->flete,
      round($material->alto, 4),
      round($material->ancho, 4),
      $material->cantidad,
      round($material->rendimiento, 4),
      $material->desperdicio,
      $material->vinculaciones()->count(),
      link_to(route('materiales.edit', $material->id), 'Editar'),
      $boton_borrar,
    );
  };

  $table['data'] = $materiales;
 ?>

@include ('table')

{{link_to(route('materiales.create') ,'Nuevo Material')}}

<div class="buscar">
  {{Form::open(['route' => Route::currentRouteName(), 'method' => 'get'])}}
    <input type="text" name="searchvalue">
    {{Form::submit('Buscar')}}
  {{Form::close()}}
</div>

@stop