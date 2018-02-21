
<h4 class="m-t-0 m-b-30 header-title"><b>Seleccionar Grado</b></h4>
<select id="grados" class="form-control select2">
  <option>Grado</option>
<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$idgrado=d("idgrado");
$seccion=d("seccion");
$sql="SELECT * FROM `grados` WHERE idcole = '$idcole' order by idgrado";
$con=mysqli_query($conexion,$sql);
while ($cg=mysqli_fetch_array($con)) {
  $idg=$cg['idgrado'];
  $grado=$cg['boton'];
  $ciclo=$cg['ciclo'];
  echo "<optgroup label=\"$grado\">";
  for ($i=1; $i <=5 ; $i++) {
    $s="sec"."$i";
    $sec=$cg[$s];
    if ($sec=="") {

    }else {
      if ($idgrado==$idg && $seccion==$sec) {
        $sl="selected";
      }else {
        $sl="";
      }
      echo "<option $sl value=\"$idg-$sec\">$grado $sec</option>";
    }
  }
  echo "</optgroup>";
  require '../../conexion/cerrar_conexion.php';
}
?>
</select>
