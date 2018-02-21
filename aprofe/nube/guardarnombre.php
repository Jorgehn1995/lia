<?php
require '../lib/sesion.php';
require "../../assets/glib/isset.php";
require '../../conexion/conexion.php';
$id=dx("id");
$nombre=dx("nombre");
$sql="SELECT * FROM `nube` WHERE idcole='$idcole' AND idpersonal='$idusuario' AND idnube='$id' LIMIT 1";
$query=mysqli_query($conexion,$sql);
if ($query->num_rows==0) {
  exit("Error al actualizar: no se ha encontrado el archivo");
}else {
  while ($a=mysqli_fetch_array($query)) {
    $extension=end(explode(".",$a['nombre']));
  }
  if ($nombre=="") {
    exit("El nombre no puede estar vacio");
  }else {
    $nuevonombre=$nombre.".".$extension;
    $sql2="UPDATE `nube` SET `nombre`='$nuevonombre' WHERE idcole='$idcole' AND idpersonal='$idusuario' AND idnube='$id'";
  }
}
$query2=mysqli_query($conexion,$sql2);
if ($query2) {
  echo "true";
}
 ?>
