<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/datetime.php';
header('Content-Type: application/json');
// En versiones de PHP anteriores a la 4.1.0, debería utilizarse $HTTP_POST_FILES en lugar
// de $_FILES.
/**
 *@15 es para enlace y 16 es para youtube
 */

$raiz="./";
$idpersonal=$idusuario;
$nombre=d("nombre");
$direccion=d("dir");
$tipo=d("tipo");
$peso=0;

$dir_subida = '../../archivos/';
$uniqid=uniqid();
$extension = "link";


$ns=$nombre;
$nombresubido="M. Apoyo - ".$ns;
$tamanio=0;
$nombresistema=$direccion;
$fecha=$datetime;
if ($nombre=="" || $direccion=="" || $tipo=="") {
  $r=false;
}else {
  $r=true;
}

//$fichero_subido = $dir_subida . basename($_FILES['uploadfile']['name']);
$fichero_subido = $dir_subida . $nombresistema;

$data=array();
if ($r) {
  $tipoarchivo="14";
  $sqltipo="SELECT * FROM `tipoarchivo` WHERE extension='.$extension' LIMIT 1";
  $querytipo=mysqli_query($conexion,$sqltipo);
  if ($querytipo->num_rows==0) {
    $sqltipo="SELECT * FROM `tipoarchivo` WHERE extension='unknown' LIMIT 1";
    $querytipo=mysqli_query($conexion,$sqltipo);
  }
  while ($a=mysqli_fetch_array($querytipo)) {
    $idtipoarchivo=$a['idtipoarchivo'];
  }
  $sqlrn="SELECT * FROM `nube` WHERE idcole='$idcole' AND idpersonal='$idusuario' AND nombre='$nombresubido'";
  $queryrn=mysqli_query($conexion,$sqlrn);
  if ($queryrn->num_rows==0) {
    $dup="";
  }else {
    $dup="(".($queryrn->num_rows+1).") ";
  }
  $nombresubido=$dup.$nombresubido;
  $sqlup="INSERT INTO `nube`(`idcole`, `idpersonal`, `raiz`, `nombre`, `direccion`, `tipo`, `peso`, `creacion`, `eliminado`) VALUES ('$idcole','$idusuario','$raiz','$nombresubido','$nombresistema','$idtipoarchivo','$tamanio','$datetime','1')";
  $queryup=mysqli_query($conexion,$sqlup);
  if ($queryup) {
    $sqlrn="SELECT * FROM `nube` WHERE idcole='$idcole' AND idpersonal='$idusuario' AND nombre='$nombresubido'";
    $queryrn=mysqli_query($conexion,$sqlrn);
    while ($b=mysqli_fetch_array($queryrn)) {
      $idnube=$b['idnube'];
    }
    $agg = array(
      'r' => true,
      'title' => utf8_encode("Archivo Subido"),
      'msg' => utf8_encode("El archivo ".$nombresubido." se ha subido con exito a tu nube" ),
      'idfile'=> $idnube,
      'filename'=>utf8_encode($nombresubido),
      'cnotif'=>'success',
    );
    array_push($data, $agg);
  }else {
    errorsql($conexion);
  }
} else {
  $agg = array(
    'r' => false,
    'title' => utf8_encode("No Subido"),
    'msg' => utf8_encode("El archivo ".$nombresubido." NO se ha subido con exito a tu nube" ),
    'idfile'=> '',
    'filename'=>utf8_encode($nombresubido),
    'cnotif'=>'danger',
  );
  array_push($data, $agg);
  echo "¡Posible ataque de subida de ficheros!\n";
}
$arreglo= $data;

echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));

mysqli_free_result($resultado);
mysqli_close($conexion);
//echo 'Más información de depuración:';
//print_r($_FILES);

?>
