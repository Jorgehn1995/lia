<?php
if (isset($_GET['user'])) {
  $usuario=$_GET['user'];
}else {
  exit('false');
}
if (isset($_GET['pass'])) {
  $contra=$_GET['pass'];
}else {
  exit('false');
}
$f=0;
require '../conexion/conexion.php';
//MODULOS  -   Tipo     -   Carpeta
//A        -   Master   -   Am
//D        -   admin    -   admin
//L        -   alumno   -   alumno
//P        -  profesor  -   aprofe
//G        -   pagos    -   apagos

$sql="SELECT * FROM `usuarios` WHERE usuario='$usuario'";
$r=mysqli_query($conexion,$sql);
while ($w=mysqli_fetch_array($r)) {
    $idasociado=$w['asociado'];
    $usuario=$w['usuario'];
    $idcole=$w['idcole'];
    $modulo=$w['modulo'];
    $pass=$w['pass'];
    $activo=$w['activo'];
    $f=password_verify($contra,$pass);
    if ($f==1) {
      break;
    }
}
if ($f==0) {
  $sql="SELECT * FROM `alumnos` WHERE codigo='$usuario'";
  $r=mysqli_query($conexion,$sql);
  while ($w=mysqli_fetch_array($r)) {
      $idasociado=$w['idalumno'];
      $usuario=$w['codigo'];
      $idcole=$w['idcole'];
      $modulo='L';
      $activo=$w['activo'];
      if ($activo=='Activo') {
        $activo=1;
      }else {
        $activo=0;
      }
      $pass=$w['pass'];
      if ($pass=='') {
        if ($w['na']==$contra) {
          $f=1;
        }else {
          $f=0;
        }
      }else {
        if ($pass==$contra) {
          $f=1;
        }else {
          $f=0;
        }
      }
      if ($f==1) {
        break;
      }
  }
}
if ($f>0) {
  if ($activo==0) {
    echo "disabled";
  }else {
    echo "$modulo";
    session_start();
    $_SESSION["usuario"]=$usuario;
    $_SESSION["idusuario"]=$idasociado;
    $_SESSION["idcole"]=$idcole;
    $_SESSION["modulo"]=$modulo;
  }
}else {
  echo "false";
}
include '../conexion/cerrar_conexion.php';
 ?>
