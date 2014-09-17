@extends ('layout')

@section ('header')
<style type="text/css">
.big th, .big, table, th { border:1px solid; }
.big td, .small th, td { border:1px solid lightgray; }
.small { border-collapse: collapse; }
</style>
@stop

@section ('content')
Listando los Modulos: <br>

<?php 
  $table = array();

  $table['names'] = array(
    'Nombre',
    'Categoria',
    'Alto',
    'Ancho',
    'Profundo',
    'Ganancia',
    'Precio',
    'Materiales',
    'Opciones',
  );

  $table['function'] = function ($modulo) {
    return array(
      $modulo->nombre,
      $modulo->categoria->nombre,
      $modulo->alto,
      $modulo->ancho,
      $modulo->profundo,
      $modulo->ganancia,
      number_format($modulo->precio(), 2),
      $modulo->vinculaciones()->count(),
      link_to(route('modulos.edit', $modulo->id), 'Editar'),
    );
  };

  $table['data'] = $modulos;

 ?>

@include ('table')

{{link_to(route('modulos.create'), 'Nuevo Modulo')}}
@stop