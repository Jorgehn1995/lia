<?php
setlocale(LC_ALL, 'es_GT');
date_default_timezone_set("America/Guatemala");
$date = date_create();
$date= date_format($date, 'Y-m-d H:i:s');
if (isset($_GET['nombre'])) {
  $nombre=$_GET['nombre'];
}else {
  exit("false");
}
if (isset($_GET['abr'])) {
  $abr=$_GET['abr'];
}else {
  exit("false");
}
if (isset($_GET['nombre'])) {
  $telefono=$_GET['telefono'];
}else {
  exit("false");
}
if (isset($_GET['email'])) {
  $email=$_GET['email'];
}else {
  exit("false");
}
require '../../conexion/conexion.php';
$token=password_hash($abr, PASSWORD_BCRYPT);
$sql="INSERT INTO `colegio`(`idcole`, `nombre`, `abr`, `telefono`, `email`, `token`, `pf`)
VALUES ('','$nombre','$abr','$telefono','$email','$token','0')";
$in=mysqli_query($conexion,$sql);
$sql="SELECT * FROM `colegio` WHERE token='$token'";
$sk=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($sk)) {
  $id=$a['idcole'];
}
$codigo=rand(2000,9999);
$sql="INSERT INTO `usuarios`(`idusuarios`, `usuario`, `codigo`, `pass`, `modulo`, `asociado`, `idcole`, `finscripcion`)
VALUES ('0','$email','$codigo','$pass','D','$id','$id','$date')";
$in=mysqli_query($conexion,$sql);
require '../../conexion/cerrar_conexion.php';
 ?>
