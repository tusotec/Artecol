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
@stop

@section ('content')
<h1>Nuevo Cliente</h1>
{{Form::open(['route' => 'clientes.store'])}}
  <select name="cliente[persona]" onchange="setform()" id="persona">
    <option value='n'>Natural</option>
    <option value='j'>Juridico</option>
  </select> Persona<br>
  <div id="j">
    <input name="cliente[nombre]" type="text"> Nombre<br>
    <input name="cliente[identificacion]" type="text"> CC<br>
    <input name="cliente[direccion]" type="text"> Direccion<br>
    <input name="cliente[telefono]" type="text"> Teléfono<br>
    <input name="cliente[email]" type="text"> Correo Electrónico<br>
    <strong>Representante</strong><br>
    <input name="representante[persona]" value="r" type="hidden">
    <input name="representante[nombre]" type="text"> Nombre<br>
    <input name="representante[apellido]" type="text"> Apellido<br>
    <input name="representante[celular]" type="text"> Celular<br>
  </div>

  <div id="n">
    <input name="cliente[nombre]" type="text"> Nombre<br>
    <input name="cliente[apellido]" type="text"> Apellido<br>
    <input name="cliente[identificacion]" type="text"> RUT<br>
    <input name="cliente[direccion]" type="text"> Direccion<br>
    <input name="cliente[telefono]" type="text"> Teléfono<br>
    <input name="cliente[email]" type="text"> Correo Electrónico<br>
    <input name="cliente[celular]" type="text"> Celular<br>
  </div>
  {{Form::submit('Aceptar')}}
{{Form::close()}}
@stop