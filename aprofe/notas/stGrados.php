<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$g=d("idgrado");
$s=d("sec");
echo '<label class="control-label" for="">Selecione un grado</label>
<select class="select2 form-control" id="stGrados" name="">';
$sql="SELECT * FROM `grados` WHERE $idcole='$idcole'";
$query=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($query)){
  for ($i=1; $i <=5 ; $i++) {
    $n="sec".$i;
    if ($a[$n]!="") {
      if ($a['idgrado']==$g && $a[$n]==$s) {
        echo '<option selected value="'.$a['idgrado']."-".$a[$n].'">'.$a['boton'].' '.$a[$n].'</option>';
      }else {
        echo '<option value="'.$a['idgrado']."-".$a[$n].'">'.$a['boton'].' '.$a[$n].'</option>';
      }
    }
  }
}
echo '</select>';
 ?>
