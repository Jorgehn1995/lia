<?php
require '../lib/sesion.php';
header('Content-Type: application/json');
$idcole=$_SESSION["idcole"];
if (isset($_GET['idgrado'])) {
  $f=$_GET['idgrado'];
  $f2=explode("-",$f);
  $idgrado=$f2['0'];
  $sentencia = "SELECT * FROM `materias` WHERE idcole='$idcole' AND idgrado='$idgrado'";

}else {
  $sentencia = "SELECT * FROM `materias` WHERE idcole='$idcole' ";
}
include('../../conexion/conexion.php');
//$sentencia = "SELECT * FROM alumnos ";
$resultado = mysqli_query($conexion,$sentencia);
if(!$resultado){
  die("error");
}else{
  while( $data = mysqli_fetch_assoc($resultado)){
    $arreglo[] = array_map("utf8_encode",$data);
  }
  echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
