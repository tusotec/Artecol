<?php

class Cliente extends ModelBase {
  protected $table = 'clientes';
  protected $fillable = array(
    'nombre', 'apellido', 'persona', 'identificacion', 'direccion',
    'telefono', 'email', 'celular', 'sexo', 'nacimiento'
  );

  public function representados () {
    return $this->hasMany('Cliente', 'representante_id');
  }

  public function representante () {
    return $this->belongsTo('Cliente', 'representante_id');
  }

  public function presupuestos () {
    return $this->hasMany('Presupuesto', 'cliente_id');
  }

  public function nombreCompleto () {
    if ($this->persona == 'j') {
      return $this->nombre;
    }
    return $this->apellido . ' ' . $this->nombre;
  }

  public function personaCompleto () {
    switch ($this->persona) {
      case 'n' : return 'Natural';
      case 'j' : return 'Juridico';
      case 'r' : return 'Representante';
    };
  }

}