<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$activo=dx("activo");
echo '<select id="activo" class="form-control select2" name="">';
if ($activo=="1") {
  echo '<option selected value="1">Habilitado</option>
  <option value="0">Deshabilitado</option>';
}else {
  echo '<option  value="1">Habilitado</option>
  <option selected value="0">Deshabilitado</option>';
}

echo "</select>";

 ?>
