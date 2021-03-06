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
      $sk="SELECT * FROM `materias` INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria INNER JOIN `profesores` ON materias.idprofesor=profesores.idprofesor WHERE materias.idgrado='$idgrado' AND materias.idcole='$idcole' AND materias.num='$i' AND materias.seccion='$sec'";
      $con=mysqli_query($conexion,$sk);
      if ($con) {
        $n=$con->num_rows;
        if ($n==0) {
          $agg = array(
            'idgrado' => $idgrado,
            'idcole' => $idcole,
            'idmateria'=>0,
            'num' => $i,
            'idnombremateria'=>inputjson("","idmateria"),//val1: valor del input, val2: id del input
            'nombremateria'=>labeljson("No Asignada","danger"),//val1: caption del label, val2:color del label
            'codprofe'=>inputjson("","codprofe"),
            'nombreprofe' => labeljson("Sin Profesor","danger"),
            'activo' => 'No',
          );
          array_push($data, $agg);
        }else {
          while ($a =mysqli_fetch_array($con)) {
            $nombreprofesor=$a['nombres']." ".$a['apellidos'];
            $idnm=$a['idnombremateria'];
            $idp=$a['idprofesor'];
            $agg = array(
              'idgrado' => $idgrado,
              'idcole' => $idcole,
              'idmateria'=>$a['idmateria'],
              'num' => $a['num'],
              'idnombremateria'=>inputjson("$idnm","idmateria"),
              'nombremateria'=>utf8_encode($a['nombre']),
              'codprofe'=>inputjson("$idp","codprofe"),
              'nombreprofe' => utf8_encode($nombreprofesor),
              'activo' => $a['activo'],
            );
            array_push($data, $agg);
          }
        }
      }else {
        echo "<br>Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
      }
    }
  }
  /////**********************************************************
  $arreglo["data"] = $data;
  echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
  mysqli_free_result($resultado);
  mysqli_close($conexion);
}
?>
