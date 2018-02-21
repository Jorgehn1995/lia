<?php
require '../lib/sesion.php';
header('Content-Type: application/json');
$arreglo= array();
if (isset($_GET['orden'])) {
  $orden=" ORDER BY alumnos.".$_GET['orden']." ASC";
}else {
  $orden="";
}
$idcole=$_SESSION["idcole"];
if (isset($_POST['field'])) {
  $field=$_POST['field'];
  $datos=$_POST['data'];
  $sentencia = "SELECT * FROM alumnos WHERE idcole='$idcole' AND $field='$datos'";
}else {
  $sentencia = "SELECT *, (alumnos.activo) alactivo FROM `alumnos` INNER JOIN `grados` ON alumnos.idgrado=grados.idgrado WHERE alumnos.idcole='$idcole' $orden";
}
include('../../conexion/conexion.php');
$data=array();
$resultado = mysqli_query($conexion,$sentencia);
while ($datos=mysqli_fetch_array($resultado)) {
  $id=$datos['idalumno'];
  if ($datos['alactivo']=="Activo") {
    $color="success";
  }
  if ($datos['alactivo']=="Retirado") {
    $color="danger";
  }
  if ($datos['alactivo']=="Suspendido") {
    $color="warning";
  }
  $agg = array(
    'idalumno' => $id,
    'idcole' => $datos['idcole'],
    'codigo' => $datos['codigo'],
    'apellidos' => utf8_encode($datos['apellidos']),
    'nombres' => utf8_encode($datos['nombres']),
    'genero' => $datos['genero'],
    'grado' => utf8_encode($datos['boton']),
    'nd' => $datos['nd'],
    'nm' => $datos['nm'],
    'na' => $datos['na'],
    'nacimiento' => date("d/m/Y",strtotime($datos['nacimiento'])),
    'edad' => (date("Y-m-d")-$datos['nacimiento']).utf8_encode(" Años"),
    'nacionalidad' => $datos['nacionalidad'],
    'doc' => $datos['doc'],
    'nodoc' => $datos['nodoc'],
    'encargado' => $datos['encargado'],
    'telencargado' => $datos['telencargado'],
    'otros' => $datos['otros'],
    'activo' => '<span id="activo" class="badge badge-'.$color.'">'.$datos['alactivo'].'</span>',
    'clave' => $datos['clave'],
    'seccion' => $datos['seccion'],
    'ua' => date("d/m/Y",strtotime($datos['ultimaactualizacion']))." a las ".date("h:i a",strtotime($datos['ultimaactualizacion'])),
    'ins' => date("d/m/Y",strtotime($datos['insertdate']))." a las ".date("h:i a",strtotime($datos['insertdate'])),
    'nombre' => utf8_encode($datos['apellidos'].", ".$datos['nombres']),
    'opciones'=> "<div class='pull-right btn-group'><button type='button' data-toggle='modal' data-target='#infoalumno'  class='info btn btn-primary  btn-sm waves-effect waves-light m-b-5'  title='Ver Datos' ><i class=' ti-info-alt '></i></button><button type='button' class='edit btn btn-warning btn-sm waves-effect waves-light m-b-5' onClick='location=modificar.php?id=$id' title='Editar' ><i class=' ti-pencil-alt '></i></button></div>"
  );
  array_push($data, $agg);
}
/////**********************************************************
$arreglo["data"] = $data;
echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
include('../../conexion/cerrar_conexion.php');
?>
