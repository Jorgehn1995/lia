<h4 class="m-t-0 m-b-30 header-title"><b>Seleccionar Grado</b></h4>
<select id="grados" class="form-control select2">
  <option>Grado</option>
<?php
require '../../conexion/conexion.php';
$sql="SELECT * FROM `grados` WHERE idcole = '$idcole' order by ciclo";
$con=mysqli_query($conexion,$sql);
while ($cg=mysqli_fetch_array($con)) {
  $idg=$cg['idgrado'];
  $grado=$cg['grado'];
  $ciclo=$cg['ciclo'];
  echo "<optgroup label=\"$grado\">";
  for ($i=1; $i <=5 ; $i++) {
    $s="sec"."$i";
    $sec=$cg[$s];
    if ($sec=="") {

    }else {
      echo "<option value=\"$idg-$sec\">$grado $sec</option>";
    }
  }
  echo "</optgroup>";
  require '../../conexion/cerrar_conexion.php';
}
?>
</select>
