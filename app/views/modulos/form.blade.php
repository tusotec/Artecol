@extends ('layout')

@section ('header')
<script type="text/javascript">

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

  function precio () {
    var val = 0;
    $('#materiales > div').each(function (i, e) {
      e = $(e);
      var mat = e.find('#matsel option:selected');
      var lval = parseFloat(mat.attr('costo'));
      lval *= parseFloat(e.find('[name*="cantidad"]').val());
      var lmult = e.find('[name*="medida_2"]').val();
      lmult = (lmult==undefined) ? 1 : parseFloat(lmult);
      lmult *= parseFloat(e.find('[name*="medida_1"]').val());
      lval *= lmult;
      val += lval;
    });
    $('#precio').text(val);
  }
</script>

<?php

  function input ($name, $display, $data = array()) {
    $data['class'] = $name;
    $data['onkeyup'] = 'precio()';
    $name = "modulo[$name]";
    return Form::text($name, null, $data) . Form::label($name, $display) . '<br>';
  }

  function matInput ($name, $display, $data = array()) {
    $data['class'] = $name;
    $data['onkeyup'] = 'precio()';
    //$name = "material[#id][$name]";
    return Form::text($name, null, $data) . Form::label($name, $display) . '<br>';
  }

?>

@stop

@section ('content')
<div id="mat_p_cat" style="display: none;">
  @foreach ($mat_cat as $categoria)
    <select name="material_id" id="matsel_{{$categoria->id}}">
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
    {{matInput('medida_1', 'Cantidad')}}
  </div>
  <div id="tipo_metro">
    Mediciones de Metro!!!<br>
    {{matInput('medida_1', 'Metros')}}
  </div>
</div>
<div id="mat" style="border:1px solid black; display: none;" style="display: none;">
  <select id="catsel" onchange="selcat(this)">
    @foreach ($mat_cat as $categoria)
      <option value="{{$categoria->id}}" tipo="{{$categoria->tipo}}">{{$categoria->nombre}}</option>
    @endforeach
  </select>
  Categoria <br>
  {{matInput('cantidad', 'Cantidad', ['value' => '1'])}}

</div>

<h1>Crear Modulo</h1>
{{ Form::open(['route' => 'modulos.store', 'onsubmit' => 'return count > 0;']) }}
  {{input('nombre','Nombre')}}
  <select name="modulo[categoria_id]">
    @foreach (ModuloCategoria::all() as $categoria)
      <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
    @endforeach
  </select> Categoria <br>
  {{input('ganancia','% Ganancia')}}


  {{input('alto','Alto')}}
  {{input('ancho','Ancho')}}
  {{input('profundo','Profundo')}}
  <strong>Precio: </strong><span id="precio"></span><br>

  <h3>Materiales</h3>
  <div id="materiales"> </div>
  <button type="button" onclick="addMaterial()">Agregar Material</button>
  {{Form::submit('Aceptar')}}
{{ Form::close() }}
@stop