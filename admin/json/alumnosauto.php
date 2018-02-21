<?php
require '../lib/sesion.php';

$arreglo= array();
$idcole=$_SESSION["idcole"];
if (isset($_GET['codigo'])) {
$codigo=$_GET['codigo'];
}else {
  $codigo="";
}
$sentencia = "SELECT * FROM `alumnosauto` WHERE codigo='$codigo'";
include('../../conexion/conexion.php');
//$sentencia = "SELECT * FROM alumnos ";

$resultado = mysqli_query($conexion,$sentencia);
while ($datos=mysqli_fetch_array($resultado)) {
  $data=array();
  $id=$datos['idalumno'];
  $color="danger";
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
  'idalumno' => $id,
  'idcole' => $datos['idcole'],
  'codigo' => $datos['codigo'],
  'apellidos' => utf8_encode($datos['apellidos']),
  'nombres' => utf8_encode($datos['nombres']),
  //'genero' => $datos['genero'],
  'grado' => $datos['idgrado'],
  'nd' => $datos['nd'],
  'nm' => $datos['nm'],
  'na' => $datos['na'],
  'nacionalidad' => $datos['nacionalidad'],
  'doc' => $datos['doc'],
  'nodoc' => $datos['nodoc'],
  //'encargado' => $datos['encargado'],
  //'telencargado' => $datos['telencargado'],
  //'otros' => $datos['otros'],
  //'<input type="text" class="form-control" id="id" value="'.$datos['activo'].'" readonly placeholder="id">'

  'activo' => '<span id="activo" class="badge badge-'.$color.'">'.$datos['activo'].'</span>',
  //'activo' => '<input type="text" class="form-control" id="activo" value="'.$datos['activo'].'" readonly placeholder="id">',
  //'activo' => '<input id="activo" type="text" class="form-control" id="activo" value="'.$datos['activo'].'" readonly placeholder="id">',
  'clave' => $datos['clave'],
  'seccion' => $datos['seccion'],
  'nombre' => utf8_encode($datos['apellidos'].", ".$datos['nombres'])
  );

  array_push($data, $agg);

}

if (isset($data)) {
  # code...
}else {
  exit("false");
}
header('Content-Type: application/json');
/////**********************************************************
    $arreglo = $data;

  echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));

mysqli_free_result($resultado);
mysqli_close($conexion);
?>
