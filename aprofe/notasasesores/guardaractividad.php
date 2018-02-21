<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$val=d("id");
$v=explode("-",$val);
$idmateria=$v[0];
$bloque=$v[1];
$idgrado=$v[2];
$sec=$v[3];
$sql="SELECT * FROM `materias` INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria WHERE materias.idcole='$idcole' AND materias.idgrado='$idgrado' AND materias.seccion='$sec' AND materias.idnombremateria='$idmateria' LIMIT 1";
$query=mysqli_query($conexion,$sql);
if ($query->num_rows==0) {
  $nombre="Error: No Encontrado";
}
while ($a=mysqli_fetch_array($query)) {
  if ($a['nombreficha']=="") {
    $nombre=$a['nombre'];
  }else {
    $nombre=$a['nombreficha'];
  }
}
echo "$nombre";
 ?>
