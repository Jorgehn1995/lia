<?php
require '../lib/sesion.php';
header('Content-Type: application/json');
$arreglo= array();
$idcole=$_SESSION["idcole"];
$nomp='<span class="badge badge-danger">Sin Profesor</span>';

  $sentencia="SELECT * FROM `grados` WHERE idcole='$idcole'";
  include('../../conexion/conexion.php');
  //$sentencia = "SELECT * FROM alumnos ";
  $data=array();
  $resultado = mysqli_query($conexion,$sentencia);
  $act="Sin Asignar";
  while ($datos=mysqli_fetch_array($resultado)) {
    $cc=$datos['clases'];
    $nombreg=$datos['boton'];
    $idgrado=$datos['idgrado'];
    for ($i=1; $i <=5 ; $i++) {
      $n="sec".$i;
      $nsec=$datos[$n];
      if ($nsec!="") {
        $sql="SELECT * FROM `asesores` INNER JOIN `profesores` ON asesores.idpersonal=profesores.idprofesor WHERE asesores.idcole=$idcole AND asesores.idgrado='$idgrado' AND asesores.seccion='$nsec' LIMIT 1";
        $query=mysqli_query($conexion,$sql);
        if ($query->num_rows==0) {
          $idprofesor=0;
          $profesor=labeljson("Sin asesor asignado","danger");
        }else {
          while ($a=mysqli_fetch_array($query)) {
            $idprofesor=$a['idprofesor'];
            $profesor=utf8_encode($a['nombres']." ".$a['apellidos']);
          }
        }
        $agg = array(
          'idgrado' => $idgrado,
          'idcole' => $idcole,
          'idgrado'=>$idgrado,
          'seccion'=>$nsec,
          'nombregrado'=>utf8_encode($nombreg),
          'idprofesor'=>$idprofesor,
          'profesor'=>$profesor,
          'opciones'=> "<div class='pull-right btn-group'><button type='button' class='edit btn btn-warning btn-sm waves-effect waves-light m-b-5' title='Editar' ><i class=' ti-pencil-alt '></i></button></div>",
        );
        array_push($data, $agg);
      }
    }

  }
  /////**********************************************************
  $arreglo["data"] = $data;
  echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
  mysqli_free_result($resultado);
  mysqli_close($conexion);

?>
