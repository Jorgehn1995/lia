<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
require '../../assets/crypt.php';
require '../../assets/datetime.php';
header('Content-Type: application/json');
$lk=d("loadkey");
$id=explode("-",$lk);
$idnombremateria=$id[0];
$bloque=$id[1];
$idgrado=$id[2];
$sec=$id[3];
$sql="SELECT * FROM `cambiosennotas` INNER JOIN `notas` ON cambiosennotas.idnota=notas.idnota INNER JOIN `alumnos` ON cambiosennotas.idalumno=alumnos.idalumno INNER JOIN `grados` ON alumnos.idgrado=grados.idgrado WHERE cambiosennotas.idmateria='$idnombremateria' AND notas.idgrado='$idgrado' AND cambiosennotas.bloque='$bloque' AND alumnos.seccion='$sec'  ORDer BY hora ASC";
$query=mysqli_query($conexion,$sql);
if ($query) {
  if ($query->num_rows==0) {
    $hora=$datetime;
    $sql2="SELECT * FROM `grados` WHERE idcole='$idcole' AND idgrado='$idgrado'";
    $query2=mysqli_query($conexion,$sql2);
    while ($b=mysqli_fetch_array($query2)) {
      $grado=utf8_encode($b['boton']." ".$sec);

      $msg=utf8_encode("Guardado, Aún sin notas registradas");
    }
    $r=true;
  }
  while ($a=mysqli_fetch_array($query)) {
    $r=true;
    $hora=$a['hora'];
    $dd = new DateTime($hora, new DateTimeZone("America/Guatemala"));
    $msg ="Guardado ".ago($dd->getTimestamp());
    $grado=utf8_encode($a['boton']." ".$sec);
  }
}else{
  errorsql($conexion);
}

$datos=array();

$agg = array(
  'r' => $r,
  'datetime'=> $hora,
  'hace'=>$msg,
  'grado'=>$grado,
  'actions'=>'<button type="button" class="btn btn-outline-secondary btn-printer" name="button"><i class="ti-printer"></i> Imprimir PDF</button>',
  'type'=>'error'
);
array_push($datos, $agg);
$arreglo = $datos;
$ex=utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
echo $ex;

?>
