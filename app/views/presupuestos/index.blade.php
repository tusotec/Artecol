@extends ('layout')

@section ('content')

<?php 
  
  $table = array();

  $table['names'] = array(
    'ID',
    'Fecha',
    'Cliente',
    'Precio',
    'Modulos',
    'Mostrar'
  );

  $table['function'] = function ($presupuesto) {
    return array(
      $presupuesto->id,
      $presupuesto->fecha,
      $presupuesto->cliente->nombre,
      precio($presupuesto->precio),
      $presupuesto->modulos()->count(),
      link_to(route('presupuestos.show', $presupuesto->id), 'Mostrar')
    );
  };

  $table['data'] = $presupuestos;

 ?>

@include ('table')

@stop