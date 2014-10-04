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
  public function categoria () {
    return $this->material->categoria->nombre;
  }
  public function precio () {
    $val  = $this->precioMaterial();
    $val *= $this->valOne($this->cantidad);
    $val *= $this->valOne($this->medida_1);
    $val *= $this->valOne($this->medida_2);
    return $val;
  }
  public function precioMaterial () {
    return $this->material->costo;
  }

  private function valOne ($val) {
    return ($val==0 || $val==null)? 1 : $val;
  }

  public function validFill ($data) {
    $data = $this->insertMedida($data, 'cantidad');
    $data = $this->insertMedida($data, 'medida_1');
    $data = $this->insertMedida($data, 'medida_2');
    $this->fill($data);
  }

  private function insertMedida ($data, $name) {
    if (!array_key_exists($name, $data)) {
      $data[$name] = 0;
    }
    return $data;
  }

}