<?php

class ModuloCategoria extends Eloquent {
  protected $table = 'modulos_categorias';
  protected $fillable = array('nombre', 'descripcion');

  public function modulos () {
    return $this->hasMany('Modulo', 'categoria_id');
  }

}