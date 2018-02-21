<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$bloque=d("bloque");
if ($bloque=="") {
  $bc=$bloqueencurso;
}else {
  $bc=$bloque;
}
echo '<label class="control-label" for="">Selecione un bloque</label>
<select class="select2 form-control" id="stBloques" name="">';
for ($i=1; $i <=4 ; $i++) {
  if ($i==$bc AND $i<5) {
    echo '<option selected value="'.$i.'">Bloque '.$i.'</option>';
  }else {
    if ($i<=$bc) {
      echo '<option value="'.$i.'">Bloque '.$i.'</option>';
    }else {
      echo '<option disabled value="'.$i.'">Bloque '.$i.'</option>';
    }
  }
}
echo '<option value="Pro">Promedio</option></select>';
 ?>
