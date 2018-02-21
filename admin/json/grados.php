<?php
require '../lib/sesion.php';
header('Content-Type: application/json');
$arreglo= array();
$idcole=$_SESSION["idcole"];

$sentencia = "SELECT * FROM `grados` WHERE idcole='$idcole'";

include('../../conexion/conexion.php');
//$sentencia = "SELECT * FROM alumnos ";
$data=array();
$resultado = mysqli_query($conexion,$sentencia);
while ($datos=mysqli_fetch_array($resultado)) {
  $id=$datos['idgrado'];
  if ($datos['activo']=="Activo") {
    $color="success";
  }
  if ($datos['activo']=="Retirado") {
    $color="danger";
  }
  if ($datos['activo']=="Suspendido") {
    $color="warning";
  }
  $sec="";
  //$datos['sec1']." - ".$datos['sec2']." - ".$datos['sec3']." - ".$datos['sec4']." - ".$datos['sec5'];
  $opciones='<div class="pull-right">
  <div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Materias <span class="caret"></span></button>
  <div class="dropdown-menu">';
  $bt="";
  for ($s=1; $s <=5 ; $s++) {
    $n="sec".$s;
    if ($datos[$n]=="") {

    }else {
      if ($s>1) {
        $sec.=" - ";
      }
      $sec.=$datos[$n];
      $bt.='<a class="dropdown-item" href="../asignarmaterias/?idgrado='.$id.'&sec='.$datos[$n].'">Seccion '.$datos[$n].'</a>';
    }
  }
  $bt.='  </div></div></div>';
  $opciones.=$bt;
  $agg = array(
    'idgrado' => $id,
    'idcole' => $datos['idcole'],
    'ciclo' => utf8_encode($datos['ciclo']),
    'grado' => utf8_encode($datos['grado']),
    'nombre' => utf8_encode($datos['nombre']),
    'corto' => utf8_encode($datos['corto']),
    'boton' => utf8_encode($datos['boton']),
    'secciones' => $sec,
    'sec1' => $datos['sec1'],
    'sec2' => $datos['sec2'],
    'sec3' => $datos['sec3'],
    'sec4' => $datos['sec4'],
    'sec5' => $datos['sec5'],
    'opciones'=>$opciones,
    'activo' => '<span id="activo" class="badge badge-'.$color.'">'.$datos['activo'].'</span>',
    'clases' => $datos['clases'],
  );

  array_push($data, $agg);

}


/////**********************************************************
$arreglo["data"] = $data;

echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));

mysqli_free_result($resultado);
mysqli_close($conexion);
?>
