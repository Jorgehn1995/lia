<?php
date_default_timezone_set("America/Guatemala");
$estatuto=session_status();
if ($estatuto < 2){
  session_start();
  $usuario=$_SESSION["usuario"];
  $idcole=$_SESSION["idcole"];
}
if(isset($_SESSION["usuario"])){
  if ($_SESSION["modulo"]=="D") {

  }else {
    session_destroy();
    header("location:../../?s='over'");
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
  $dominio = $consultacole["token"];
  $dircole = $consultacole["direccion"];
  $colecorreo = $consultacole["email"];
  $telcole = $consultacole["telefono"];
  $primaria = $consultacole["primaria"];
  $basico = $consultacole["basico"];
  $diversificado = $consultacole["diversificado"];
  $cole = "LIA - $abrcole";
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
  $input='<input type="text" class="form-control" id="'.$id.'" value="'.$val.'" >';
  return $input;
}
function errorsql($conexion){
  $err="Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
  return($err);
}
function ago($time){
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
function dmylargo($data){
  $dd=date_format(date_create_from_format('d/m/Y',$data),'Y-m-d');
  $d=strtotime($dd);
  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

  $di=$dias[date('w',$d)]." ".date('d',$d)." de ".$meses[date('n',$d)-1]. " del ".date('Y',$d);
  return  utf8_decode($di);
  //Salida: Viernes 24 de Febrero del 2012
}
function calcularedades($idcole){
  $r=0;
  include('../../conexion/conexion.php');
  $sql="DELETE FROM `edades` WHERE idcole='$idcole'";
  $cn=mysqli_query($conexion,$sql);
  $sql2="DELETE FROM `edadesxgrado` WHERE idcole='$idcole'";
  $cn2=mysqli_query($conexion,$sql2);

  $sentencia = "SELECT * FROM `alumnos` WHERE idcole='$idcole'";
  $resultado = mysqli_query($conexion,$sentencia);
  while ($g=mysqli_fetch_array($resultado)) {
    $nacimiento=$g['na']."-".$g['nm']."-".$g['nd'];
    $actual=date("Y-m-d");
    $edad=$actual-$nacimiento;
    $filas=0;
    $cantidad=0;
    $sk="SELECT * FROM `edades` WHERE idcole='$idcole' AND edades='$edad años'";
    $cn=mysqli_query($conexion,$sk);
    while ($a=mysqli_fetch_array($cn)) {
      $filas=1;
      $cantidad=$a['cantidades']+1;
      $idresultado=$a['idresultado'];
    }
    if ($filas>0) {
      $sql="UPDATE `edades` SET `cantidades`='$cantidad' WHERE idresultado='$idresultado'";
    }else {
      $sql="INSERT INTO `edades`(`idresultado`, `idcole`, `edades`, `cantidades`) VALUES ('0','$idcole','$edad años','1')";
    }
    $cn=mysqli_query($conexion,$sql);
  }
  $cantidad=0;
  $sql2="SELECT * FROM `grados` WHERE idcole='$idcole'";
  $query2=mysqli_query($conexion,$sql2);
  if ($query2) {
    while ($a=mysqli_fetch_array($query2)) {
      $idgrado=$a['idgrado'];
      $sql="DELETE FROM `edadesxgrado` WHERE idcole='$idcole' AND idgrado='$idgrado'";
      $cn=mysqli_query($conexion,$sql);
      $sentencia = "SELECT * FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado'";
      $resultado = mysqli_query($conexion,$sentencia);
      while ($g=mysqli_fetch_array($resultado)) {
        $nacimiento=$g['na']."-".$g['nm']."-".$g['nd'];
        $actual=date("Y-m-d");
        $edad=$actual-$nacimiento;
        $filas=0;
        $cantidad=0;
        $sk="SELECT * FROM `edadesxgrado` WHERE idcole='$idcole' AND idgrado='$idgrado' AND edades='$edad años'";
        $cn=mysqli_query($conexion,$sk);
        while ($a=mysqli_fetch_array($cn)) {
          $filas=1;
          $cantidad=$a['cantidades']+1;
          $idresultado=$a['idresultado'];
        }
        if ($filas>0) {
          $sql="UPDATE `edadesxgrado` SET `cantidades`='$cantidad' WHERE idresultado='$idresultado'";
        }else {
          $sql="INSERT INTO `edadesxgrado`(`idresultado`,`idgrado`, `idcole`, `edades`, `cantidades`) VALUES ('0','$idgrado','$idcole','$edad años','1')";
        }
        $cn=mysqli_query($conexion,$sql);
      }
    }
  }
  include('../../conexion/cerrar_conexion.php');
}
function nim_profe($modulor,$idreceptor,$action){
  setlocale(LC_ALL, 'es_GT');
  date_default_timezone_set("America/Guatemala");
  $fecha=date("Y-m-d h:i:s");
  $modulor="P";
  $modulom="D";
  $idemisor=$idcole;
  require '../../conexion/conexion.php';
  if ($msg!="") {
    $sql="INSERT INTO `notificaciones` VALUES ('0','$modulom','$idemisor','$modulor','$idreceptor','$titulo','$msg','$fecha','$link','')";
    $query=mysqli_query($conexion,$sql);
  }
  include '../../conexion/cerrar_conexion.php';
}
//require "../../assets/glib/isset.php";
?>
