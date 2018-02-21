<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';



$sql2="SELECT * FROM `alumnos` WHERE insertdate >= CURDATE()";
$query2=mysqli_query($conexion,$sql2);
$tot=$query2->num_rows;

$sql3="SELECT * FROM `alumnos` WHERE insertdate>= CURDATE() AND genero='M'";
$query3=mysqli_query($conexion,$sql3);
$hombres=$query3->num_rows;

$sql4="SELECT * FROM `alumnos` WHERE insertdate>= CURDATE() AND genero='F'";
$query4=mysqli_query($conexion,$sql4);
$mujeres=$query4->num_rows;
if ($tot==0) {
  echo "<tr>
    <td colspan='4' class='text-center'><p class='text-muted'>Sin Alumnos Inscritos Hoy</p></td>
  </tr>";
}else {
  echo "<tr>
    <td >Total</td>
    <td >$hombres</td>
    <td >$mujeres</td>
    <td >$tot</td>
  </tr>";
}
 ?>
