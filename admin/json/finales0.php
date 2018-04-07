<?php
header('Content-Type: application/json');
require '../lib/sesion.php';
require '../lib/data.php';
$r=0;
if (isset($_GET['idgrado'])) {
  $f=$_GET['idgrado'];
  $f2=explode("-",$f);
  $idgrado=$f2['0'];
  $seccion=$f2['1'];
}
function finales($seccion, $idgrado, $idcole){
  $data=array();
  include('../../conexion/conexion.php');
  $sentencia = "SELECT * FROM `alumnos` WHERE idgrado='$idgrado' AND seccion='$seccion' order by clave";
  $resultado = mysqli_query($conexion,$sentencia);
  while ($g=mysqli_fetch_array($resultado)) {
    $id=$g['idalumno'];
    $datos=data($id,$idcole,3);
    if (isset($data)) {
      $agg = array('id' => $id, 'clave' => $datos['clave'], 'nombre' => utf8_encode($datos['apellidos'].", ".$datos['nombres']), 'clases' => $datos['cc']);
      for ($i=1; $i <=$datos['cc'] ; $i++) {
        $fin=0;
        $sq="SELECT * FROM `cuadro` WHERE idcole='$idcole' AND idalumno='$id' AND idmateria='$i'";
        $ccon=mysqli_query($conexion,$sq);
        while ($cuadro=mysqli_fetch_array($ccon)) {
          $fin=$fin+$cuadro['porcentaje'];
        }
        $tf=$fin;
        $c="f".$i;
        $agg[$c]=$tf;
      }
      array_push($data, $agg);
    }else {
      $agg = array('id' => $id, 'clave' => $datos['clave'], 'nombre' => utf8_encode($datos['apellidos']." ".$datos['nombres']), 'clases' => $datos['cc']);
      for ($i=1; $i <=$datos['cc'] ; $i++) {
        $fin=0;
        $sq="SELECT * FROM `cuadro` WHERE idcole='$idcole' AND idalumno='$id' AND idmateria='$i'";
        $ccon=mysqli_query($conexion,$sq);
        while ($cuadro=mysqli_fetch_array($ccon)) {
          $fin=$fin+$cuadro['total'];
        }
        $tf=$fin/$datos['cc'];
        $c="f".$i;
        $agg[$c]=$tf;
      }
      array_push($data, $data);
    }
  }
  $arreglo=$data;
  echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
  mysqli_free_result($resultado);
  mysqli_close($conexion);
}
finales($seccion, $idgrado, 1);
?>
