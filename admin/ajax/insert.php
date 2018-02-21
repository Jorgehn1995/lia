<?php
setlocale(LC_ALL, 'es_GT');
date_default_timezone_set("America/Guatemala");
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
$peticion=dx("peticion");
$nombres=dx("nombres");
$apellidos=dx("apellidos");
$grado=dx("grado");
$genero=dx("genero");
$nacimiento=dx("nacimiento");
$f = date_format(date_create_from_format('d/m/Y',$nacimiento),'Y-m-d');
$nacionalidad=dx("nacionalidad");
$dia=df($nacimiento);
$mes=mf($nacimiento);
$an=af($nacimiento);
$doc=dx("doc");
if ($doc=="") {
  $doc="CUI";
}
$nodoc=dx("nodoc");
$encargado=dx("encargado");
$telencargado=dx("telencargado");
$otros=dx("otros");
$codigo=dx("codigo");
$idcole=dx("idcole");
if ($peticion=="insert") {
  $sqlr="SELECT * FROM `alumnos` WHERE codigo='$codigo'";
  $con=mysqli_query($conexion,$sqlr);
  $rows=$con->num_rows;
  if ($rows==0) {
    $sql="INSERT INTO `alumnos`(`idalumno`, `idcole`, `idgrado`, `ciclo`, `corto`, `grado`, `seccion`, `clave`, `codigo`, `apellidos`, `nombres`, `genero`, `nd`, `nm`, `na`, `nacimiento`, `nacionalidad`, `doc`, `nodoc`, `encargado`, `telencargado`, `otros`, `activo`)VALUES (0,'$idcole','$grado','','','','','','$codigo','$apellidos','$nombres','$genero','$dia','$mes','$an','$f','$nacionalidad','$doc','$nodoc','$encargado','$telencargado','$otros','Activo')";
    $query=mysqli_query($conexion,$sql);
    if ($query) {
      echo "Exito";
      $sentencia = "DELETE FROM `alumnosauto` WHERE codigo='$codigo'";
      $resultado = mysqli_query($conexion,$sentencia);
    }else {
      echo "Error";
    }
  }else {
    echo "Duplicado";
  }
  mysqli_free_result($con);
  mysqli_close($conexion);
}


 ?>
