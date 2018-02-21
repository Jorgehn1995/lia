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

$sql="SELECT * FROM `asesores` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$seccion'";
$query=mysqli_query($conexion,$sql);
if ($query->num_rows>0) {
  $sql="DELETE FROM `asesores` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$seccion'";
  $query=mysqli_query($conexion,$sql);
  if ($query) {
    echo "true";
  }else {
    echo errorsql($conexion);
  }
}else {
  echo "true";
}

 ?>
