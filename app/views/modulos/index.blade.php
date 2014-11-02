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
    ['Medidas', 3],
    'Precio',
    'Precio Unitario',
    'Medicion',
    'Materiales',
    ['Opciones', 3]
  );

  $table['function'] = function ($modulo) {
    return array(
      $modulo->nombre,
      $modulo->categoria->nombre,
      round($modulo->alto, 2),
      round($modulo->ancho, 2),
      round($modulo->profundo, 2),
      number_format($modulo->precio(), 2),
      number_format($modulo->precioUnitario(), 2),
      $modulo->medicion,
      $modulo->vinculaciones()->count(),
      link_to(route('modulos.show', $modulo->id), 'Detalles'),
      link_to(route('modulos.edit', $modulo->id), 'Editar'),
      Form::open([
        'route' => ['modulos.destroy', $modulo->id],
        'method' => 'delete',
        'onsubmit' => 'return confirm("Borrar Modulo?");'
        ]).
      Form::submit('Eliminar').
      Form::close(),
    );
  };

  $table['data'] = $modulos;

 ?>

@include ('table')

{{link_to(route('modulos.create'), 'Nuevo Modulo')}}
@stop