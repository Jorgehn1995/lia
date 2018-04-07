<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$val=d("id");
$id="";
$sqlasesor="SELECT * FROM `asesores` WHERE idpersonal='$idusuario' LIMIT 1";
$query=mysqli_query($conexion,$sqlasesor);
if ($query->num_rows==0) {
  exit('<div class="">
    <div class="text-center">
      <br>
      <img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
      <h3 class="text-muted">Sin Grado Asignado</h3>
      <div id="icon">
        <h5 class="text-muted">No tienes un grado asignado para esta sección </h5>
      </div>
    </div>
  </div>');
}else {
  while ($g=mysqli_fetch_array($query)) {
    $id="0-".$bloqueencurso."-".$g['idgrado']."-".$g['seccion'];
  }
}

$val=$id;
//$val="1-1-1-A";
if ($val=="") {
  exit('<div class="">
    <div class="text-center">
      <br>
      <img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
      <h3 class="text-muted">No Asignado</h3>
      <div id="icon">
        <h5 class="text-muted">No estas asignado como asesor </h5>
      </div>
    </div>
  </div>');
}
if ($val=="Grado") {
  exit('<div class="">
    <div class="text-center">
      <br>
      <img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
      <h3 class="text-muted">Error!</h3>
      <div id="icon">
        <h5 class="text-muted">Se produjo un error al cargar el cuadro <br> Error No: 0x0000002 </h5>
      </div>
    </div>
  </div>');
}
$v=explode("-",$val);
$idmateria=$v[0];
$bloque=$v[1];
$idgrado=$v[2];
$sec=$v[3];


echo '<table id="cuadro" class="table table-bordered table-striped table-hover" border="0"  cellspacing="0" cellpadding="0" width="100%" >
  <thead>

<tr>
<th>Clave</th>
<th >Nombre</th>
<th >Total</th>';
$sql="SELECT * FROM `modelocuadro` WHERE idcole='$idcole' AND asesor='1' ORDER BY orden ASC";
$query=mysqli_query($conexion,$sql);
if (!$query) {
  errorsql($conexion);
}
while ($a=mysqli_fetch_array($query)) {
  $nombre=$a['nombre'];
  $idmodelo=$a['idmodelo'];
  $sqlna="SELECT * FROM `nombreactividades` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' AND idbloque='$bloque' AND idactividad='$idmodelo' LIMIT 1";
  $queryna=mysqli_query($conexion,$sqlna);
  if ($queryna->num_rows>0) {
    while ($c=mysqli_fetch_array($queryna)) {
      $nombre=$c['nombre'];
    }
  }
  $renombrar=$a['renombrar'];
  $asesor=$a['asesor'];
  if ( $asesor==1) {
    if ($renombrar==1) {
      echo '<th class="vtext" ><a href="javascript:void(0)" class="actividad" data-toggle="modal" data-target="#con-close-modal" id="'.$idmodelo.'"><p class="rotatetext">'.$nombre.'</p></a></th>';
    }else {
      echo '<th class="vtext" ><p class="rotatetext">'.$nombre.'</p></th>';
    }

    //echo '<a href="javascript:void(0)"></a>';
  }else {
    echo '<th class="vtext"  ><p class="rotatetext">'.$nombre.'</p></th>';
  }
}
echo '</tr>
</thead>
<tbody>';
$sql="SELECT clave, idalumno, activo, CONCAT (apellidos,', ', nombres) as nombre FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' ORDER BY clave ASC";
include('../../conexion/conexion.php');
$datos=array();
$resultado = mysqli_query($conexion,$sql);
if ($resultado) {
  while( $data = mysqli_fetch_array($resultado)){
    echo "<tr>";
    $clave=$data['clave'];
    $idalumno=$data['idalumno'];
    $activo=$data['activo'];
    if ($activo=="Retirado") {
      $activo='<span class="badge badge-danger">'.$activo.'</span>';
    }
    if ($activo=="Suspendido") {
      $activo='<span class="badge badge-danger">'.$activo.'</span>';
    }
    if ($activo=="Activo") {
      $activo='';
    }
    $nombre=$data['nombre'].$activo;
    $row="";
    $total=0;
    echo "<td>$clave</td>";
    echo "<td nowrap>$nombre</td>";
    $sqlactividades="SELECT * FROM `modelocuadro` WHERE idcole='$idcole' AND asesor='1' ORDER BY orden ASC";
    $queryactividades=mysqli_query($conexion,$sqlactividades);
    while ($act=mysqli_fetch_array($queryactividades)) {
      $idactividad=$act['idmodelo'];
      $asesor=0;
      $asesor=$act['asesor'];
      if ($asesor==1) {
        $sqlnotas="SELECT idnota, asignado, obtenido FROM `notasasesores` WHERE idalumno='$idalumno' AND idbloque='$bloque' AND idmodelo='$idactividad' LIMIT 1";
        $conect=mysqli_query($conexion,$sqlnotas);
        if ($conect) {
          $filas=$conect->num_rows;
          if ($filas==0) {
            $sqlinsert="INSERT INTO `notasasesores`(`idnota`, `idcole`, `idgrado`, `idbloque`, `idmodelo`, `idalumno`, `asignado`, `obtenido`) VALUES ('','$idcole','$idgrado','$bloque','$idactividad','$idalumno','0','0')";
            $r=mysqli_query($conexion,$sqlinsert);
            if ($r) {
              $conect=mysqli_query($conexion,$sqlnotas);
            }else {
              exit(errorsql($conexion));
            }
          }
          while ($a=mysqli_fetch_array($conect)) {
            $row.= '<td>
                '.inputdatajsoncuadro(cero($a['obtenido']),$idactividad,$a['idnota']).'
              </td>';
              $total+=$a['obtenido'];
          }
        }else {
          echo errorsql($conexion);
        }
      }else {
        $sqlnotas="SELECT idnota, asignado, obtenido FROM `notasasesores` WHERE idalumno='$idalumno' /*AND idmateria='$idmateria'*/ AND idbloque='$bloque' AND idmodelo='$idactividad' LIMIT 1";
        $conect=mysqli_query($conexion,$sqlnotas);
        if ($conect) {
          $filas=$conect->num_rows;
          if ($filas==0) {
            $sqlinsert="INSERT INTO `notasasesores`(`idnota`, `idcole`, `idgrado`, `idbloque`, `idmodelo`, `idalumno`, `asignado`, `obtenido`) VALUES ('','$idcole','$idgrado','$bloque','$idactividad','$idalumno','0','0')";
            $r=mysqli_query($conexion,$sqlinsert);
            if ($r) {
              $conect=mysqli_query($conexion,$sqlnotas);
            }else {
              exit(errorsql($conexion));
            }
          }
          while ($a=mysqli_fetch_array($conect)) {
              $row.= '<td>
                  '.inputdatajsoncuadrodisabled(cero($a['obtenido']),$idactividad,$a['idnota']).'
                </td>';
              $total+=$a['obtenido'];
          }
        }else {
          echo errorsql($conexion);
        }
      }

    }
    echo "<td><b style='font-size: 13px' id='total'>$total</b></td>$row";
  }
}else {
  echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
}
echo '</tbody>
</table>';
 ?>
