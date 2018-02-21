<?php
//header('Content-Type: application/json');
function data($alumno, $colegio, $bc = 1){
  require '../../conexion/conexion.php';
  $snt="SELECT * FROM `alumnos` WHERE idalumno='$alumno' AND idcole='$colegio'";
  $con=mysqli_query($conexion,$snt);
  while ($r=mysqli_fetch_array($con)) {
    $data['id'] =  $r['idalumno'];
    $data['clave'] =  $r['clave'];
    $data['codigo'] =  $r['codigo'];
    $data['nombres'] =  $r['nombres'];
    $data['apellidos'] =  $r['apellidos'];
    $data['genero'] =  $r['genero'];
    $data['nd'] =  $r['nd'];
    $data['nm'] =  $r['nm'];
    $data['na'] =  $r['na'];
    $data['nacimiento'] =  $r['nd']."/".$r['nm']."/".$r['na'];
    $data['nacionalidad'] =  $r['nacionalidad'];
    $data['doc'] =  $r['doc'];
    $data['nodoc'] =  $r['nodoc'];
    $data['encargado'] =  $r['encargado'];
    $data['telencargado'] =  $r['telencargado'];
    $data['otros'] =  $r['otros'];
    $data['seccion'] =  $r['seccion'];
    $data['codigo'] =  $r['codigo'];
    $data['grado'] =  $r['grado'];
    $data['estado'] =  $r['activo'];
    $data['idgrado'] =  $r['idgrado'];
    $idgrado=$r['idgrado'];
  }
  if (isset($idgrado)) {
    $snt="SELECT * FROM `grados` WHERE idgrado='$idgrado'  AND idcole='$colegio'";
    $con=mysqli_query($conexion,$snt);
    while ($r=mysqli_fetch_array($con)) {
      $data['cc'] =  $r['clases'];
    }
    $snt="SELECT * FROM `calificaciones` WHERE idalumno='$alumno'  AND idcole='$colegio'";
    $con=mysqli_query($conexion,$snt);
    while ($r=mysqli_fetch_array($con)) {
      $data['cp1'] =  $r['cp1'];
      $data['cp2'] =  $r['cp2'];
      $data['cp3'] =  $r['cp3'];
      $data['cp4'] =  $r['cp4'];
      $data['cpt'] =  $r['cpt'];
      $data['lg'] =  $r['lg'];
      $data['pro'] =  $r['pro'];
      $data['pun'] =  $r['pun'];
      if ($data['lg']==0) {
        $data['lg']="ND";
      }
      $data['ls'] =  $r['ls'];
      $data['prociclo'] = round($data['pro']/$data['cc'],2);
      if ($data['cpt']>0) {
        $b="cp"."$bc";
        $bc=$data[$b];
        if ($bc>0) {
          $rendisi=0;
        }else {
          $rendisi=1;
        }
      }else {
        $rendisi=3;
      }
      if ($rendisi==0) {
        $data['lblmsg']="Debe Mejorar";
        $data['lblcolor']="danger";
        $data['lblrgb']="R";
        $data['lblcongrats']="¡Debe Mejorar!";
        $data['lblcongrats2']="";
      }
      if ($rendisi==1) {
        $data['lblmsg']="Bueno";
        $data['lblcolor']="success";
        $data['lblrgb']="A";
        $data['lblcongrats']="Bueno";
        $data['lblcongrats2']="¡Felicitaciones!";
      }
      if ($rendisi==3) {
        $data['lblmsg']="Excelente";
        $data['lblcolor']="primary";
        $data['lblrgb']="V";
        $data['lblcongrats']="Excelente";
        $data['lblcongrats2']="¡Felicitaciones!";
      }
    }
  }
  include '../../conexion/cerrar_conexion.php';
  if (isset($data['codigo'])) {
    return $data;
  }else {
    return "false";
  }
}

function materias($grado, $colegio, $corto){
  require '../../conexion/conexion.php';
  $sql="SELECT * FROM `materias` WHERE idcole='$colegio' AND idgrado='$grado' ORDER BY num ASC";
  $found=mysqli_query($conexion,$sql);
  while ($m=mysqli_fetch_array($found)) {
    $num=$m["num"];
    $largo=$m["nombre"];
    $corto=$m["corto"];
    $mcorto[]="$corto";
    $mlargo[]="$largo";
    //echo $largo;
  }
  include '../../conexion/cerrar_conexion.php';
  if ($corto==0) {
    return $mcorto;
  }else {
    return $mlargo;
  }
}
//$datos["data"]=data(1,1);  //--------Print para json
//$datos=data(1,1);  //--------Print para php
//$materias=materias(1,1,0);
//echo $materias[1];
//echo utf8_decode(json_encode($datos, JSON_UNESCAPED_UNICODE));
 ?>
