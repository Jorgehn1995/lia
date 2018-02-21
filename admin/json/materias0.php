<?php
require '../lib/sesion.php';
header('Content-Type: application/json');
$arreglo= array();
$idcole=$_SESSION["idcole"];
$nomp='<span class="badge badge-danger">Sin Profesor</span>';
if (isset($_GET['idgrado'])) {
  $idgrado=$_GET['idgrado'];
  if (isset($_GET['sec'])) {
    $sec=$_GET['sec'];
  }
  $sentencia="SELECT * FROM `grados` WHERE idgrado='$idgrado' AND idcole='$idcole'";
  include('../../conexion/conexion.php');
  //$sentencia = "SELECT * FROM alumnos ";
  $data=array();
  $resultado = mysqli_query($conexion,$sentencia);
  $act="Sin Asignar";
  while ($datos=mysqli_fetch_array($resultado)) {
    $cc=$datos['clases'];
    for ($i=1; $i <=$cc ; $i++) {
      $sk="SELECT * FROM `materias` WHERE idgrado='$idgrado' AND idcole='$idcole' AND num='$i' AND seccion='$sec'";
      $con=mysqli_query($conexion,$sk);
      $n=$con->num_rows;
      if ($n==0) {
        $num=$i;
        $idmateria=0;
        $nom=labeljson("Sin Profesor","danger");
        $cor=labeljson("Sin Profesor","danger");
        $idp="Sin Asignar";
        $act="No";
      }else {
        while ($a =mysqli_fetch_array($con)) {
          $idmateria=$a['idmateria'];
          $num=$a['num'];
          $nom=$a['nombre'];
          $cor=$a['corto'];
          $idp=$a['idpersonal'];
          $act=$a['activo'];
        }
      }
      if ($idp=="Sin Asignar") {
        $nomp='<span class="badge badge-danger">Sin Asignar</span>';
      }else {
        $skp="SELECT * FROM `profesores` WHERE idprofesor='$idp'";
        $conp=mysqli_query($conexion,$skp);
        while ($b=mysqli_fetch_array($conp)) {
          $nomp=utf8_encode($b['nombres']." ".$b['Apellidos']);
        }
      }
      for ($e=1; $e <=5 ; $e++) {
        $noma='sec'.$e;
        $ag["$noma"] = $datos[$noma];
      }
      $codprofe='<input type="text" class="form-control" id="codprofe" value="codprofe'.$i.'" >';
      $idnombremateria='<input type="text" class="form-control" id="idmateria" value="codmateria'.$i.'" >';
      $agg = array(
        'idgrado' => $idgrado,
        'idcole' => $datos['idcole'],
        'activo' => $act,
        'num' => $num,
        'idmateria'=>$idmateria,
        'idnombremateria'=>$idnombremateria,
        'codprofe'=>$codprofe,
        'nombre' => utf8_encode($nom),
        'corto' => utf8_encode($cor),
        'idpersonal' => $idp,
        'profesor' => $nomp,
      );
      array_push($data, $agg);
    }
  }


  /////**********************************************************
  $arreglo["data"] = $data;

  echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));

  mysqli_free_result($resultado);
  mysqli_close($conexion);
}

?>
