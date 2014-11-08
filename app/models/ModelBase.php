<?php

class ModelBase extends Eloquent {

  protected static $search_order = 'id';
  protected static $search_key = 'nombre';

  public static function toShow () {
    $order_dir = Input::has('order') ? 'asc' : 'desc';
    $order = Input::get('order', static::$search_order);
    $perPage = Config::get('artecol.per_page');
    $query = self::orderBy($order, $order_dir);
    if (Input::has('searchvalue')) {
      $key = Input::get('searchkey', static::$search_key);
      $value = Input::get('searchvalue');
      $query = $query->where($key, 'like', "%$value%");
    }
    $paginator = $query->paginate($perPage);
    return $paginator;
  }

}