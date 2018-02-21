<?php
$r=1;
if ($r==0) {
  exit("no permitido");
}
require 'conexion/conexion.php';
$sql="SELECT * FROM `alumnos`";
$query=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($query)) {
  $f=$a['na']."-".$a['nm']."-".$a['nd'];
  $id=$a['idalumno'];
  $sql2="UPDATE `alumnos` SET nacimiento='$f' WHERE idalumno='$id'";
  $query2=mysqli_query($conexion,$sql2);
}
 ?>
