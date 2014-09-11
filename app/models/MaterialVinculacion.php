<?php

class MaterialVinculacion extends Eloquent {
  protected $table = 'materiales_vinculaciones';
  protected $fillable = array('cantidad', 'hijo_id');

  public function padre () {
    return $this->belongsTo('Material', 'padre_id');
  }
  public function hijo () {
    return $this->belongsTo('Material', 'hijo_id');
  }

}