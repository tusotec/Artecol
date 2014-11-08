function populateSelect (obj, fullData, selected) {
  selected = obj.attr('selecteditem');
  obj.html('');
  for (var i in fullData) {
    var data = fullData[i];
    console.log(data);
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