@extends ('layout')

@section ('header')
<script type="text/javascript">

  var count = 0;

  function addMod () {
    count++;
    var nmod = $('#modulo').clone();
    nmod.attr('id', 'modulo_'+count);
    nmod.find('[name]').each(function (i, e) {
      e = $(e);
      var name = e.attr('name').replace('#id', count);
      e.attr('name', name);
    });
    $('#modulos').append(nmod);
    nmod.toggle(true);
    update(nmod.children(':first'));
  }

  function update (obj) {
    var parent = $(obj).closest('.modulo_div');
    var modulo = parent.find('#m_sel option:selected');
    setMedidas(parent, modulo.attr('medicion'));
    var val = parseFloat(modulo.attr('precio'));
    val *= value(parent.find('#m_cant'));
    val *= getMedida(parent, 'alto');
    val *= getMedida(parent, 'ancho');
    val *= getMedida(parent, 'profundo');
    val = Math.round(val);
    parent.find('#m_precio').val(val);

    var precio = 0;
    $('#modulos .modulo_div').each(function (i, e) {
      e = $(e);
      precio += value(e.find('#m_precio'));
    });
    value($('#p_precio'), precio);
  }

  function getMedida(obj, medida) {
    var med = obj.find('#m_' + medida);
    if (med.attr('disabled')) {
      return 1;
    }
    return value(med);
  }

  function setMedidas (obj, medicion) {
    enableMedida(obj, 'alto', medicion);
    enableMedida(obj, 'ancho', medicion);
    enableMedida(obj, 'profundo', medicion);
  }

  function enableMedida (obj, medicion, medidas) {
    var value = (medidas.indexOf(medicion) > -1) || medidas == 'm3';
    if (value) {
      obj.find('#m_' + medicion + '_div').show();
      obj.find('#m_' + medicion).attr('disabled', false);
    } else {
      obj.find('#m_' + medicion + '_div').hide();
      obj.find('#m_' + medicion).attr('disabled', true);
    }
  }
</script>
@stop

@section ('content')

<div id="modulo" style="display:none; border: 1px solid #ccc;" class="modulo_div">
  <div class="input-row">
    <div class="input-field">
      <select id="m_sel" name="modulos[#id][modulo_id]" onchange="update(this)">
        @foreach (Modulo::all() as $modulo) {
          <option value="{{$modulo->id}}"
          precio="{{$modulo->precioUnitario()}}"
          medicion="{{$modulo->medicion}}">{{$modulo->nombre}}</option>
        @endforeach
      </select>
    </div>
    <div class="input-field">
      <label>Cantidad</label>
      <input id="m_cant" name="modulos[#id][cantidad]" type="text" onkeyup="update(this)">
    </div>

    <div class="input-field">
      <label>Posición</label>
      <input name="modulos[#id][posicion]" type="text">
    </div>

    <div class="input-field">
      <label>Precio</label>
      <input id="m_precio" name="modulos[#id][precio]" type="text" readonly="readonly">
    </div>
  </div>

  <div class="input-row">
    <div id="m_alto_div" class="input-field">
      <label>Alto</label>
      <input id="m_alto" name="modulos[#id][alto]" type="text" onkeyup="update(this.parentNode)">
    </div>
    <div id="m_ancho_div" class="input-field">
      <label>Ancho</label>
      <input id="m_ancho" name="modulos[#id][ancho]" type="text" onkeyup="update(this.parentNode)">
    </div>
    <div id="m_profundo_div" class="input-field">
      <label>Profundo</label>
      <input id="m_profundo" name="modulos[#id][profundo]" type="text" onkeyup="update(this.parentNode)">
    </div>
  </div>
</div>

<table class="table-bordered form-vertical"> <tr><td>
<h1>Nuevo Presupuesto</h1>

{{Form::open(['route' => 'presupuestos.store'])}}
  <div class="input-row">
    <div class="input-field">
      <label>Precio</label>
      <select name="presupuesto[cliente_id]">
        @foreach (Cliente::all() as $cliente) {
          <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
        @endforeach
      </select>
    </div>

    <div class="input-field">
      <label>Precio</label>
      <input name="presupuesto[fecha]" type="date" value="{{date('Y-m-d')}}">Fecha<br>
    </div>

    <div class="input-field">
      <label>Precio</label>
      <input id="p_precio" name="presupuesto[precio]" type="text" readonly="readonly">Precio<br>
    </div>

    <div class="input-field">
      <button type="button" onclick="addMod()">Añadir Modulo</button>
    </div>
  </div>

  <div id="modulos">
  </div>

  {{Form::submit('Aceptar')}}
{{Form::close()}}
</td></tr></table>
@stop