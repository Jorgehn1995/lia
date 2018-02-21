<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
header('Content-Type: application/json');
$tabla=d('tabla');
$resultado="";
$mensaje="";
if ($tabla=="") {
  $resultado="false";
  $mensaje="No se ha especificado la tabla a buscar";
}else {
  $sql="SELECT * FROM `$tabla` WHERE idcole='$idcole'";
  $query=mysqli_query($conexion,$sql);
  if ($query) {
    $resultado="true";
    $mensaje=$query->num_rows;
  }else {
    $resultado="false";
    $mensaje=errorsql($conexion);
  }
}
$data = array(
  'r' => $resultado,
  'msg' => $mensaje,
);
echo utf8_decode(json_encode($data, JSON_UNESCAPED_UNICODE));
require '../../conexion/cerrar_conexion.php';
 ?>
