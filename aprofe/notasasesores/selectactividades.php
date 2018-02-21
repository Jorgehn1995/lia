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
$sql="SELECT * FROM `mccategorias` WHERE idcole='$idcole'";
$query=mysqli_query($conexion,$sql);
echo '<div class="card-box">
<h4 class="m-t-0 m-b-0 header-title"><b>Seleccionar Actividad</b></h4>
<select id="actividades" class="form-control select2" name="">
<option value="none">Selecione Actividad</option>';
while ($a=mysqli_fetch_array($query)) {
  $idmc=$a['idmccategorias'];
  echo '<optgroup label="'.$a['nombre'].'">';
  $sql2="SELECT * FROM `modelocuadro` WHERE idcole='$idcole' AND idmccategorias='$idmc'";
  $query2=mysqli_query($conexion,$sql2);
  while ($b=mysqli_fetch_array($query2)) {
    $idmodelo=$b['idmodelo'];
    $nombreactividad=$b['nombre'];

    $sql3="SELECT * FROM `nombreactividades` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' AND idmateria='$idmateria' AND idbloque='$bloque' AND idactividad='$idmodelo' LIMIT 1";
    $query3=mysqli_query($conexion,$sql3);
    if ($query3->num_rows>0) {
      while ($c=mysqli_fetch_array($query3)) {
        $nombreactividad=$c['nombre'];
      }
    }
    echo '<option value="'.$idmodelo.'">'.$nombreactividad.'</option>';

  }
  echo '</optgroup>';
}
echo '</select>
</div>';
?>
