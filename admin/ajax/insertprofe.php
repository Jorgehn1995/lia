<?php
setlocale(LC_ALL, 'es_GT');
date_default_timezone_set("America/Guatemala");
$date = date_create();
$date= date_format($date, 'Y-m-d H:i:s');
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
require '../../assets/crypt.php';
$peticion=dx("peticion");
$id=d("id");
$nom=dx("nombres");
$ape=dx("apellidos");
$dir=d("dir");
$tel=d("tel");
$user=dx("user");
$codigo=rand(2000,9999);
$pass=encriptar($codigo);
$idcole=dx("idcole");
$cod=uniqid();
//exit("$id");
if ($peticion=="insert") {
  $sql="INSERT INTO `profesores`(`idprofesor`, `idcole`, `codigo`, `nombres`, `apellidos`, `direccion`, `telefono`, `cargo`, `activo`)
  VALUES ('0','$idcole','$cod','$nom','$ape','$dir','$tel','Profesor','Activo')";
  $query=mysqli_query($conexion,$sql);
  if ($query) {

    $sk="SELECT * FROM `profesores` WHERE idcole='$idcole' AND nombres='$nom' AND apellidos='$ape'";
    $con=mysqli_query($conexion,$sk);
    if ($con) {
      $asoc="";
      while ($a =mysqli_fetch_array($con)) {
        $asoc=$a['idprofesor'];
      }
      if ($asoc=="") {
        exit("Error al ingresar usuario, asociado no encontrado");
      }
      $sqlu="INSERT INTO `usuarios`(`idusuarios`, `activo`, `usuario`, `codigo`, `pass`, `modulo`, `asociado`, `idcole`, `fotoperfil`, `fotoportada`, `uc`, `uchora`, `finscripcion`)VALUES ('0','1','$user','$codigo','','P','$asoc','$idcole','','','0','0','$date')";
      $in=mysqli_query($conexion,$sqlu);
      if ($in) {
          echo "Exito";
      }else {
        echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
      }
    }else {
      echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
    }
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
