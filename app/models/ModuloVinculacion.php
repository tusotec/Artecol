<?php

class ModuloVinculacion extends Eloquent {
  protected $table = 'modulos_vinculaciones';
  protected $fillable = array('cantidad', 'material_id', 'medida_1', 'medida_2');

  public function modulo () {
    return $this->belongsTo('Modulo', 'modulo_id');
  }
  public function material () {
    return $this->belongsTo('Material', 'material_id');
  }
  public function nombre () {
    return $this->material->nombre;
  }

}