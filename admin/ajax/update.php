<?php
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
$id=dx("id");
$peticion=dx("peticion");
$nombres=dx("nombres");
$apellidos=dx("apellidos");
$grado=dx("grado");
$genero=dx("genero");
$nacimiento=dx("nacimiento");
$nacionalidad=dx("nacionalidad");
$f = date_format(date_create_from_format('d/m/Y',$nacimiento),'Y-m-d');
$dia=df($nacimiento);
$mes=mf($nacimiento);
$an=af($nacimiento);
$doc=dx("doc");
$nodoc=dx("nodoc");
$encargado=dx("encargado");
$telencargado=dx("telencargado");
$otros=dx("otros");
$estado=dx("estado");
$codigo=dx("codigo");
$idcole=dx("idcole");
$rows=0;
if ($peticion=="update") {
  $sqlr="SELECT * FROM `alumnos` WHERE codigo='$codigo'";
  $con=mysqli_query($conexion,$sqlr);
  while ($a=mysqli_fetch_array($con)) {
    if ($a['idalumno']==$id) {
      $rows=0;
    }else {
      $rows=1;
    }
  }
  //$rows=$con->num_rows;
  if ($rows==0) {
    $sql="UPDATE `alumnos` SET `idgrado`='$grado',`codigo`='$codigo',`apellidos`='$apellidos',`nombres`='$nombres',`genero`='$genero',`nd`='$dia',`nm`='$mes',`na`='$an', `nacimiento`='$f',`nacionalidad`='$nacionalidad',
    `doc`='$doc',`nodoc`='$nodoc',`encargado`='$encargado',`telencargado`='$telencargado',`otros`='$otros',`activo`='$estado' WHERE idalumno = '$id'";
    $query=mysqli_query($conexion,$sql);
    if ($query) {
      echo "Exito";
    }else {
      echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
    }
  }else {
    echo "Duplicado $rows";
  }
  mysqli_free_result($con);
  mysqli_close($conexion);
}


 ?>
