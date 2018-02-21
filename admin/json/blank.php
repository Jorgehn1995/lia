<?php
function alumnosblank($idcole){
  require '../../conexion/conexion.php';
  $consulta="SELECT * FROM `alumnos` WHERE idcole='$idcole'";
  $con=mysqli_query($conexion,$consulta);
  $total = $con->num_rows;
  if($total==0){
    return 0;
  }else{
    return $total;
  }
  require '../../conexion/cerrar_conexion.php';
}
function profesoresblank($idcole){
  require '../../conexion/conexion.php';
  $consulta="SELECT * FROM `profesores` WHERE idcole='$idcole'";
  $con=mysqli_query($conexion,$consulta);
  $total = $con->num_rows;
  if($total==0){
    return 0;
  }else{
    return $total;
  }
  require '../../conexion/cerrar_conexion.php';
}
function gradosblank($idcole){
  require '../../conexion/conexion.php';
  $consulta="SELECT * FROM `grados` WHERE idcole='$idcole'";
  $con=mysqli_query($conexion,$consulta);
  $total = $con->num_rows;
  if($total==0){
    return 0;
  }else{
    return $total;
  }
  require '../../conexion/cerrar_conexion.php';
}
function usuariosblank($idcole){
  require '../../conexion/conexion.php';
  $consulta="SELECT * FROM `usuarios` WHERE usuario='$idcole'";
  $con=mysqli_query($conexion,$consulta);
  $total = $con->num_rows;
  if($total==0){
    return 0;
  }else{
    return $total;
  }
  require '../../conexion/cerrar_conexion.php';
}
if (isset($_GET['require'])) {
  $require=$_GET['require'];
  if (isset($_GET['idcole'])) {
    $idcole=$_GET['idcole'];
    if ($require=="alumnos") {
      echo alumnosblank($idcole);
    }
    if ($require=="profesores") {
      echo profesoresblank($idcole);
    }
    if ($require=="usuarios") {
      echo usuariosblank($idcole);
    }
    if ($require=="grados") {
      echo gradosblank($idcole);
    }

  }else {
    exit("error idcole");
  }
}else {
  exit("error require");
}


?>
