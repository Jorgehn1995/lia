<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$id=d("id");
$nombre=d("nombre");
if ($nombre=="") {
  exit("Nombre de la materia es obligatorio");
}
$corto=d("corto");
if ($corto=="") {
  exit("Nombre corto de la materia es obligatorio");
}
if ($id==0 || $id=="") {
  $sql="INSERT INTO `nombrematerias` VALUES ('$id','$idcole','$nombre','$corto')";
}else {
  $sql="UPDATE `nombrematerias` SET `nombre`='$nombre',`corto`='$corto' WHERE idnombremateria='$id'";
}
$query=mysqli_query($conexion,$sql);
if ($query) {
  echo "true";
}else {
  errorsql($conexion);
}

 ?>
