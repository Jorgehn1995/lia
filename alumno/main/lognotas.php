<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/datetime.php';
require '../../assets/glib/isset.php';
//header('Content-Type: application/json');
$arreglo= array();
$sentencia = "SELECT * FROM `cambiosennotas` INNER JOIN `alumnos` ON cambiosennotas.idalumno=alumnos.idalumno  WHERE cambiosennotas.idpersonal='$idusuario'  ORDER BY cambiosennotas.idcambio DESC LIMIT 50";
$agg="";
$resultado = mysqli_query($conexion,$sentencia);
while ($a=mysqli_fetch_array($resultado)) {
  $n=($a['nombres']." ".$a['apellidos']);
  $na=$a['notaanterior'];
  $nn=$a['notanueva'];
  $idnota=$a['idnota'];
  $idmateria=$a['idmateria'];
  $bloque=$a['bloque'];
  $idgrado=$a['idgrado'];
  $sec=$a['seccion'];
  $sql2="SELECT * FROM `materias` INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria WHERE materias.idgrado='$idgrado' AND materias.seccion='$sec' AND materias.idnombremateria='$idmateria' LIMIT 1";
  $query2=mysqli_query($conexion,$sql2);
  while ($b=mysqli_fetch_array($query2)) {

    $nombreficha=$b['nombreficha'];
    if ($nombreficha=="") {
      $nombremateria=$b['nombre'];
    }else {
      $nombremateria=$b['nombreficha'];
    }
  }
  $msg=$a['msg'];


  $txt="";
  $tt="";
  $c="";
  $dt=$a['hora'];
  $dx = new DateTime($dt, new DateTimeZone("America/Guatemala"));
  $ux=  $dx->getTimestamp();
  $hace=ago($ux);
  if ($msg==0) {
    $tt="Nota Eliminada";
    $c="danger";
    $txt="Le haz quitado <b>".$na."</b> puntos a <b>".$n."</b> en la clase <b>".($nombremateria)."</b>";
  }
  if ($msg==1) {
    $tt="Nota Agregada";
    $c="success";
    $txt="Le haz agregado <b>".$nn."</b> puntos a <b>".$n."</b> en la clase <b>".($nombremateria)."</b>";
  }
  if ($msg==2 || $msg==3) {
    $tt="Nota Cambiada";
    $c="warning";
    if ($na>$nn) {
      $mm="bajado";
    }else {
      $mm="subido";
    }
    $txt="Haz $mm la nota del alumno <b>".$n."</b> de <b>".$na."</b> a <b>".$nn."</b> puntos en la clase <b>".($nombremateria)."</b>";
  }
  if ($msg==4) {
    $tt="Nota Eliminada";
    $c="danger";
    $txt="Haz revertido un cambio de nota a <b>".$n."</b> de <b>".$na."</b> a <b>".$nn."</b> puntos en la clase <b>".($nombremateria)."</b>";
  }
  $agg .= '<li class="clearfix ">

    <div class="conversation-text">
      <div class="ctext-wrap">
         <i class="text-'.$c.'"> '.$tt.'</i>
        <i class="text-muted"><small>'.utf8_decode($hace).'</small></i>
        <p>
          '.$txt.'
        </p>
        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <a href="#" class="text-success"><b>Ver</b></a>
              <a href="#" class="text-danger"><b>Deshacer</b></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </li>';

}


/////**********************************************************
echo "$agg";



mysqli_free_result($resultado);
mysqli_close($conexion);
?>
