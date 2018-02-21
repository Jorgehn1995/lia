<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
header('Content-Type: application/json');
$val=d("id");
$val="1-1-1-A";
if ($val==0 || $val=="") {
  exit('{"data":[]}');
}
if ($val=="Grado") {
  exit('{"data":[]}');
}
$v=explode("-",$val);
$idmateria=$v[0];
$bloque=$v[1];
$idgrado=$v[2];
$sec=$v[3];
$datos=array();
$sql="SELECT clave, idalumno, CONCAT (apellidos,', ', nombres) as nombre FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' ORDER BY clave ASC";
$datos=array();
$resultado = mysqli_query($conexion,$sql);
if ($resultado) {
  while( $data = mysqli_fetch_array($resultado)){
    $clave=$data['clave'];
    $idalumno=$data['idalumno'];
    $nombre=$data['nombre'];

    $sqlactividades="SELECT * FROM `modelocuadro` WHERE idcole='$idcole' ORDER BY orden ASC";
    $queryactividades=mysqli_query($conexion,$sqlactividades);
    while ($act=mysqli_fetch_array($queryactividades)) {
      $idactividad=$act['idmodelo'];
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
          $agg[$idactividad]=inputdatajsoncuadro(cero($a['obtenido']),$idactividad,$a['idnota']);
        }

      }else {
        echo errorsql($conexion);
      }

    }
    $agg['nombre']= $nombre;
    $agg['clave']=$clave;
    array_push($datos, $agg);
  }
}else {
  echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
}
$arreglo["data"] = $datos;
echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
mysqli_free_result($resultado);
mysqli_close($conexion);
 ?>
