<?php

class Presupuesto extends ModelBase {
  protected $table = 'presupuestos';
  protected $fillable = array(
    'fecha', 'precio', 'observaciones'
  );

  public function modulos () {
    return $this->hasMany('ModuloPresupuesto', 'presupuesto_id');
  }

  public function cliente () {
    return $this->belongsTo('Cliente', 'cliente_id');
  }

}