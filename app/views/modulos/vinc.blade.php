@extends ('layout')

@section('header')
  <script type="text/javascript">
    $().ready(function () {
      selcat();
    });

    function selcat () {
      var selected = 'matsel' + $('#catsel option:selected').val();
      $('#materiales').find('select').each(function (i,e) {
        e = $(e);
        var isThis = e.attr('id') == selected;
        e.toggle(isThis);
        e.attr('disabled', !isThis);
      });
    }
  </script>
@stop

@section ('content')
{{json_encode($vinculacion)}}
<h1> Editar Vinculacion </h1>
<?php
  $id = $vinculacion->exists? $vinculacion->id : 'new';
  $route = array('modulos.vinc.store', $modulo_id, $id);

  function input ($name, $display = null) {
    if ($display == null) {
      $display = str_replace('_', ' ',ucfirst($name));
      return Form::text($name, null, ['name' => "vinculacion[$name]"]) . $display . '<br>';
    }
  }

 ?>
{{Form::model($vinculacion, ['route' => $route])}}
  <select id="catsel" onchange="selcat()">
    @foreach ($mat_cat as $cat)
      <option value="{{$cat->id}}">{{$cat->nombre}}</option>
    @endforeach
  </select>
  <div id="materiales">
    @foreach (MaterialCategoria::all() as $cat)
      <select name="vinculacion[material_id]" id="matsel{{$cat->id}}">
        @foreach ($cat->materiales as $mat)
          <option value="{{$mat->id}}">{{$mat->nombre}}</option>
        @endforeach
      </select>
    @endforeach
  </div>
  {{input('cantidad')}}
  {{input('medida_1')}}
  {{input('medida_2')}}

  {{Form::submit('Aceptar')}}

{{Form::close()}}
@stop