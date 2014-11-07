@extends ('layout')

@section ('content')

  <?php 
    if ($categoria->exists) {
      $route = ['modulos_categorias.update', $categoria->id];
    } else {
      $route = 'modulos_categorias.store';
    }
   ?>

  {{Form::model($categoria, ['route' => $route, 'id' => 'form'])}}
    <?php MyForm::setModel('categoria', false); ?>
    {{MyForm::input('text', 'nombre')}}
    {{Form::submit('Crear Categoria')}}
  {{Form::close()}}

@stop