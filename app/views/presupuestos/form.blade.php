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
  }
  function update (obj) {
    var parent = $(obj).parent();
    var val = parseFloat(parent.find('#m_sel option:selected').attr('precio'));
    val *= parseFloat(parent.find('#m_cant').val());
    parent.find('#m_precio').val(val);

    var precio = 0;
    $('#modulos div').each(function (i, e) {
      e = $(e);
      precio += parseFloat(e.find('#m_precio').val());
    });
    $('#p_precio').val(precio);
  }
</script>
@stop

@section ('content')

<div id="modulo" style="display:none;">
  <select id="m_sel" name="modulos[#id][modulo_id]" onchange="update(this)">
    @foreach (Modulo::all() as $modulo) {
      <option value="{{$modulo->id}}" precio="{{$modulo->precio()}}">{{$modulo->nombre}}</option>
    @endforeach
  </select>
  <input id="m_cant" name="modulos[#id][cantidad]" type="text" onkeyup="update(this)"> Cantidad <br>
  <input name="modulos[#id][posicion]" type="text"> Posicion <br>
  <input id="m_precio" name="modulos[#id][precio]" type="text" readonly="readonly"> Precio <br>
</div>

<h1>Nuevo Presupuesto</h1>

{{Form::open(['route' => 'presupuestos.store'])}}
  
  <select name="presupuesto[cliente_id]">
    @foreach (Cliente::all() as $cliente) {
      <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
    @endforeach
  </select>
  Cliente<br>
  <input name="presupuesto[fecha]" type="date">Fecha<br>
  <input id="p_precio" name="presupuesto[precio]" type="text" readonly="readonly">Precio<br>

  <button type="button" onclick="addMod()">Añadir Modulo</button>
  <div id="modulos">
  </div>

  {{Form::submit('Aceptar')}}
{{Form::close()}}

@stop