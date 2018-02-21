<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$idgrado=d("idgrado");
$sec=d("sec");
$idmateria=d("idmateria");

echo '<label class="control-label" for="">Selecione una materia</label>
<select class="select2 form-control" id="stMaterias" name="">';
require '../../conexion/conexion.php';
$sql="SELECT * FROM `materias` INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria WHERE materias.idgrado='$idgrado' AND materias.seccion='$sec' AND materias.idprofesor='$idusuario'";
$con=mysqli_query($conexion,$sql);
if ($con->num_rows==0) {
  echo '<option selected value="none">No impartes materias en este grado</option>';
}
while ($cg=mysqli_fetch_array($con)) {
  if ($cg['nombreficha']=="") {
    $nombre=$cg['nombre'];
  }else {
    $nombre=$cg['nombreficha'];
  }
  $idnm=$cg['idnombremateria'];
  if ($idnm==$idmateria) {
    echo '<option selected value="'.$idnm.'">'.$nombre.'</option>';
  }else {
    echo '<option value="'.$idnm.'">'.$nombre.'</option>';
  }
}
echo '</select>';
?>
