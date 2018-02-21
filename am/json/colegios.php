<?php
require '../lib/sesion.php';
header('Content-Type: application/json');
$arreglo=array();
$sentencia = "SELECT * FROM `colegio`";
include('../../conexion/conexion.php');
//$sentencia = "SELECT * FROM alumnos ";
$resultado = mysqli_query($conexion,$sentencia);
if(!$resultado){
  //die("error");
}else{
  while( $data = mysqli_fetch_assoc($resultado)){
    $arreglo["data"][] = array_map("utf8_encode",$data);
  }
  echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
