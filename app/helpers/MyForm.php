<?php

class MyForm{

  public static $model_name = '#model';
  public static $is_array = false;

  private static $old_model_name = '#model';
  private static $old_is_array = false;

  public static function setModel ($new_name, $new_is_array) {
    self::$model_name = $new_name;
    self::$is_array = $new_is_array;
  }

  public static function mark () {
    self::$old_model_name = self::$model_name;
    self::$old_is_array = self::$is_array;
  }

  public static function unMark () {
    $new_name = self::$old_model_name;
    $new_is_array = self::$old_is_array;
    self::mark();
    self::setModel($new_name, $new_is_array);
  }

  public static function getName ($name = '#name') {
    if (self::$is_array) {
      return self::$model_name . '[#id][' . $name . ']';
    } else {
      return self::$model_name . '[' . $name . ']';
    }
  }

  public static function getClass ($name) {
    return self::$model_name . '-' . $name;
  }

  public static function input ($type, $name, $options = array()) {
    $value = Form::getValueAttribute($name);

    //Si el modelo ya tiene este atributo se le da importancia.
    if ($value != null) {
      $options['value'] = $value;
    }
    $full_name = self::getName($name);
    $id = self::getClass($name);

    
    if (isset($options['class']) && $options['class'] != '') {
      //Si ya tiene clase se añade la generada a la lista de clases
      $options['class'] = $options['class'] . ' ' . $id;
    } else {
      //Si no se usa esta clase como única
      $options['class'] = $id;
    }

    if (!self::$is_array && !isset($options['id'])) {
      //Si el modelo es unico y no existe id.
      $options['id'] = $id;
    }

    return Form::input($type, $full_name, $value, $options);
  }

  public static function label ($name, $display) {
    $full_name = self::getName($name);
    return Form::label($name, $display);
  }

  public static function field ($name, $display, $options = array()) {
    return '<div class="input-field">' .
            self::label($name, $display) .
            self::input('text', $name, $options) .
            '</div>';
  }

  public static function select ($name, $data = array(), $options = array()) {

    $value = Form::getValueAttribute($name);

    //Si el modelo ya tiene este atributo se le da importancia.
    if ($value != null) {
      $options['value'] = $value;
    }
    $full_name = self::getName($name);
    $id = self::getClass($name);

    
    if (isset($options['class']) && $options['class'] != '') {
      //Si ya tiene clase se añade la generada a la lista de clases
      $options['class'] = $options['class'] . ' ' . $id;
    } else {
      //Si no se usa esta clase como única
      $options['class'] = $id;
    }

    if (!self::$is_array && !isset($options['id'])) {
      //Si el modelo es unico y no existe id.
      $options['id'] = $id;
    }

    return Form::select($full_name, $data, null, $options);
  }

}