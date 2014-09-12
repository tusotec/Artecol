@extends ('layout')

@section ('header')
<script type="text/javascript">
$().ready(setform);

function enable (object, value) {
  object.attr('disabled', !value)
  object.find('*').attr('disabled', !value);
  object.toggle(value);
}
function setform () {
  var per = $('#persona').find('option:selected').val();
  enable($('#n'), per == 'n');
  enable($('#j'), per == 'j');
}
</script>

<?php 
  function input ($name, $display = null) {
    if ($display == null) {
      $display = ucfirst($name);
    }
    $data = array('name' => "cliente[$name]");
    return Form::text($name, null, $data) . Form::label($name, $display) . '<br>';
  }

  if ($cliente->exists) {
    $route = ['clientes.update', $cliente->id];
  } else {
    $route = 'clientes.store';
  }
 ?>
@stop

@section ('content')
<h1>Nuevo Cliente</h1>
{{Form::model($cliente, ['route' => $route])}}
  <select name="cliente[persona]" onchange="setform()" id="persona">
    <option value='n'>Natural</option>
    <option value='j'>Juridico</option>
  </select> Persona<br>
  <div id="j">
    {{input('nombre')}}
    {{input('identificacion', 'CC')}}
    {{input('direccion')}}
    {{input('telefono', 'Teléfono')}}
    {{input('email', 'Correo Electrónico')}}
    @if (!$cliente->exists)
      <strong>Representante</strong><br>
      <input name="representante[persona]" value="r" type="hidden">
      <input name="representante[nombre]" type="text"> Nombre<br>
      <input name="representante[apellido]" type="text"> Apellido<br>
      <input name="representante[celular]" type="text"> Celular<br>
    @endif
  </div>

  <div id="n">
    {{input('nombre')}}
    {{input('apellido')}}
    {{input('identificacion', 'RUT')}}
    {{input('direccion')}}
    {{input('telefono', 'Teléfono')}}
    {{input('email', 'Correo Electrónico')}}
    {{input('celular')}}
  </div>
  {{Form::submit('Aceptar')}}
{{Form::close()}}
@stop