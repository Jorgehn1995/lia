<?php
header('Content-Type: application/json');
require '../lib/sesion.php';
require '../lib/data.php';
$r=0;
$data=array();
include('../../conexion/conexion.php');
$sql="DELETE FROM `edades` WHERE idcole='$idcole'";
$cn=mysqli_query($conexion,$sql);
$sentencia = "SELECT * FROM `alumnos` WHERE idcole='$idcole' ORDER BY nacimiento";
$resultado = mysqli_query($conexion,$sentencia);
while ($g=mysqli_fetch_array($resultado)) {
  $nacimiento=$g['nacimiento'];
  $actual=date("Y-m-d");
  $edad=$actual-$nacimiento;
  $filas=0;
  $cantidad=0;
  $sk="SELECT * FROM `edades` WHERE idcole='$idcole' AND edades='$edad años'";
  $cn=mysqli_query($conexion,$sk);
  if ($cn->num_rows>0) {
    while ($a=mysqli_fetch_array($cn)) {
      $filas=1;
      $cantidad=$a['cantidades']+1;
      $idresultado=$a['idresultado'];
    }
    $sql="UPDATE `edades` SET `cantidades`='$cantidad' WHERE idresultado='$idresultado'";
  }else {
    $sql="INSERT INTO `edades`(`idresultado`, `idcole`, `edades`, `cantidades`) VALUES ('0','$idcole','$edad años','1')";
  }
  $cn=mysqli_query($conexion,$sql);
}
$arreglo=array();
$sql="SELECT * FROM `edades` WHERE idcole='$idcole' ORDER BY edades";
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
