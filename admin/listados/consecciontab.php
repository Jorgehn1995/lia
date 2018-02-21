<?php
//header('Content-Type: application/json');

require '../lib/sesion.php';
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
$idgrado=d("idgrado");
$idcole=$_SESSION["idcole"];
$html="";
$numero=0;
$tabs="";
$sql="SELECT * FROM `grados` WHERE idcole='$idcole' AND idgrado='$idgrado'";
$query=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($query)) {
  $idgrado=$a['idgrado'];
  for ($i=1; $i <=5 ; $i++) {
    $nsec="sec".$i;
    if ($a[$nsec]!="") {
      if ($i==1) {
        $active="active";
      }else {
        $active="";
      }
      $tabs.='<li class="nav-item"><a href="#tab'.$i.'" data-toggle="tab" aria-expanded="true" class="nav-link '.$active.'">
        Seccion '.$a[$nsec].'
      </a></li>';
      $numero++;
    }
  }
  $col=12;
  for ($i=1; $i <=5 ; $i++) {
    $nsec="sec".$i;
    if ($a[$nsec]!="") {
      if ($i==1) {
        $active="show active";
      }else {
        $active="";
      }
      //echo $a[$nsec]." $col <br>";
      $sec=$a[$nsec];
      $html.='<div class="tab-pane fade '.$active.'" id="tab'.$i.'">
      <div class="col-md-'.$col.'">
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
$tabshead='<ul class="nav nav-tabs">
  '.$tabs.'
  </ul>';
$htmlhead='<div class="tab-content">'.$html.'</div>';
echo '<div class="col-md-6">
  <div class="card-box">'.$tabshead.$htmlhead.'</div>
</div>';


mysqli_free_result($resultado);
mysqli_close($conexion);


?>
