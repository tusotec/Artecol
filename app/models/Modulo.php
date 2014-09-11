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
      $lval = $vinc->material->costo;
      $lval *= $vinc->cantidad;
      $lval *= $vinc->medida_1 * $vinc->medida_2;
      $val += $lval;
    }
    $val += $val * ($this->ganancia / 100);
    return $val;
  }

  public function nombreCompleto () {
    $cat = $this->categoria;
    if ($cat != null) {
      return $cat->nombre . ' - ' . $this->nombre;
    }
    return $this->nombre;
  }

}