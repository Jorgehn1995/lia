<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$idgrado=d("idgrado");
$seccion=d("seccion");
$num=d("num");
$nombreficha=d("nombreficha");
$idnm=d("idnm");
$idprofe=d("idprofe");
if ($idgrado=="" || $seccion=="" || $num=="" || $num==0) {
  exit("Error en procedimiento ajax");
}
if ($idnm=="none" || $idprofe=="none") {
  exit("Si quiere desasignar una materia o un profesor presione 'Desasignar Datos'");
}
$sql="SELECT * FROM `materias` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$seccion' AND num='$num'";
$query=mysqli_query($conexion,$sql);
if ($query->num_rows==0) {
  $sql="INSERT INTO `materias` VALUES ('0','$idcole','$idgrado','$seccion','$num',$idnm,'$nombreficha','$idprofe','SI')";
}else {
  $sql="UPDATE `materias` SET idnombremateria='$idnm', idprofesor='$idprofe', nombreficha='$nombreficha' WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$seccion' AND num='$num'";
}
$query=mysqli_query($conexion,$sql);
if ($query) {
  echo "true";
}else {
  echo errorsql($conexion);
}


 ?>
