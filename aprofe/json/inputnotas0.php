<?php
require '../lib/sesion.php';
$val="16-3-2-A";
$v=explode("-",$val);
$idmateria=$v[0];
$bloque=$v[1];
$idgrado=$v[2];
$sec=$v[3];
header('Content-Type: application/json');
$arreglo= array();
$data=array();
$idcole=$_SESSION["idcole"];
$sql="SELECT clave, idalumno, CONCAT (apellidos,', ', nombres) as nombre FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' ORDER BY clave ASC";
//$sentencia="SELECT * FROM `grados` WHERE idgrado='$idgrado' AND idcole='$idcole'";
include('../../conexion/conexion.php');
//$sentencia = "SELECT * FROM alumnos ";
$data=array();
$resultado = mysqli_query($conexion,$sql);
$act="Sin Asignar";
if ($resultado) {
  while( $data = mysqli_fetch_array($resultado)){
    $clave=$data['clave'];
    $idalumno=$
    //$arreglo[] = array_map("utf8_encode",$data);
  }
}else {
  echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
}
/////**********************************************************
//$arreglo["data"] = $data;
echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
mysqli_free_result($resultado);
mysqli_close($conexion);

?>
