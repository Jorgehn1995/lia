<?php
require '../lib/sesion.php';
$val="4-3-2-A";
$v=explode("-",$val);
$idmateria=$v[0];
$bloque=$v[1];
$idgrado=$v[2];
$sec=$v[3];
header('Content-Type: application/json');
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
    $sqlnotas="SELECT idcuadro,s1,s2,h1,h2,h3,h4,h5,r1,r2,c1,c2,c3, (s1+s2+h1+h2+h3+h4+h5+r1+r2+c1+c2+c3) as tot FROM `cuadro` WHERE idalumno='$idalumno' AND idmateria='$idmateria' AND idbloque='$bloque'";
    $conect=mysqli_query($conexion,$sqlnotas);
    if ($conect) {
      $filas=$conect->num_rows;
      if ($filas==0) {
        $sqlinsert="INSERT INTO `cuadro`(`idcole`, `idgrado`, `idmateria`, `idbloque`, `idalumno`) VALUES ('$idcole','$idgrado','$idmateria','$bloque','$idalumno')";
        $r=mysqli_query($conexion,$sqlinsert);
        if ($r) {
          $conect=mysqli_query($conexion,$sqlnotas);
        }else {
          exit(errorsql($conexion));
        }
      }
      while ($a=mysqli_fetch_array($conect)) {
        $agg = array(
          'clave' => $clave,
          'idalumno' => $idalumno,
          'nombre'=> utf8_encode($nombre),
          'idcuadro' => $a['idcuadro'],
          's1'=>inputjson($a['s1'],"s1"),//val1: valor del input, val2: id del input
          'total'=>inputjson($a['tot'],"tot"),//val1: valor del input, val2: id del input
        );
        array_push($datos, $agg);
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
$arreglo["data"] = $datos;
echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
