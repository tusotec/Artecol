<?php

class Material extends ModelBase {
  protected $table = 'materiales';
  protected $fillable = array(
    'nombre', 'costo', 'precio_compra', 'flete', 'descripcion',
    'alto', 'ancho', 'cantidad', 'rendimiento', 'desperdicio',
    'categoria_id'
  );

  public function vinculaciones () {
    return $this->hasMany('MaterialVinculacion', 'padre_id');
  }

  public function categoria () {
    return $this->belongsTo('MaterialCategoria', 'categoria_id');
  }

}