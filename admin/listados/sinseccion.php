<?php
//header('Content-Type: application/json');
require '../lib/sesion.php';
require '../../assets/glib/isset.php';

$sec=d("sec");
$idcole=$_SESSION["idcole"];
if (isset($_GET['idgrado'])) {
  $idgrado=$_GET['idgrado'];
  if ($idgrado=="all") {
    $sentencia = "SELECT * FROM `alumnos` WHERE idcole='$idcole' ORDER BY apellidos";
  }else {
    $sentencia = "SELECT * FROM `alumnos` WHERE idcole='$idcole' AND seccion='' AND idgrado='$idgrado' ORDER BY apellidos ";
  }
  include('../../conexion/conexion.php');
  //$sentencia = "SELECT * FROM alumnos ";
  $data=array();
  $resultado = mysqli_query($conexion,$sentencia);
  $i=1;
  $html= '<ol class="dd-list">';
  while ($datos=mysqli_fetch_array($resultado)) {
    $id=$datos['idalumno'];
    if ($datos['activo']=="Activo") {
      $color="success";
    }
    if ($datos['activo']=="Retirado") {
      $color="danger";
    }
    if ($datos['activo']=="Suspendido") {
      $color="warning";
    }
    $html.='<li class="dd-item dd-nochildren" data-id="'.$id.'">
      <div class="dd-handle">
        '.$i.'. '.$datos['genero'].' - '.$datos['apellidos'].', '.$datos['nombres'].'<div class="pull-right"><span id="activo" class="badge badge-'.$color.'">'.$datos['activo'].'</span></div>'.'
      </div>
    </li>';
    $i++;
  }
  $html.='</ol>';
  echo "$html";
  mysqli_free_result($resultado);
  mysqli_close($conexion);
}

?>
