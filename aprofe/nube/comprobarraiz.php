<?php
require '../lib/sesion.php';
require "../../assets/glib/isset.php";
require '../../conexion/conexion.php';
require "../../assets/datetime.php";
$raiz=dx("raiz");
if ($raiz=="./" || $raiz=="" || $raiz==0) {
  exit("true");
}
$sql="SELECT * FROM `nube` WHERE idcole='$idcole' AND idpersonal='$idusuario' AND idnube='$raiz' AND tipo='13' LIMIT 1";
$query=mysqli_query($conexion,$sql);
if ($query->num_rows==1) {
  exit("true");
}else {
  exit("flase");
}
 ?>
