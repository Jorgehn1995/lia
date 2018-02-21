<?php
header('Content-Type: application/json');
require '../lib/sesion.php';
require '../lib/data.php';
calcularedades($idcole);
include('../../conexion/conexion.php');
$data=array();
$arreglo=array();
$sql="SELECT * FROM `edades` WHERE idcole='$idcole'";
$resultado = mysqli_query($conexion,$sql);
if(!$resultado){
  die("error");
}else{
  while( $data = mysqli_fetch_assoc($resultado)){
    $arreglo[] = array_map("utf8_encode",$data);
  }
  echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
}
//echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
mysqli_free_result($resultado);
mysqli_close($conexion);

?>
