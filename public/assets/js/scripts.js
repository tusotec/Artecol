/*
  Esta funcion escribe un elemento 'select'.

  obj = objeto jquery (o selector) del elemento select que se desea modificar.
  fullData = array con cada opcion para el select.
      la propiedad 'val' es el valor que va a tener la opcion.
      la propiedad 'text' es lo que se va a mostrar.
  selected = un parámetro opcional de la opción que va a ser seleccionada al principio.
      si obj tiene un atributo 'selecteditem', este toma prioridad.
*/
function populateSelect (obj, fullData, selected) {
  if (typeof obj == 'string') {
    obj = $(obj);
  }

  selected = obj.attr('selecteditem');
  obj.html('');
  for (var i in fullData) {
    var data = fullData[i];
    var opt = $('<option>');
    for (var key in data) {
      var val = data[key];
      switch (key) {
        case 'val':
          opt.val(val);
          break;
        case 'text':
          opt.text(val);
          break;
        default:
          opt.attr(key, val);
          break;
      }
      if (opt.val() == selected) {
        opt.attr('selected', true);
      }
    }
    obj.append(opt);
  };
}

/*
  Esta función lee el valor numérico de un elemento en la página.
  obj = el objeto jquery o selector del elemento.
  val = opcional, si se pasa, escribe el valor en el elemento en vez de leerlo.
  precision = el numero de decimales que debería tener el número, por defecto 5.
  Esta función supone que el objeto interpreta los numeros marcando los decimales con coma.
*/
function value (obj, val, precision) {
  if (typeof obj == 'string') {
    obj = $(obj);
  }

  if (precision == undefined) {
    precision = 5;
  }

  if (val == undefined) {
    var str = obj.val();
    if (str == undefined) {
      return NaN;
    }
    val = Number(str).toFixed(precision);
    return Number(val);
  } else {
    val = Number(val).toFixed(precision);
    val = Number(val);
    obj.val(val);
  }
}