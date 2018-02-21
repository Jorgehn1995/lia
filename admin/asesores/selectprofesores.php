<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$idprofe=d("idprofe");
echo '<select class="form-control select2" id="profesores" name="">';

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


    $sql2="SELECT * FROM `asesores` WHERE idpersonal='$idprofesor' ";
    $query2=mysqli_query($conexion,$sql2);
    if ($query2->num_rows==0) {
      if ($idprofesor==$idprofe) {
        echo "<option selected value='$idprofesor'>$nombre</option>";
      }else {
        echo "<option value='$idprofesor'>$nombre</option>";
      }
    }else {
      if ($idprofesor==$idprofe) {
        echo "<option selected value='$idprofesor'>$nombre</option>";
      }
    }



  }
}else {
  echo errorsql($conexion);
}
echo "</select>";
require '../../conexion/cerrar_conexion.php';
 ?>
