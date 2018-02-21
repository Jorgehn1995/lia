<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
$html='';
$sql="SELECT * FROM `grados` WHERE idcole='$idcole'";
$query=mysqli_query($conexion,$sql);
if ($query) {
  while ($a=mysqli_fetch_array($query)) {
    $idgrado=$a['idgrado'];
    $nombre=$a['boton'];
    $sql2="SELECT * FROM `alumnos` WHERE idgrado='$idgrado'";
    $query2=mysqli_query($conexion,$sql2);
    $tot=$query2->num_rows;

    $sql3="SELECT * FROM `alumnos` WHERE idgrado='$idgrado' AND genero='M'";
    $query3=mysqli_query($conexion,$sql3);
    $hombres=$query3->num_rows;

    $sql4="SELECT * FROM `alumnos` WHERE idgrado='$idgrado' AND genero='F'";
    $query4=mysqli_query($conexion,$sql4);
    $mujeres=$query4->num_rows;
    echo "<tr>
      <td>$nombre</td>
      <td>$hombres</td>
      <td>$mujeres</td>
      <td>$tot</td>
    </tr>";
  }
}


$sql2="SELECT * FROM `alumnos`";
$query2=mysqli_query($conexion,$sql2);
$tot=$query2->num_rows;

$sql3="SELECT * FROM `alumnos` WHERE  genero='M'";
$query3=mysqli_query($conexion,$sql3);
$hombres=$query3->num_rows;

$sql4="SELECT * FROM `alumnos` WHERE genero='F'";
$query4=mysqli_query($conexion,$sql4);
$mujeres=$query4->num_rows;
echo "<tr>
  <td style='background-color:#E6E6E6;'>Total</td>
  <td style='background-color:#E6E6E6;'>$hombres</td>
  <td style='background-color:#E6E6E6;'>$mujeres</td>
  <td style='background-color:#E6E6E6;'>$tot</td>
</tr>";
 ?>
