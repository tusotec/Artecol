<?php

class Modulo extends ModelBase {
  protected $table = 'modulos';
  protected $fillable = array(
    'nombre', 'categoria_id', 'medida_1', 'medida_2', 'cantidad','alto', 'ancho', 'profundo', 'ganancia'
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

}