<?php
require '../lib/sesion.php';
require "../../assets/glib/isset.php";
require '../../conexion/conexion.php';
require "../../assets/datetime.php";
$nombre=dx("nombre");
$raiz=dx("raiz");
if ($nombre=="") {
  exit("El nombre no puede estar en blanco");
}
$tipo="13";
$sql="SELECT * FROM `nube` WHERE idcole='$idcole' AND idpersonal='$idusuario' AND nombre='$nombre' LIMIT 1";
$query=mysqli_query($conexion,$sql);
if ($query->num_rows==0) {
  $sql2="INSERT INTO `nube`(`idcole`, `idpersonal`, `raiz`, `nombre`, `tipo`, `peso`, `creacion`)VALUES ('$idcole','$idusuario','$raiz','$nombre','$tipo','0','$datetime')";
}else {
  exit("El nombre ya existe, intente con otro");
}
$query2=mysqli_query($conexion,$sql2);
if ($query2) {
  echo "true";
}else {
  errorsql($conexion);
}
 ?>
