<?php

class ModuloPresupuesto extends Eloquent {
  protected $table = 'modulos_presupuestos';
  protected $fillable = array(
    'precio', 'cantidad', 'modulo_id', 'posicion', 'alto', 'ancho','profundo'
  );

  public function modulo () {
    return $this->belongsTo('Modulo', 'modulo_id');
  }

  public function presupuesto () {
    return $this->belongsTo('Presupuesto', 'presupuesto_id');
  }

  public function nombre () {
    return $this->modulo->nombreCompleto();
  }

  public function precioActual () {
    
  }

}