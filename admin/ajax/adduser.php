<?php

require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
$peticion=dx("peticion");
$id=d("id");
$nom=dx("nombres");
$ape=dx("apellidos");
$dir=d("dir");
$tel=d("tel");
$user=dx("user");

$idcole=dx("idcole");

//exit("$id");
if ($peticion=="insert") {
  $sql="INSERT INTO `usuarios`(`idusuarios`, `activo`, `usuario`, `codigo`, `pass`, `modulo`, `asociado`, `idcole`, `fotoperfil`, `fotoportada`, `uc`, `uchora`, `finscripcion`)
  VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13])";
  $query=mysqli_query($conexion,$sql);
  if ($query) {
    echo "Exito";
  }else {
    echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
  }
}else {
  $sql="UPDATE `profesores` SET `nombres`='$nom',`apellidos`='$ape',`direccion`='$dir',`telefono`='$tel' WHERE idprofesor='$id'";
  $query=mysqli_query($conexion,$sql);
  if ($query) {
    echo "Actualizado";
  }else {
    echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
  }
}
require '../../conexion/cerrar_conexion.php';
?>
