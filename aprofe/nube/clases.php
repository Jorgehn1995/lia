<?php
include '../lib/sesion.php';
if ($diversificado==1) {
  $h='<small class="text-success"><b>Habilitado</b></small>';
}else {
  $h='<small class="text-danger"><b>Deshabilitado</b></small>';
}
echo '<div class="col-lg-3 col-md-6">
  <div class="card-box widget-icon">
    <div>
      <i class=" ti-pie-chart "></i>
      <div class="wid-icon-info text-right">
        <p class="text-muted m-b-5 font-13 text-uppercase">BLOQUE ACTUAL</p>
        <h4 class="m-t-0 m-b-5 counter font-bold">'.$bloqueencurso.'</h4>
        '.$h.'
      </div>
    </div>
  </div>
</div>';
for ($i=$bloqueencurso; $i == $bloqueencurso ; $i++) {
  $bq = array("I" , "II","III","IV" );
  require '../../conexion/conexion.php';
  $sql="SELECT materias.idnombremateria, materias.idgrado, materias.seccion, nombrematerias.corto, nombrematerias.nombre FROM `materias` INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria  WHERE materias.idprofesor='$idusuario'  GROUP BY idnombremateria";
  //echo $usuario;
  $con=mysqli_query($conexion,$sql);
  if ($con) {
    while ($a=mysqli_fetch_array($con)) {
      $corto=$a['corto'];
      if ($diversificado==1) {
        $op='<div style="" class="row col-md-12">
          <div class="col-md-6 col-6">
            <div class="form-group">

                <a href="../notas/?idmateria='.$a['idnombremateria'].'&bloque='.$i.'&materia='.$a['nombre'].'"><button type="button" class="btn btn-block btn-success waves-effect waves-light">Cuadro</button></a>
            </div>
          </div>
          <div class="col-md-6 col-6">
            <div class="form-group">
              <a href="../notasxactividad/?idmateria='.$a['idnombremateria'].'&bloque='.$i.'&materia='.$a['nombre'].'"><button type="button" class="btn btn-block btn-success waves-effect waves-light">Actividades</button></a>
            </div>
          </div>
        </div>';
      }else {
        $op='<div style="" class="row col-md-12">
          <div class="col-md-6 col-6">
            <div class="form-group">

                <a href="../notas/?idmateria='.$a['idnombremateria'].'&bloque='.$i.'&materia='.$a['nombre'].'"><button type="button" class="btn btn-warning btn-success waves-effect waves-light">Ver Cuadro</button></a>
            </div>
          </div>
          <div class="col-md-6 col-6">
            <div class="form-group">
              <a href="../notasxactividad/?idmateria='.$a['idnombremateria'].'&bloque='.$i.'&materia='.$a['nombre'].'"><button type="button" class="btn btn-block btn-warning waves-effect waves-light">Promedios</button></a>
            </div>
          </div>
        </div>';
      }
      echo '<div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
          <div class="row">
            <a href="javascript:void(0)" class="header">
              <div >
                <img src="../../assets/images/users/icons/'.$corto.'.png" class="rounded-circle" alt="claseimg">
                <div class="wid-u-info" style="word-break: break-all;">
                  <p class=" text-success mt-0 m-b-5 font-16">'.$corto.' - B'.$bq[$i-1].'</p>
                  <p class="text-muted m-b-5 font-13"  style="word-wrap:break-word; cursor: pointer; white-space:normal;">'.$a['nombre'].'</p>
                </div>
              </div>
            </a>
          </div>
          <div class="row wbody" style="display:none; margin-top:25px !important;">
          '.$op.'
          </div>
        </div>
      </div>';
    }
  }else {
    echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
  }
  $sql2="SELECT * FROM `asesores` INNER JOIN `grados` ON asesores.idgrado=grados.idgrado WHERE asesores.idpersonal='$idusuario' LIMIT 1";
  $query2=mysqli_query($conexion,$sql2);
  if ($query2->num_rows>0) {
    while ($c=mysqli_fetch_array($query2)) {
      $nombregrado=$c['boton'];
      $sec=$c['seccion'];
      if ($diversificado==1) {
        $op='<div style="" class="row col-md-12">
          <div class="col-md-6 col-6">
            <div class="form-group">

                <a href="../notasasesores/?idgrado='.$c['idgrado'].'&bloque='.$i.'&seccion='.$c['seccion'].'"><button type="button" class="btn btn-block btn-success waves-effect waves-light">Cuadro</button></a>
            </div>
          </div>
          <div class="col-md-6 col-6">
            <div class="form-group">

            </div>
          </div>
        </div>';
      }else {
        $op='<div style="" class="row col-md-12">
          <div class="col-md-12 col-12">
            <div class="form-group">


            </div>
          </div>
        </div>';
      }
      echo '<div class="col-lg-3 col-md-6">
        <div class="card-box widget-user">
          <div class="row">
            <a href="javascript:void(0)" class="header">
              <div >
                <img src="../../assets/images/users/icons/asesor.png" class="rounded-circle" alt="claseimg">
                <div class="wid-u-info" style="word-break: break-all;">
                  <p class=" text-success mt-0 m-b-5 font-16">Asesor - B'.$bq[$i-1].'</p>
                  <p class="text-muted m-b-5 font-13"  style="word-wrap:break-word; cursor: pointer; white-space:normal;">'.$nombregrado." ".$sec.'</p>
                </div>
              </div>
            </a>
          </div>
          <div class="row wbody" style="display:none; margin-top:25px !important;">
          '.$op.'
          </div>
        </div>
      </div>';
    }
  }
  require '../../conexion/cerrar_conexion.php';
}
 ?>
