<?php
//require '../lib/sesion.php';
require '../../assets/glib/isset.php';
header('Content-Type: application/json');
$arreglo= array();
$idcole=d("idcole");
$idalumno=d("id");
if ($idalumno=="" || $idalumno==0) {
    $sentencia = "SELECT * , (alumnos.activo) as estado FROM `alumnos` INNER JOIN `grados` ON alumnos.idgrado=grados.idgrado WHERE alumnos.idcole='$idcole'";
}else {
  $sentencia = "SELECT * , (alumnos.activo) as estado FROM `alumnos` INNER JOIN `grados` ON alumnos.idgrado=grados.idgrado WHERE alumnos.idcole='$idcole' AND alumnos.idalumno='$idalumno'";
}

include('../../conexion/conexion.php');
//$sentencia = "SELECT * FROM alumnos ";
$data=array();
$resultado = mysqli_query($conexion,$sentencia);
if (!$resultado) {
  echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);;
}
while ($datos=mysqli_fetch_array($resultado)) {
  $id=$datos['idalumno'];
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
    'genero' => $datos['genero'],
    'grado' => utf8_encode($datos['boton']),
    'nd' => $datos['nd'],
    'nm' => $datos['nm'],
    'na' => $datos['na'],
    'nacionalidad' => $datos['nacionalidad'],
    'doc' => $datos['doc'],
    'nodoc' => $datos['nodoc'],
    'encargado' => $datos['encargado'],
    'telencargado' => $datos['telencargado'],

    'otros' => $datos['otros'],
    //'<input type="text" class="form-control" id="id" value="'.$datos['activo'].'" readonly placeholder="id">'

    'activo' => $datos['estado'],
    //'activo' => '<input type="text" class="form-control" id="activo" value="'.$datos['activo'].'" readonly placeholder="id">',
    //'activo' => '<input id="activo" type="text" class="form-control" id="activo" value="'.$datos['activo'].'" readonly placeholder="id">',
    'clave' => $datos['clave'],
    'seccion' => $datos['seccion'],
    'nombre' => utf8_encode($datos['apellidos'].", ".$datos['nombres'])
  );

  array_push($data, $agg);

}


/////**********************************************************
$arreglo= $data;

echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

mysqli_free_result($resultado);
mysqli_close($conexion);
?>
