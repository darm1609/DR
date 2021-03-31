
function NumCheck(e, field) {

  key = e.keyCode ? e.keyCode : e.which

  // backspace

  if (key == 8 || key == 9) return true

  // 0-9

  if (key > 47 && key < 58) {

    if (field.value == "") return true

    regexp = /.{9}[0-9]{2}$/

    return !(regexp.test(field.value))

  }

  // .

  if (key == 46) {

    if (field.value == "") return false

    regexp = /^[0-9]+$/

    return regexp.test(field.value)

  }

  // other key

  return false

 

}

function NumCheck2(e, field) {

  key = e.keyCode ? e.keyCode : e.which

  // backspace

  if (key == 8 || key == 9) return true

  // 0-9

  if (key > 47 && key < 58) {

    if (field.value == "") return true

    regexp = /.{6}[0-9]{2}$/

    return !(regexp.test(field.value))

  }

  // other key

  return false

 

}

function NumCheck3(e, field) {

  key = e.keyCode ? e.keyCode : e.which

  // backspace

  if (key == 8 || key == 9) return true

  // 0-9

  if (key > 47 && key < 58) {

    if (field.value == "") return true

    regexp = /.{9}[0-9]{2}$/

    return !(regexp.test(field.value))

  }

  // other key

  return false

}

function validarFormatoFecha(campo) {
      var RegExPattern = /^\d{1,2}\-\d{1,2}\-\d{2,4}$/;
      if ((campo.match(RegExPattern)) && (campo!='')) {
            return true;
      } else {
            return false;
      }
}

function existeFecha(fecha)
{
      if(validarFormatoFecha(fecha))
      {
        var fechaf = fecha.split("-");
        var d = fechaf[0];
        var m = fechaf[1];
        var y = fechaf[2];
        return m > 0 && m < 13 && y > 0 && y < 32768 && d > 0 && d <= (new Date(y, m, 0)).getDate();
      }
      else
        return false;
}