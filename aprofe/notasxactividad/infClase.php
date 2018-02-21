<?php
require '../lib/sesion.php';
require "../../assets/glib/isset.php";
require '../../conexion/conexion.php';
$val=d("id");
if ($val==0 || $val=="") {
  exit('{"data":[]}');
}
if ($val=="Grado") {
  exit('{"data":[]}');
}
//$val="4-3-5-A";
$v=explode("-",$val);
$idmateria=$v[0];
$bloque=$v[1];
$idgrado=$v[2];
$sec=$v[3];
$sql="SELECT * FROM `grados` WHERE idcole='$idcole' AND idgrado='$idgrado'";
$query=mysqli_query($conexion,$sql);
if (!$query) {
  errorsql($conexion);
}else {
  while ($a=mysqli_fetch_array($query)) {
    $nombre=$a['boton']." ".$sec;
    $sql2="SELECT * FROM `materias` INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria WHERE materias.idcole='$idcole' AND materias.idgrado='$idgrado' AND materias.seccion='$sec' AND materias.idnombremateria='$idmateria'";
    $query2=mysqli_query($conexion,$sql2);
    if (!$query2) {
      errorsql($conexion);
    }else {
      while ($b=mysqli_fetch_array($query2)) {
        if ($b['nombreficha']=="") {
          $materia=$b["nombre"];
        }else {
          $materia=$b['nombreficha'];
        }
      }
    }
    echo '<div class="card-box">
      <h4 class="m-t-0 m-b-0 header-title"><b>Informacion</b></h4>
      <div class="informacion">
      <p>'.$nombre.'</p><hr>
      <p class="text-muted">'.$materia.'</p>
      </div>
    </div>';
  }
}
 ?>
