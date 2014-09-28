@extends ('layout')

@section ('header')
<script type="text/javascript">

  var vincNum = 0;

  $().ready(function(){
    changeForm();
  });
  //m = Material
  function m (data) {
    return $('.data[disabled!="true"][disabled!="disabled"]'.replace('data', data));
  }
  //v = Value
  function v (data) {
    return parseFloat(m(data).val());
  }

  function percent () {
    var desp = v('desperdicio');
    return (v('flete') + (isFinite(desp)?desp:0)) / 100;
  }

  function p (data) {
    var val = v(data);
    if (!isFinite(val)) {
      return 1;
    }
    return (val / 100) + 1;
  }

  function update () {
    var val;
    var precio = v('precio_compra');
    switch ($('#tipo option:selected').attr('tipo')) {
      case 'lamina':
        val = precio /( v('alto') * v('ancho') );
        break;
      case 'liquido':
        val = precio / v('cantidad') * v('metro');
        break;
      case 'paquete':
        val = precio / v('cantidad');
        break;
      case 'metro':
        val = precio / v('cantidad');
        break;
      case 'unidad':
        val = precio;
        break;
      case 'compuesto':
        val = 0;
        var vincs = $('#compuesto .vinculacion');
        vincs.each(function (i, e) {
          e = $(e);
          var lv = e.children('select').children('option:selected').attr('costo');
          lv = parseFloat(lv);
          lv *= parseFloat(e.children('input').val());
          val += lv;
        });
        break;
    }
    val = val * p('desperdicio') * p('flete');
    $('#costo').val(val);
  }

  function changeForm () {
    var selected = $('#tipo option:selected').attr('tipo');
    var sections = $('form > div');
    sections.each(function (i, e) {
      var section = $(e);
      var value = section.attr('id') == selected;
      section.children().attr('disabled', !value);
      section.toggle(value);
    });
    $('.flete').attr('disabled', selected == 'compuesto');
    $('.precio_compra').attr('disabled', selected == 'compuesto');
  }

  function addVinc () {
    vincNum++;
    var vinc = $('#vincbase').clone();
    vinc.removeAttr('id');
    vinc.children('select').attr('name', 'vinculaciones['+vincNum+'][hijo_id]');
    vinc.children('input').attr('name', 'vinculaciones['+vincNum+'][cantidad]');
    $('#compuesto').append(vinc);
    vinc.toggle(true);
  }

  function delVinc (obj) {
    var parent = $(obj).closest('.vinculacion');
    parent.remove();
  }

  function isValid () {
    var val = m('nombre').val().length > 0;
    val = val && isFinite(parseFloat($('#costo').val()));
    val = val && $('#tipo option:selected').length > 0;
    return val;
  }
</script>

<?php
  function input ($name, $display, $data = array('onkeyup' => 'update()')) {
    if (!isset($data['value'])) {
      $data['value'] = "";
    }
    $data['class'] = $name;
    $name = "material[$name]";
    return Form::text($name, $data['value'], $data) . Form::label($name, $display) . '<br>';
  }
?>

@stop

@section ('content')



<div id="vincbase" style="display:none;" class="vinculacion">
  <select name="vinculaciones[#id][hijo_id]" onchange="update()">
  @foreach (Material::all() as $mat)
    <option value="{{$mat->id}}" costo="{{$mat->costo}}">{{$mat->nombre}}</option>
  @endforeach
  </select>
  <input name='vinculaciones[#id][cantidad]' type='text' onkeyup="update()"> Cantidad <br>
  <button type="button" onclick="delVinc(this)">Quitar</button>
</div>
<table class="table-bordered form-vertical"> <tr><td>
<h1>Nuevo Material</h1>

{{ Form::model($material, ['route' => 'materiales.store', 'onsubmit' => 'return isValid();']) }}
  <select id="tipo" name="material[categoria_id]" onchange="changeForm()">
    @foreach (MaterialCategoria::all() as $categoria)
      <option value="{{$categoria->id}}" tipo="{{$categoria->tipo}}">{{$categoria->nombre}}</option>
    @endforeach
  </select>
  Categoría <br>
  {{ input('nombre', 'Nombre') }}
  {{ input('precio_compra','Precio de Compra') }}
  {{ input('flete','% Flete', ['value' => '0', 'onkeyup' => 'update()']) }}
  {{ input('costo', 'Costo', ['id' => 'costo', 'readonly' => 'readonly'] ) }}

  <div id="lamina">
    <strong>Lamina</strong><br>
    {{input('ancho','Ancho')}}
    {{input('alto','Alto')}}
    {{input('desperdicio','% Desperdicio', ['value' => '0'])}}
  </div>
  <div id="liquido">
    <strong>Liquido</strong><br>
    {{input('cantidad','Litros')}}
    {{input('metro','Metro Cuadrado')}}
  </div>
  <div id="metro">
    <strong>Metro</strong><br>
    {{input('cantidad','Metros')}}
  </div>
  <div id="paquete">
    <strong>Paquete</strong><br>
    {{input('cantidad','Cantidad')}}
  </div>
  <div id="unidad">
    <strong>Unidad</strong><br>
  </div>
  <div id="compuesto">
    <strong>Compuesto</strong><br>
    <button type="button" onclick="addVinc()">Añadir</button>
  </div>

  {{ Form::submit('Aceptar') }}
{{ Form::close() }}
</td></tr></table>
@stop