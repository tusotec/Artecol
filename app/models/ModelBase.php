<?php

class ModelBase extends Eloquent {

  public static function paginate ($order = 'id') {
    $order = Input::get('order', 'id');
    $perPage = Config::get('artecol.per_page');
    $query = self::orderBy($order);
    $paginator = $query->paginate($perPage);
    return $paginator;
  }

}