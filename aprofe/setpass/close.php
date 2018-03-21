<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
require '../../assets/crypt.php';
header('Content-Type: application/json');
$datos=array();
$actual=d("actual");
$nueva=d("nueva");
if ($nueva=="" || $actual=="") {

  $agg = array(
    'r' => false,
    'title'=>'Campos Vacios',
    'msg'=>utf8_encode('Debes especificar tu contraseña actual y tu nueva contraseña'),
    'type'=>'error'
  );
  array_push($datos, $agg);
  $arreglo = $datos;
  $ex=utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
  echo $ex;
}else {

  $sqlasesor="SELECT * FROM `usuarios` WHERE asociado='$idusuario' LIMIT 1";
  $query=mysqli_query($conexion,$sqlasesor);
  if ($query->num_rows==0) {
    $agg = array(
      'r' => false,
      'title'=>'Error Fatal',
      'msg'=>'No se ha encontrado tu usuario',
      'type'=>'error'
    );
    array_push($datos, $agg);
    $arreglo = $datos;
    $ex=utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
    echo $ex;
  }else {
    while ($g=mysqli_fetch_array($query)) {
      $idu=$idusuario;

      $hash=$g['pass'];
      $veri=password_verify($actual,$hash);
      //exit($veri);
      if ($veri) {
        $cryp=encriptar($nueva);
        $sql2="UPDATE `usuarios` SET `pass`='$cryp' WHERE idusuarios='$idu'";
        $query2=mysqli_query($conexion,$sql2);
        $agg = array(
          'r' => $veri,
          'title'=>utf8_encode('Contraseña Cambiada'),
          'msg'=>utf8_encode('Contraseña cambiada exitosamente'),
          'type'=>'success'
        );
        array_push($datos, $agg);
      }else {
        $agg = array(
          'r' => $veri,
          'title'=>utf8_encode('Contraseña Erronea'),
          'msg'=>utf8_encode('Error 0x001 Haz ingresado mal tu contraseña actual, intantalo de nuevo'),
          'type'=>'error'
        );
        array_push($datos, $agg);
      }
    }
  }
  $arreglo = $datos;
  echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
  mysqli_free_result($query);
  mysqli_close($conexion);
}


?>
