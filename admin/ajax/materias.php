<?php
require '../lib/sesion.php';
require "../../assets/glib/isset.php";
require '../../conexion/conexion.php';
$idmateria=d("idmateria");
$idgrado=dx("idgrado");
$sec=dx("seccion");
$num=dx("num");
$idnombremateria=dx("idnombremateria");
$idprofesor=d("idprofesor");
$activo=dx("activo");
$require=dx("require");
if ($require=="insert") {
  $sql="INSERT INTO `materias`(`idmateria`, `idcole`, `idgrado`, `seccion`, `num`, `idnombremateria`, `idprofesor`, `activo`) VALUES ('0','$idcole','$idgrado','$sec','$num','$idnombremateria','$idprofesor','$activo')";
}else {
  $sql="UPDATE `materias` SET `idnombremateria`='$idnombremateria',`idprofesor`='$idprofesor' WHERE idmateria='$idmateria'";
}
$cn=mysqli_query($conexion,$sql);
if ($cn) {
  echo "Exito";
}else {
  echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
}

 ?>
