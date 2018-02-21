<?php
require '../../conexion/conexion.php';
$idgrado=$_GET['idgrado'];
$id=$_GET['id'];
$sql="SELECT * FROM `grados` WHERE idgrado = '$idgrado'";
$con=mysqli_query($conexion,$sql);
echo '
<select    id="secciones'.$id.'" class="form-control secciones1 secciones2 select2">
  <option value="none">Seccion</option>';
while ($cg=mysqli_fetch_array($con)) {
  for ($i=1; $i <=5 ; $i++) {
    $nsec="sec".$i;
    if ($cg[$nsec]!="") {
      $sec=$cg[$nsec];
      echo "<option value=\"$sec\">$sec</option>";

    }
  }
  echo "<option value='All'>Ninguna, Ordenar por apellido</option>";
}
echo "</select>";
require '../../conexion/cerrar_conexion.php';
 ?>
