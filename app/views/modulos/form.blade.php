@extends ('layout')

@section ('header')
<script type="text/javascript">

  $().ready(function () {
    initMats();
  });

  var count = 0;

  function debug (obj) {
    alert(JSON.stringify(obj));
  }

  //Devuelve la lista de materiales (jquery) de la categoria Selected (String)
  function catMats (selected) {
    var selected_material = $('#matsel_'+selected).clone();
    selected_material.attr('id', 'matsel');
    return selected_material;
  }

  //Devuelve la seccion (jquery) asociada al tipo (string)
  function selTipo (tipo) {
    var secName;
    switch (tipo) {         //seleccionar el nombre de la extension.
      case 'lamina':
      case 'liquido':
      case 'compuesto':     //si el tipo es lamina, liquido o compuesto, la seccion es m2.
        secName = 'm2';
        break;
      case 'paquete':
      case 'unidad':
        secName = 'unidad'
        break;
      case 'metro':
        secName = 'metro'
        break;
    }
    var section = $('#tipo_'+secName).clone();   //seleccionar objeto jquery de acuerdo al nombre
    section.attr('id', 'tipo');
    return section;
  }

  //Devuelve un objeto con los datos importantes de la categoria seleccionada
  //Requiere la seccion del material (jquery)
  function selectedCategory (obj) {
    var selected = obj.find('#catsel option:selected');   //objeto jquery seleccionado
    var object = {'value':selected.val(), 'tipo':selected.attr('tipo')};
    return object;
  }

  function selcat (obj) {
    obj = $(obj).parent();
    var selected = selectedCategory(obj);      //categoria seleccionada.
    var matsel = catMats(selected['value']);   //lista de materiales de la categoria.
    var tipo = selTipo(selected['tipo']);      //seleccionar la seccion de detalles asociada al tipo de categoria

    obj.children('#matsel').remove();
    obj.append(matsel);       //remplazar la lista de materiales

    obj.children('#tipo').remove();
    obj.append(tipo);         //remplazar la seccion de detalles

    var mat = obj.attr('id').replace('mat_','materiales[') + '][';
    var matId = obj.attr('id').replace('mat_','');
    obj.find('[name]').not('[name^="materiales"]').each(function (i,e) {
      e = $(e);
      var name = e.attr('name');
      name = mat + name + ']';
      e.attr('name', name)
    });
    //obj.find('input').on('keyup', precio);
    obj.find('select').on('change', precio);
  }

  function addMaterial () {
    count++;
    var mat = $('#mat').clone();
    mat.toggle(true);
    mat.attr('id', 'mat_'+count);
    $('#materiales').append(mat);
    mat.find('#catsel').trigger('change');
    return mat;
  }

  function m2Helper (obj) {
    obj = $(obj);
    var parent = obj.parent();
    var name = obj.attr('mn').replace('sel', 'medida_');
    var sel = obj.find('option:selected');
    var medida = parent.find('[name*="' + name + '"]');
    if (sel.val() == 'personalizado') {
      medida.attr('readonly', false);
    } else {
      medida.attr('readonly', true);
      var val = parseFloat($('[name="' + sel.val() + '"]').val());
      medida.val(val);
    }
  }

  function percent () {
    var val = parseFloat($('.ganancia').val());
    if (isFinite(val)) {
      return val * 0.01;
    }
    return 0;
  }

  function set_val (name, e, val) {
    name = '[name*="x"]'.replace('x', name);
    e.find(name).val(val);
  }

  function val_or_none (name, e) {
    name = '[name*="x"]'.replace('x', name);
    val = e.find(name).val();
    val = parseFloat(val);
    return val;
  }

  function val_or_one (name, e) {
    val = val_or_none(name, e);
    return isFinite(val) ? val : 1;
  }

  function precio () {
    var val = 0;
    $('#materiales > div').each(function (i, e) {
      e = $(e);
      var mat = e.find('#matsel option:selected');
      var lval = parseFloat(mat.attr('costo'));
      console.log('costo: '+lval);
      lval *= val_or_none('cantidad', e);
      lval *= val_or_one('medida_1', e);
      lval *= val_or_one('medida_2', e);
      console.log('precio total: '+lval);

      val += lval;
    });
    val += val * percent();
    $('#precio').text(val.toFixed(2));
  }

  function isValid () {
    var val = true;
    val = val && count > 0;
    val = val && isFinite($('#precio').text());
    return val;
  }

  function removeMat (e) {
    var mat = $(e).closest('.mat');
    mat.remove();
  }

  function initMat (mat, data) {
    //mat.find('#catsel').val(count);
    //alert(JSON.stringify(data));
    var cat = searchCatWith(data['material_id']);
    mat.find('#catsel').val(cat);
    selcat(mat.find('#catsel'));
    mat.find('.matsel').val(data['material_id']);

    mat.find('.cantidad').val(data['cantidad'])
    mat.find('.medida_1').val(data['medida_1'])
    mat.find('.medida_2').val(data['medida_2'])
    mat.find('.id').val(data['id'])
  }

  function searchCatWith (matId) {
    var cats = $('#mat_p_cat .matsel').has('option[value="'+matId+'"]');
    var catid = cats.attr('id').replace('matsel_', '');
    console.log(catid);
    return catid;
  }

  function initMats () {
    var data = {{json_encode($modulo->vinculaciones)}}

    for (var vinc in data) {
      //alert(JSON.stringify(data[vinc]));
      initMat(addMaterial(), data[vinc]);
    }
    precio();
  }
</script>

<?php

  if ($modulo->exists) {
    $form_route = ['modulos.update', $modulo->id];
  } else {
    $form_route = 'modulos.store';
  }

  function input ($name, $display, $data = array()) {
    $data['class'] = $name;
    $data['onkeyup'] = 'precio()';
    $value = Form::getValueAttribute($name);
    $f_name = "modulo[$name]";
    return Form::text($f_name, $value, $data) . Form::label($f_name, $display) . '<br>';
  }

  function matInput ($name, $display, $data = array()) {
    $data['class'] = $name;
    $data['onkeyup'] = 'precio()';

    //$name = "material[#id][$name]";
    return Form::text($name, 1, $data) . Form::label($name, $display) . '<br>';
  }

  $mediciones = array(
    "Fijo" => "fijo",
    "Ancho" => "ancho",
    "Ancho - Alto" => "ancho-alto",
    "Ancho - Profundo" => "ancho-profundo",
    "Metro Cubico" => "m3"
  );

?>

@stop

@section ('content')

<div id="mat_p_cat" style="display: none;">
  @foreach ($mat_cat as $categoria)
    <select name="material_id" id="matsel_{{$categoria->id}}" class="matsel">
      @foreach ($categoria->materiales as $material)
        <option value="{{$material->id}}" costo="{{$material->costo}}">{{$material->nombre}}</option>
      @endforeach
    </select>
  @endforeach
</div>

<div id="op_p_tipo" style="display: none;">
  <div id="tipo_m2">
    Mediciones de M2!!!<br>
    <select mn="sel1" onchange="m2Helper(this)">
      <option value="modulo[alto]">Alto</option>
      <option value="modulo[ancho]">Ancho</option>
      <option value="modulo[profundo]">Profundo</option>
      <option value="personalizado" selected="selected">Personalizado</option>
    </select>
    {{matInput('medida_1', 'Alto')}}
    <select mn="sel2" onchange="m2Helper(this)">
      <option value="modulo[alto]">Alto</option>
      <option value="modulo[ancho]">Ancho</option>
      <option value="modulo[profundo]">Profundo</option>
      <option value="personalizado" selected="selected">Personalizado</option>
    </select>
    {{matInput('medida_2', 'Ancho')}}
  </div>
  <div id="tipo_unidad">
    Mediciones de Unidad!!!<br>
  </div>
  <div id="tipo_metro">
    Mediciones de Metro!!!<br>
    {{matInput('medida_1', 'Metros')}}
  </div>
</div>

<div id="mat" class="mat" style="border:1px solid black; display: none;" style="display: none;">
  {{Form::hidden('id', null, ['class' => 'id'])}}
  <select id="catsel" onchange="selcat(this)">
    @foreach ($mat_cat as $categoria)
      @if ($categoria->materiales()->count() > 0)
        <option value="{{$categoria->id}}" tipo="{{$categoria->tipo}}">{{$categoria->nombre}}</option>
      @endif
    @endforeach
  </select>
  Categoria <br>
  {{matInput('cantidad', 'Cantidad')}}
  <button type="button" onclick="removeMat(this)">Quitar</button>
</div>

<table class="table-bordered form-vertical"> <tr><td>
<h1>Crear Modulo</h1>

{{ Form::model($modulo, ['route' => $form_route, 'onsubmit' => 'return isValid();']) }}
  {{input('nombre','Nombre')}}
  <select name="modulo[categoria_id]">
    @foreach (ModuloCategoria::all() as $categoria)
      <option value="{{$categoria->id}}" <?php
      if($modulo->categoria == $categoria) {echo 'selected';}
      ?> >{{$categoria->nombre}}</option>
    @endforeach
  </select> Categoria <br>
  <select name="modulo[medicion]">
    @foreach ($mediciones as $key => $value)
      <option value="{{$value}}" <?php
      if($modulo->medicion == $value) {echo 'selected';}
      ?> >{{$key}}</option>
    @endforeach
  </select> Medicion <br>
  {{input('ganancia','% Ganancia')}}


  {{input('alto','Alto')}}
  {{input('ancho','Ancho')}}
  {{input('profundo','Profundo')}}
  <strong>Precio: </strong><span id="precio"></span><br>

  @if (true)
    <h3>Materiales</h3>
    <div id="materiales"> </div>
    <button type="button" onclick="addMaterial()">Agregar Material</button>
  @endif
  {{Form::submit('Aceptar')}}
{{ Form::close() }}
</td></tr></table>
@stop