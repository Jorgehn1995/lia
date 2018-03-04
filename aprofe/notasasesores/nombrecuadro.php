<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
header('Content-Type: application/json');
$datos=array();
$sqlasesor="SELECT * FROM `asesores` INNER JOIN `grados` ON asesores.idgrado=grados.idgrado WHERE asesores.idpersonal='$idusuario' LIMIT 1";
$query=mysqli_query($conexion,$sqlasesor);
if ($query->num_rows==0) {
  $agg = array(
    'r' => false,
    'response'=>'Sin Datos',
  );
  array_push($datos, $agg);;
}else {
  while ($g=mysqli_fetch_array($query)) {
    $agg = array(
      'r' => true,
      'response'=>utf8_encode($g['boton']." ".$g['seccion']),
    );
    array_push($datos, $agg);;
  }
}
$arreglo = $datos;
echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
mysqli_free_result($query);
mysqli_close($conexion);
 ?>
