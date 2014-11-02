<?php

class Modulo extends ModelBase {
  protected $table = 'modulos';
  protected $fillable = array(
    'nombre', 'categoria_id', 'medida_1', 'medida_2', //creo que medida_1 y medida_2 son innecesarios
    'cantidad','alto', 'ancho', 'profundo', 'ganancia', 'medicion'
  );

  public function vinculaciones () {
    return $this->hasMany('ModuloVinculacion', 'modulo_id');
  }

  public function categoria () {
    return $this->belongsTo('ModuloCategoria', 'categoria_id');
  }

  public function precio () {
    $val = 0;
    foreach ($this->vinculaciones as $vinc) {
      $lval = $vinc->precio();
      $val += $lval;
    }
    $val += $val * ($this->ganancia * 0.01);
    return $val;
  }

  private function mult ($v1, $v2) {
    if ($v2==0 || $v2==null) {$v2 = 1;}
    return $v1 * $v2;
  }

  public function nombreCompleto () {
    $cat = $this->categoria;
    if ($cat != null) {
      return $cat->nombre . ' - ' . $this->nombre;
    }
    return $this->nombre;
  }

  public function precioUnitario () {
    $val = $this->precio();
    switch ($this->medicion) {
      case 'ancho':
        $val = $val/($this->ancho);
        break;
      case 'alto':
        $val = $val/($this->alto);
        break;
      case 'profundo':
        $val = $val/($this->profundo);
        break;
      case 'ancho-alto':
      case 'alto-ancho':
        $val = $val/($this->ancho * $this->alto);
        break;
      case 'ancho-profundo':
      case 'profundo-ancho':
        $val = $val/($this->ancho * $this->profundo);
        break;
      case 'alto-profundo':
      case 'profundo-alto':
        $val = $val/($this->alto * $this->profundo);
        break;
      case 'm3':
        $val = $val/($this->ancho * $this->alto * $this->profundo);
        break;
    }
    return $val;
  }

}