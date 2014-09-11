<?php 

function arnaInput ($object, $name, $display, $data = array('onkeyup' => 'update()')) {
  $name = $object.'['.$name.']';
  return '<label>'.Form::text($name, null, $data).$display.'</label><br>';
}

