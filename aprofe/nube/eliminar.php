<?php
require '../lib/sesion.php';
require "../../assets/glib/isset.php";
require "../../assets/datetime.php";
require '../../conexion/conexion.php';
$id=dx("id");
$sql="SELECT * FROM `nube` WHERE idcole='$idcole' AND idpersonal='$idusuario' AND idnube='$id' LIMIT 1";
$query=mysqli_query($conexion,$sql);
if ($query->num_rows==0) {
  exit("Error al actualizar: no se ha encontrado el archivo");
}else {
    $sql2="UPDATE `nube` SET `eliminado`='1', `fechaeliminado`='$datetime' WHERE idcole='$idcole' AND idpersonal='$idusuario' AND idnube='$id'";
}
$query2=mysqli_query($conexion,$sql2);
if ($query2) {
  echo "true";
}else {
  errorsql($conexion);
}
 ?>
