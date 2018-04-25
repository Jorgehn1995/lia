<?php
$estatuto=session_status();
if ($estatuto < 2){
  session_start();
  $usuario=$_SESSION["usuario"];
  $idcole=$_SESSION["idcole"];
  $idusuario=$_SESSION["idusuario"];
}
if(isset($_SESSION["usuario"])){
  if (isset($_SESSION["modulo"])) {
    if ($_SESSION["modulo"]=="L") {

    }else {
      session_destroy();
      header("location:../../?s='over'");
    }
  }
}else{
  session_destroy();
  header("location:../../?s='over'");
}
require '../../conexion/conexion.php';
$consulta="SELECT * FROM `colegio` WHERE idcole = '$idcole'";
$resultado = mysqli_query($conexion,$consulta);
while($consultacole = mysqli_fetch_array($resultado)){
  $idcole=$consultacole["idcole"];
  $ncole = $consultacole["nombre"];
  $abrcole = $consultacole["abr"];
  $lemacole = $consultacole["lema"];
  $dircole = $consultacole["direccion"];
  $colecorreo = $consultacole["email"];
  $telcole = $consultacole["telefono"];
  $primaria = $consultacole["primaria"];
  $basico = $consultacole["basico"];
  $diversificado = $consultacole["diversificado"];
  $cole = "GES - $abrcole";
  $bloqueencurso= $consultacole["bloqueactual"];
  $logo="../../assets/img/faces/logo.jpg";
  $fotoperfil=$consultacole["logo"];
  $fpshared="../../assets/images/users/".$fotoperfil;
  $logobn="../../assets/images/users/b$fotoperfil";
  $logodoc="../../assets/images/".$consultacole["logodoc"];
  $logodocb="../../assets/images/b".$consultacole["logodoc"];
}
include '../../conexion/cerrar_conexion.php';
function labeljson($msg, $color){   //val1: caption del label, val2:color del label
  $lbl='<div class="text-center"><span class="badge badge-'.$color.'">'.$msg.'</span></div>';
  return $lbl;
}
function inputjson($val, $id){//val1: valor del input, val2: id del input
  $input='<input type="text"  style="display:block; margin:0; font-family:arial; font-size:8pt; padding-left:1px; padding-right:1px;" class="form-control datagrid" id="'.$id.'" value="'.$val.'" >';
  return $input;
}
function inputdatajson($val, $id, $data){//val1: valor del input, val2: id del input
  $input='<input type="number" data-idcuadro='.$data.' style="display:block; margin:0; font-family:arial; font-size:8pt; padding-left:1px; padding-right:1px;" class="form-control datagrid" id="'.$id.'" value="'.$val.'" >';
  return $input;
}
function inputdatajsoncuadro($val, $id, $data){//val1: valor del input, val2: id del input
  $input='<input type="text" data-idnota='.$data.' style="display:block; margin:0; font-family:arial; font-size:8pt; padding-left:1px; padding-right:1px;" class="form-control datagrid" id="'.$id.'" value="'.$val.'" >';
  return $input;
}
function inputdatajsoncuadrodisabled($val, $id, $data){//val1: valor del input, val2: id del input
  $input='<input type="text" disabled data-idnota='.$data.' style="display:block; margin:0; font-family:arial; font-size:8pt; padding-left:1px; padding-right:1px;" class="form-control datagrid" id="'.$id.'" value="'.$val.'" >';
  return $input;
}
function inputdatatareas($val, $id, $data){//val1: valor del input, val2: id del input
  $input='<input id="'.$id.'" type="number" data-idnota='.$data.' value="'.$val.'" class="datagrid" name="demo0" data-bts-min="-10" data-bts-max="100" data-bts-init-val="" data-bts-step="1" data-bts-decimal="10" data-bts-step-interval="100" data-bts-force-step-divisibility="" data-bts-step-interval-delay="500" data-bts-prefix="" data-bts-postfix="" data-bts-prefix-extra-class="" data-bts-postfix-extra-class="" data-bts-booster="true" data-bts-boostat="10" data-bts-max-boosted-step="false" data-bts-mousewheel="false"  data-bts-button-down-class="btn btn-success" data-bts-button-up-class="btn btn-success"/>';
  return $input;
}
function inputdatacuadro($val, $id, $data){//val1: valor del input, val2: id del input
  $input='<input id="'.$id.'" type="text" data-idnota='.$data.' value="'.$val.'" class=" form-control datagrid"     />';
  return $input;
}
function inputdisabled($val, $id){//val1: valor del input, val2: id del input
  $input='<input type="text" disabled style="display:block; margin:0; font-family:arial; font-size:8pt; padding-left:1px; padding-right:1px;" class="form-control datagrid" id="'.$id.'" value="'.$val.'" >';
  return $input;
}
function inputtotal($val, $id){//val1: valor del input, val2: id del input
  $input='<input type="text" disabled style="display:block; margin:0; font-family:arial; font-size:8pt; padding-left:1px; padding-right:1px;" class="form-control" id="'.$id.'" value="'.$val.'" >';
  return $input;
}
function errorsql($conexion){
  $err="Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
  return($err);
}
function cero($var){
  $cero="";
  if ($var==0) {
    return $cero;
  }else {
    return $var;
  }
}
function ago($time)
{
  $periodos = array("segundo", "minuto", "hora", "día", "semana", "mes", "año", "década");
  $duraciones = array("60","60","24","7","4.35","12","10");
  $now = time();
  $diferencia = $now - $time;
  for($j = 0; $diferencia >= $duraciones[$j] && $j < count($duraciones)-1; $j++) {
    $diferencia /= $duraciones[$j];
  }
  $diferencia = round($diferencia);
  if($diferencia != 1) {
    if($j != 5){
      $periodos[$j].= "s";
    }else{
      $periodos[$j].= "es";
    }
  }
  return "hace $diferencia ".utf8_encode($periodos[$j]);
  //echo ago(strtotime("2017-12-25"));
}
//require "../../assets/glib/isset.php";
?>
