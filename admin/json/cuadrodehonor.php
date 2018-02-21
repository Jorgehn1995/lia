<?php
header('Content-Type: application/json');
require '../lib/sesion.php';
require '../lib/data.php';
$r=0;
if (isset($_GET['idgrado'])) {
  $idgrado=$_GET['idgrado'];
}
function finales($idgrado, $idcole , $tipe){
  $data=array();
  include('../../conexion/conexion.php');
  $lugar=0;
  if ($tipe==1) {
    $sentencia = "SELECT * FROM `calificaciones` WHERE idgrado='$idgrado' and idcole='$idcole' and cpt>0 order by cpt DESC";
  }else {
    $sentencia = "SELECT * FROM `calificaciones` WHERE idgrado='$idgrado' and idcole='$idcole' and cpt=0 order by pun DESC";
  }

  $resultado = mysqli_query($conexion,$sentencia);
  while ($g=mysqli_fetch_array($resultado)) {
    $id=$g['idalumno'];
    $datos=data($id,$idcole,3);
    $lugar=$lugar+1;
    if (isset($data)) {
      $agg = array('id' => $id, 'clave' => $datos['clave'], 'grado' => $datos['grado'], 'seccion' => $datos['seccion'], 'nombre' => utf8_encode($datos['apellidos'].", ".$datos['nombres']), 'clases' => $datos['cc']);
      $agg ['cp1'] = $g['cp1'];
      $agg ['cp2'] = $g['cp2'];
      $agg ['cp3'] = $g['cp3'];
      $agg ['cp4'] = $g['cp4'];
      $agg ['cpt'] = $g['cpt'];
      $agg ['pro'] = $datos['pro'];
      $agg ['pun'] = $datos['pun'];
      $agg ['lugar'] = $lugar;
      array_push($data, $agg);
    }else {
      $agg = array('id' => $id, 'clave' => $datos['clave'], 'nombre' => utf8_encode($datos['apellidos'].", ".$datos['nombres']), 'clases' => $datos['cc']);
      $agg ['cp1'] = $g['cp1'];
      $agg ['cp2'] = $g['cp2'];
      $agg ['cp3'] = $g['cp3'];
      $agg ['cp4'] = $g['cp4'];
      $agg ['cpt'] = $g['cpt'];
      $agg ['pro'] = $datos['pro'];
      $agg ['pun'] = $datos['pun'];
      $agg ['lugar'] = $lugar;
      array_push($data, $agg);
    }
  }
  $arreglo=$data;
  echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
  mysqli_free_result($resultado);
  mysqli_close($conexion);
}
if (isset($_GET['motivo'])) {
  $motivo=$_GET['motivo'];
  finales($idgrado, $idcole, $motivo);
}else {
  finales($idgrado, $idcole, 0);
}

?>
