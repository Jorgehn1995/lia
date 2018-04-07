<?php
require '../lib/sesion.php';
require "../../assets/glib/isset.php";
require '../../conexion/conexion.php';
$val=d("id");
if ($val==0 || $val=="") {
  exit('error');
}
if ($val=="Grado") {
  exit('error');
}
//$val="4-3-5-A";
$v=explode("-",$val);
$idmateria=0;

$sqlasesor="SELECT * FROM `asesores` WHERE idpersonal='$idusuario' LIMIT 1";
$query=mysqli_query($conexion,$sqlasesor);
if ($query->num_rows==0) {
  exit('<div class="">
    <div class="text-center">
      <br>
      <img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
      <h3 class="text-muted">Sin Grado Asignado</h3>
      <div id="icon">
        <h5 class="text-muted">No tienes un grado asignado para esta sección </h5>
      </div>
    </div>
  </div>');
}else {
  while ($g=mysqli_fetch_array($query)) {
    $bloque=$bloqueencurso;
    $idgrado=$g['idgrado'];
    $sec=$g['seccion'];
    $idactividad=$v[4];
    $id="0-".$bloqueencurso."-".$g['idgrado']."-".$g['seccion'];
  }
}



$nombre=d("nombre");
$sql="SELECT * FROM `nombreactividades` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' AND idbloque='$bloque' AND idactividad='$idactividad' LIMIT 1";
$query=mysqli_query($conexion,$sql);
if ($query->num_rows==0) {
  $sql2="INSERT INTO `nombreactividades`(`idnombreactividad`, `idcole`, `idgrado`, `seccion`, `idmateria`, `idbloque`, `idactividad`, `nombre`) VALUES ('0','$idcole','$idgrado','$sec','$idmateria','$bloque','$idactividad','$nombre')";
}else {
  if ($nombre=="") {
    $sql2="DELETE FROM `nombreactividades` WHERE WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' AND idbloque='$bloque' AND idactividad='$idactividad'";
  }else {
    $sql2="UPDATE `nombreactividades` SET `nombre`='$nombre' WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' AND idbloque='$bloque' AND idactividad='$idactividad'";
  }
}
$query2=mysqli_query($conexion,$sql2);
if ($query2) {
  echo "true";
}
 ?>
