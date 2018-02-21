<?php
require '../lib/sesion.php';
header('Content-Type: application/json');
$arreglo= array();
$idcole=$_SESSION["idcole"];

  $sentencia = "SELECT * FROM `profesores` WHERE idcole='$idcole'";

include('../../conexion/conexion.php');
//$sentencia = "SELECT * FROM alumnos ";
$data=array();
$resultado = mysqli_query($conexion,$sentencia);
while ($datos=mysqli_fetch_array($resultado)) {
  $id=$datos['idprofesor'];
  if ($datos['activo']=="Activo") {
    $color="success";
  }
  if ($datos['activo']=="Retirado") {
    $color="danger";
  }
  if ($datos['activo']=="Suspendido") {
    $color="warning";
  }
  $agg = array(
    'idprofesor' => $id,
    'idcole' => $datos['idcole'],
    'nombres' => utf8_encode($datos['nombres']),
    'apellidos' => utf8_encode($datos['apellidos']),
    'nombre' => utf8_encode($datos['apellidos'].", ".$datos['nombres']),
    'direccion' => utf8_encode($datos['direccion']),
    'telefono' => utf8_encode($datos['telefono']),
    'activo' => '<span id="activo" class="badge badge-'.$color.'">'.$datos['activo'].'</span>',
  );

  array_push($data, $agg);

}


/////**********************************************************
$arreglo["data"] = $data;

echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));

mysqli_free_result($resultado);
mysqli_close($conexion);
?>
