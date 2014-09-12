<?php

class ModelBase extends Eloquent {

  public static function paginate ($order = 'id') {
    $order = Input::get('order', 'id');
    $perPage = Config::get('artecol.per_page');
    $query = self::orderBy($order);
    if (Input::has('searchvalue')) {
      $key = Input::get('searchkey', 'nombre');
      $value = Input::get('searchvalue');
      $query = $query->where($key, $value);
    }
    $paginator = $query->paginate($perPage);
    return $paginator;
  }

}