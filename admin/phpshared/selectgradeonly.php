<?php
require '../lib/sesion.php';

require '../../conexion/conexion.php';
$sql="SELECT * FROM `grados` WHERE idcole = '$idcole'";
$con=mysqli_query($conexion,$sql);
echo '<label for="grado" class="control-label">Grado a cursar *</label>
<select    id="grado" class="form-control select2">
  <option value="">Seleccionar</option>';
while ($cg=mysqli_fetch_array($con)) {
  $idg=$cg['idgrado'];
  $grado=$cg['boton'];
  //echo "<optgroup label=\"$grado\">";
  echo "<option value=\"$idg\">$grado</option>";
  //echo "</optgroup>";
  require '../../conexion/cerrar_conexion.php';
}
echo "</select>";
?>
