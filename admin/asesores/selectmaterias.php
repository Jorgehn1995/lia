<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$idgrado=d("idgrado");
$seccion=d("seccion");
$idnm=d("idnm");
echo '<select class="form-control select2" id="materias" name="">';
if ($idgrado=="") {
  exit("<option value='none'>Error idgrado</option>");
}
if ($seccion=="") {
  exit("<option value='none'>Error seccion</option>");
}

if ($idnm=="") {
  exit("<option value='none'>Error idnombremateria</option>");
}
if ($idnm=="none") {
  echo "<option value='none'>Seleccione una clase</option>";
}
function comprobar($conexion,$idnombremateria,$idcole,$idgrado,$seccion){
  $sql2="SELECT * FROM `materias` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$seccion' AND idnombremateria='$idnombremateria'";
  $query2=mysqli_query($conexion,$sql2);
  if ($query2) {
    if ($query2->num_rows==0) {
      return false;
    }else {
      return true;
    }
  }
}


$sql="SELECT * FROM `nombrematerias` WHERE idcole='$idcole'";
$query=mysqli_query($conexion,$sql);
if ($query) {
  while ($a=mysqli_fetch_array($query)) {
    $idnombremateria=$a['idnombremateria'];
    $nombre=$a['nombre'];
    if ($idnombremateria==$idnm) {
      echo "<option selected value='$idnombremateria'>$nombre</option>";
    }else {
      if (!comprobar($conexion,$idnombremateria,$idcole,$idgrado,$seccion)) {
        echo "<option value='$idnombremateria'>$nombre</option>";
      }
    }
  }
}else {
  echo errorsql($conexion);
}
echo "</select>";
require '../../conexion/cerrar_conexion.php';
 ?>
