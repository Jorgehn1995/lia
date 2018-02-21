<?php
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
for ($i=0; $i <=6 ; $i++) {
  $sec="";
  if ($i==0) {
    $sec="sinasignar";
    $seccion="";
    $clave="0";
  }
  if ($i==1) {
    $sec="sec"."$i";
    $seccion="A";
  }
  if ($i==2) {
    $sec="sec"."$i";
    $seccion="B";
  }
  if ($i==3) {
    $sec="sec"."$i";
    $seccion="C";
  }
  if ($i==4) {
    $sec="sec"."$i";
    $seccion="D";
  }
  if ($i==5) {
    $sec="sec"."$i";
    $seccion="E";
  }
  $sec1=d($sec);
  if ($sec1=="{}" || $sec1=="[]" || $sec1=="") {
    $sec1="";
  }else {
    $arraysec1=json_decode($sec1);
    $c=0;
    foreach ($arraysec1 as &$valor) {
      if ($seccion=="") {
        $clave=0;
      }else {
        $clave=$c+1;
      }

      $id=$arraysec1[$c]->id;
      //echo  $id."--- seccion: $seccion ---- clave $clave";
      $update="UPDATE `alumnos` SET `seccion`='$seccion',`clave`='$clave' WHERE idalumno='$id'";
      $query=mysqli_query($conexion,$update);
      if ($query) {

      }else {
        $error="Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
        exit("$error");
      }
      //echo "<br> $update <br> ";
      $c=$c+1;
    }
    //print_r($arraysec1[0]);
    //echo "<br>";
    //echo  $arraysec1[0]->id;
  }
}
echo "Exito";
require '../../conexion/cerrar_conexion.php';






?>
