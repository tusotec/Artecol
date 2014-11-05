@extends ('layout')

@section ('header')
<script type="text/javascript">

  var vincNum = 0;

  $().ready(function(){
    changeForm();
    $('input').on('keyup',update);
    init();
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
        val = ( precio / v('cantidad') )/ v('metro');
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
    val = (val * p('desperdicio'))* p('flete');
    $('#costo').val(val);
  }

  function changeForm () {
    var selected = $('#tipo option:selected').attr('tipo');
    var sections = $('form > .mat');
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
    return vinc;
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

  function init () {
    var data = {{json_encode($material->vinculaciones)}}
    for (var vinc in data) {
      var m_data = data[vinc];
      var mat = addVinc();
      mat.find('.v-cantidad').val(m_data['cantidad']);
      mat.find('.v-hijo').val(m_data['hijo_id']);
      console.log(m_data);
    }
    update();
  }
</script>

<?php

  if ($material->exists) {
    $form_route = ['materiales.update', $material->id];
  } else {
    $form_route = 'materiales.store';
  }

  function input ($name, $display, $data = []) {
    if (!isset($data['value']) || $data['value'] == null) {
      $data['value'] = "";
    }
    $r_val = Form::getValueAttribute($name);
    $data['value'] = ($r_val == null) ? $data['value'] : $r_val;
    $data['class'] = $name;
    $name = "material[$name]";
    return  '<div class="input-field">' .
            Form::label($name, $display) .
            Form::text($name, $data['value'], $data) .
            '</div>';
  }
?>

@stop

@section ('content')



<div id="vincbase" style="display:none;" class="vinculacion input-row">
  <div class="input-field">
    <select name="vinculaciones[#id][hijo_id]" onchange="update()" class="v-hijo">
      @foreach (Material::all() as $mat)
        <option value="{{$mat->id}}" costo="{{$mat->costo}}">{{$mat->nombre}}</option>
      @endforeach
    </select>
  </div>
  <div class="input-field">
    <label for="vinculaciones[#id][cantidad]">Cantidad</label>
    <input name="vinculaciones[#id][cantidad]" type='text' onkeyup="update()" class="v-cantidad">
  </div>
  <div class="input-field">
    <button type="button" onclick="delVinc(this)">Quitar</button>
  </div>
</div>
<table class="table-bordered form-vertical"> <tr><td>
<h1>Nuevo Material ELE</h1>

{{ Form::model($material, ['route' => $form_route, 'onsubmit' => 'return isValid();']) }}
  <div class="input-row">
    <select id="tipo" name="material[categoria_id]" onchange="changeForm()">
      @foreach (MaterialCategoria::all() as $categoria)
        <option value="{{$categoria->id}}" tipo="{{$categoria->tipo}}" <?php 
        if($material->categoria == $categoria) {echo 'selected';}
         ?>>{{$categoria->nombre}}</option>
      @endforeach
    </select>
    {{ input('nombre', 'Nombre') }}
    {{ input('precio_compra','Precio de Compra') }}
    {{ input('flete','% Flete', ['value' => '0', 'onkeyup' => 'update()']) }}
    {{ input('costo', 'Costo', ['id' => 'costo', 'readonly' => 'readonly'] ) }}
  </div>

  <div id="lamina" class="mat input-row">
    <h4>Lamina</h4>
    {{input('ancho','Ancho')}}
    {{input('alto','Alto')}}
    {{input('desperdicio','% Desperdicio', ['value' => '0'])}}
  </div>
  <div id="liquido" class="mat input-row">
    <h4>Liquido</h4>
    {{input('cantidad','Litros')}}
    {{input('metro','Metro Cuadrado')}}
  </div>
  <div id="metro" class="mat input-row">
    <h4>Metro</h4>
    {{input('cantidad','Metros')}}
  </div>
  <div id="paquete" class="mat input-row">
    <h4>Paquete</h4>
    {{input('cantidad','Cantidad')}}
  </div>
  <div id="unidad" class="mat input-row">
    <h4>Unidad</h4>
  </div>
  <div id="compuesto" class="mat input-row">
    <h4>Compuesto</h4>
    <button type="button" onclick="addVinc()">Añadir</button>
  </div>

  {{ Form::submit('Aceptar') }}
{{ Form::close() }}
</td></tr></table>
@stop