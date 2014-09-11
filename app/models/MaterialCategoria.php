<?php

class MaterialCategoria extends Eloquent {
  protected $table = 'materiales_categorias';
  protected $fillable = array('nombre', 'tipo', 'descripcion');

  public function materiales () {
    return $this->hasMany('Material', 'categoria_id');
  }

}