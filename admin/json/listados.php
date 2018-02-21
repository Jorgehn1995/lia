<?php
header('Content-Type: application/json');
require '../lib/sesion.php';
require '../../assets/glib/isset.php';

$sec=d("sec");
$idcole=$_SESSION["idcole"];
if (isset($_GET['idgrado'])) {
  $idgrado=$_GET['idgrado'];
  if ($idgrado=="Grado") {
    $idgrado="all";
  }
  if ($idgrado=="all") {
    $sentencia = "SELECT * FROM `alumnos` WHERE idcole='$idcole'";
  }else {
    $idg=explode("-",$idgrado);
    $idgrado=$idg[0];
    $sec=$idg[1];
    $sentencia = "SELECT * FROM `alumnos` WHERE idcole='$idcole' AND seccion='$sec' AND idgrado='$idgrado' ORDER BY clave";
  }

  include('../../conexion/conexion.php');
  //$sentencia = "SELECT * FROM alumnos ";
  $data=array();
  $resultado = mysqli_query($conexion,$sentencia);

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
    $idg=$datos['idgrado'];
    $sqlg="SELECT * FROM `grados` where idgrado='$idg'";
    $query=mysqli_query($conexion,$sqlg);
    while ($a =mysqli_fetch_array($query)) {
      $ngrado=$a['boton'];
    }
    $agg = array(
      'idalumno' => $id,
      'idcole' => $datos['idcole'],
      'idgrado' => $datos['idgrado'],
      'codigo' => $datos['codigo'],
      'apellidos' => utf8_encode($datos['apellidos']),
      'nombres' => utf8_encode($datos['nombres']),
      'genero' => $datos['genero'],
      'grado' => $datos['idgrado'],
      'nd' => $datos['nd'],
      'nm' => $datos['nm'],
      'na' => $datos['na'],
      'nacionalidad' => $datos['nacionalidad'],
      'doc' => $datos['doc'],
      'nodoc' => $datos['nodoc'],
        'ngrado'=> utf8_encode($ngrado),
      'encargado' => $datos['encargado'],
      'telencargado' => $datos['telencargado'],
      'otros' => $datos['otros'],
      //'<input type="text" class="form-control" id="id" value="'.$datos['activo'].'" readonly placeholder="id">'

      'activo' => '<div class="pull-right"><span id="activo" class="badge badge-'.$color.'">'.$datos['activo'].'</span></div>',
      //'activo' => '<input type="text" class="form-control" id="activo" value="'.$datos['activo'].'" readonly placeholder="id">',
      //'activo' => '<input id="activo" type="text" class="form-control" id="activo" value="'.$datos['activo'].'" readonly placeholder="id">',
      'clave' => $datos['clave'],
      'seccion' => $datos['seccion'],
      'nombre' => utf8_encode($datos['apellidos'].", ".$datos['nombres'])
    );

    array_push($data, $agg);

  }


  /////**********************************************************
  $arreglo['data'] = $data;

  echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));

  mysqli_free_result($resultado);
  mysqli_close($conexion);
}

?>
