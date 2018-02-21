<?php
//header('Content-Type: application/json');

require '../lib/sesion.php';
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
$idgrado=d("idgrado");
$alig=d("alig");
$idcole=$_SESSION["idcole"];
$html="";
$numero=0;
$sql="SELECT * FROM `grados` WHERE idcole='$idcole' AND idgrado='$idgrado'";
$query=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($query)) {
  $idgrado=$a['idgrado'];
  for ($i=1; $i <=5 ; $i++) {
    $nsec="sec".$i;
    if ($a[$nsec]!="") {
      $numero++;
    }
  }
  $col=12;
  if ($numero==2) {
    $col=6;
  }
  if ($numero==3) {
    $col=4;
  }
  if ($numero==4) {
    $col=3;
  }
  if ($numero==5) {
    $col=2;
  }
  for ($i=1; $i <=5 ; $i++) {
    $nsec="sec".$i;
    if ($a[$nsec]!="") {
      //echo $a[$nsec]." $col <br>";
      $sec=$a[$nsec];
      $html.='<div class="col-md-'.$col.'">
      <div class="card-box" id="div'.$nsec.'">
      <h4 class="m-t-0 m-b-30 header-title"><b>Seccion '.$sec.'</b></h4>
      <div class="custom-dd dd"  id="'.$nsec.'">';
      $sentencia = "SELECT * FROM `alumnos` WHERE idcole='$idcole' AND seccion='$sec' AND idgrado='$idgrado' ORDER BY clave";
      $resultado = mysqli_query($conexion,$sentencia);
      $list="";
      //$listhead=
      //$list.= '<ol class="dd-list">';
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
        $list.='<li class="dd-item dd-nochildren" data-id="'.$id.'">
          <div class="dd-handle">
            '.$datos['clave'].'. '.$datos['genero'].' - '.$datos['apellidos'].', '.$datos['nombres'].'<div class="pull-right"><span id="activo" class="badge badge-'.$color.'">'.$datos['activo'].'</span></div>'.'
          </div>
        </li>';
      }
      $totlist="";
      if ($list!="") {
        $totlist='<ol class="dd-list">'.$list.'</ol>';
      }
      $html.=$totlist;

      $html.='</div>
      </div>
      </div>';
      
    }

  }
}
echo $html;


mysqli_free_result($resultado);
mysqli_close($conexion);


?>
