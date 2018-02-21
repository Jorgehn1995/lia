<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$id=d("id");
$var=explode("-",$id);
$idgrado=$var[0];
$seccion=$var[1];
$idprofe=d("idprofe");
if ($idgrado=="" || $seccion=="") {
  exit("Error 0x00002: No se encuentra el ID de grado o la seccion");
}
if ($idprofe=="none") {
  exit("Si quiere desasignar a un asesor presione 'Desasignar Datos'");
}
$sql="SELECT * FROM `asesores` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$seccion' LIMIT 1";
$query=mysqli_query($conexion,$sql);
if ($query->num_rows==0) {
  $sql="INSERT INTO `asesores` VALUES ('0','$idcole','$idgrado','$seccion','$idprofe')";
}else {
  $sql="UPDATE `asesores` SET idprofesor='$idprofe' WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$seccion'";
}
$query=mysqli_query($conexion,$sql);
if ($query) {
  echo "true";
}else {
  echo errorsql($conexion);
}


 ?>
