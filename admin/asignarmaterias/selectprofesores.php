<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$idgrado=d("idgrado");
$seccion=d("seccion");
$idprofe=d("idprofe");
echo '<select class="form-control select2" id="profesores" name="">';
if ($idgrado=="") {
  exit("<option value='none'>Error idgrado</option>");
}
if ($seccion=="") {
  exit("<option value='none'>Error seccion</option>");
}

if ($idprofe=="") {
  exit("<option value='none'>Error idprofesor</option>");
}
if ($idprofe=="none") {
  echo "<option value='none'>Seleccione un profesor</option>";
}
$sql="SELECT * FROM `profesores` WHERE idcole='$idcole'";
$query=mysqli_query($conexion,$sql);
if ($query) {
  while ($a=mysqli_fetch_array($query)) {
    $idprofesor=$a['idprofesor'];
    $nombre=$a['nombres']." ".$a['apellidos'];
    if ($idprofesor==$idprofe) {
      echo "<option selected value='$idprofesor'>$nombre</option>";
    }else {
      echo "<option value='$idprofesor'>$nombre</option>";
    }
  }
}else {
  echo errorsql($conexion);
}
echo "</select>";
require '../../conexion/cerrar_conexion.php';
 ?>
