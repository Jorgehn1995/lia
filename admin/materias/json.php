<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
header('Content-Type: application/json');
$data=array();
$sql="SELECT * FROM `nombrematerias` WHERE idcole='$idcole' ORDER BY idnombremateria";
$resultado = mysqli_query($conexion,$sql);
if(!$resultado){
  errorsql($conexion);
}else{
  while( $datos = mysqli_fetch_array($resultado)){
    $agg = array(
      'idnombremateria' => $datos['idnombremateria'],
      'nombre' => utf8_encode($datos['nombre']),
      'corto' => utf8_encode($datos['corto']),
      'opciones'=>"<div class='pull-right btn-group'><button type='button' class='edit btn btn-warning btn-sm waves-effect waves-light m-b-5' title='Editar' ><i class=' ti-pencil-alt '></i></button></div>",
    );
    array_push($data, $agg);
  }

}

$arreglo["data"]= $data;

echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));
require '../../conexion/cerrar_conexion.php';
 ?>
