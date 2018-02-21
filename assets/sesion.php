<?php
$estatuto=session_status();
if ($estatuto < 2){
  session_start();
  $usuario=$_SESSION["usuario"];
  $idcole=$_SESSION["idcole"];
  $modulo=$_SESSION["modulo"];
}
if(isset($_SESSION["usuario"])){
}else{
  session_destroy();
  header("location:../../?s='over'");
}
if ($idcole>0) {
  require '../../conexion/conexion.php';
  $consulta="SELECT * FROM `colegio` WHERE idcole = '$idcole'";
  $resultado = mysqli_query($conexion,$consulta);
  while($consultacole = mysqli_fetch_array($resultado)){
    $idcole=$consultacole["idcole"];
    $ncole = $consultacole["nombre"];
    $abrcole = $consultacole["abr"];
    $lemacole = $consultacole["lema"];
    $dircole = $consultacole["direccion"];
    $telcole = $consultacole["telefono"];
    $primaria = $consultacole["primaria"];
    $basico = $consultacole["basico"];
    $diversificado = $consultacole["diversificado"];
    $cole = "GES - $abrcole";
    $bloqueencurso= $consultacole["bloqueactual"];
    $logo="../../assets/img/faces/logo.jpg";
    $fotoperfil=$consultacole["logo"];
    $fpshared="profile/".$fotoperfil;
  }
  include '../../conexion/cerrar_conexion.php';
}else {
  $cole="GES";
  $abrcole="Area de Desarrollo";
}
?>
