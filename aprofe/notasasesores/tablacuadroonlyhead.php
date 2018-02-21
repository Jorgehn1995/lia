<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';



//$idcole=$_SESSION['idcole'];
echo '<table id="datatables" class="table table-bordered table-striped table-hover"  cellspacing="0" cellpadding="0" width="100%" >
<thead>
<tr>';
echo '<th  colspan="2">Datos</th>';
$sql="SELECT * FROM `mccategorias` WHERE idcole='$idcole'";
$query=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($query)) {
  $idcate="";
  $colspan=0;
  $idcate=$a['idmccategorias'];
  $nombrecategoria=$a['nombre'];
  $sql2="SELECT * FROM `modelocuadro` WHERE idmccategorias='$idcate'";
  $query2=mysqli_query($conexion,$sql2);
  $colspan=$query2->num_rows;
  echo '<th  colspan="'.$colspan.'">'.$nombrecategoria.'</th>';
}
echo '</tr>
<tr>
<th>Clave</th>
<th >Nombre</th>';
$sql="SELECT * FROM `modelocuadro` WHERE idcole='$idcole' ORDER BY modelocuadro.orden ASC";
$query=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($query)) {
  $nombre=$a['nombre'];
  echo '<th  >'.$nombre.'</th>';
}
echo '</tr>
</thead>
<tbody>

</tbody>
</table>';
?>
