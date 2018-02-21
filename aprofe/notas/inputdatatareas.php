<?php
require '../lib/sesion.php';
require "../../assets/glib/isset.php";
//header('Content-Type: application/json');
$val=d("id");
if ($val==0 || $val=="") {
  exit('{"data":[]}');
}
if ($val=="Grado") {
  exit('{"data":[]}');
}
//$val="4-3-5-A";
$v=explode("-",$val);
$idmateria=$v[0];
$bloque=$v[1];
$idgrado=$v[2];
$sec=$v[3];
$idactividad=$v[4];
//$arreglo= array();

$idcole=$_SESSION["idcole"];
$sql="SELECT clave, idalumno, CONCAT (apellidos,', ', nombres) as nombre FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' ORDER BY clave ASC";
//$sentencia="SELECT * FROM `grados` WHERE idgrado='$idgrado' AND idcole='$idcole'";
include('../../conexion/conexion.php');
//$sentencia = "SELECT * FROM alumnos ";
$datos=array();
$resultado = mysqli_query($conexion,$sql);
$act="Sin Asignar";
if ($resultado) {
  while( $data = mysqli_fetch_array($resultado)){
    $clave=$data['clave'];
    $idalumno=$data['idalumno'];
    $nombre=$data['nombre'];
    $sqlnotas="SELECT idnota, asignado, obtenido FROM `notas` WHERE idalumno='$idalumno' AND idmateria='$idmateria' AND idbloque='$bloque' AND idmodelo='$idactividad'";
    $conect=mysqli_query($conexion,$sqlnotas);
    if ($conect) {
      $filas=$conect->num_rows;
      if ($filas==0) {
        $sqlinsert="INSERT INTO `notas`(`idnota`, `idcole`, `idgrado`, `idmateria`, `idbloque`, `idmodelo`, `idalumno`, `asignado`, `obtenido`) VALUES ('','$idcole','$idgrado','$idmateria','$bloque','$idactividad','$idalumno','0','0')";
        $r=mysqli_query($conexion,$sqlinsert);
        if ($r) {
          $conect=mysqli_query($conexion,$sqlnotas);
        }else {
          exit(errorsql($conexion));
        }
      }
      while ($a=mysqli_fetch_array($conect)) {
        echo '<div class="inbox-item ">
          <p class="inbox-item-text">Clave '.$clave.'</p>
          <p class="inbox-item-author">'.$nombre.'</p>
          <p class="inbox-item-date"></p>
          <div class="form-group">
            '.inputdatatareas(cero($a['obtenido']),$idactividad,$a['idnota']).'
          </div>
        </div>';
      }
    }else {
      echo errorsql($conexion);
    }


    //$arreglo[] = array_map("utf8_encode",$data);
  }
}else {
  echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
}
/////**********************************************************
//$arreglo["data"] = $datos;
//echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
