<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';


$val=d("id");
//$val="1-1-1-A";
if ($val==0 || $val=="") {
  exit('<div class="">
    <div class="text-center">
      <br>
      <img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
      <h3 class="text-muted">Error!</h3>
      <div id="icon">
        <h5 class="text-muted">Se produjo un error al cargar el cuadro <br> Error No: 0x0000001 </h5>
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
        <h5 class="text-muted">Se produjo un error al cargar el cuadro <br> Error No: 0x0000001 </h5>
      </div>
    </div>
  </div>');
}
$v=explode("-",$val);
if (!array_key_exists(0,$v) || !array_key_exists(1,$v) || !array_key_exists(2,$v) || !array_key_exists(3,$v)) {
  exit('<div class="">
    <div class="text-center">
      <br>
      <img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
      <h3 class="text-muted">Error</h3>
      <div id="icon">
        <h5 class="text-muted">Parece que ha habido un error al cargar el cuadro<br>Codigo de error: 0x0003 tablacuadro.php</h5><br>
      </div>
      <div class="form-group">
        <button type="button" class="btn btn-outline-success btn-change" name="button">Selecionar Cuadro</button>
      </div>
    </div>
  </div>');
}
$idmateria=$v[0];
$bloque=$v[1];
$idgrado=$v[2];
$sec=$v[3];

if ($bloque>$bloqueencurso) {
  exit('<div class="">
    <div class="text-center">
      <br>
      <img src="../../assets/images/nodatafound.png" width="80" height="auto" alt=""><br>
      <h3 class="text-muted">Bloque No Habilitado</h3>
      <div id="icon">
        <h5 class="text-muted">El bloque '.$bloque.' aún no ha sido habilitado para ingreso de calificaciones<br>Por favor selecione otro bloque</h5><br>
      </div>
      <div class="form-group">
        <button type="button" class="btn btn-outline-success btn-change" name="button">Selecionar Cuadro</button>
      </div>
    </div>
  </div>');
}
$ssqqll="SELECT * FROM `materias` INNER JOIN `grados` ON materias.idgrado=grados.idgrado INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria WHERE materias.idcole='$idcole' AND materias.idgrado='$idgrado' AND materias.seccion='$sec' AND materias.idnombremateria='$idmateria' AND materias.idprofesor='$idusuario' LIMIT 1";
$qquery=mysqli_query($conexion,$ssqqll);
if ($qquery->num_rows==0) {
  exit('<div class="">
    <div class="text-center">
      <br>
      <img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
      <h3 class="text-muted">Accesso No Autorizado</h3>
      <div id="icon">
        <h5 class="text-muted">No tienes acceso a este cuadro de  calificaciones <br> selecciona otro cuadro</h5>
      </div>
      <div class="form-group">
        <button type="button" class="btn btn-outline-success btn-change" name="button">Selecionar Cuadro</button>
      </div>
    </div>
  </div>');
}else {
  while ($e=mysqli_fetch_array($qquery)) {
    $nclase=$e['nombreficha'];
    $ngrado=$e['boton'];
    if ($nclase=="") {
      $nclase=$e['nombre'];
    }
    echo '<div class="row">
      <div class="col-md-6">
        <p class="text-mutex">'.$ngrado." ".$sec.' > '.$nclase.' </p>
        <!--<button type="button" class="btn btn-danger  waves-effect waves-light" > Ver PDF </button>-->
      </div>
      <div class="col-md-6 pull-right">
      <div class=" pull-right">
        <button type="button" class="btn btn-outline-secondary btn-printer waves-effect waves-light" ><i class=" ti-printer "></i> Imprimir PDF </button>
      </div></div>
    </div><br>';
  }
}

echo '<div class="row">
  <div class="col-md-12"><table id="cuadro" class="table table-bordered table-striped table-hover" border="0"  cellspacing="0" cellpadding="0" width="100%" >
  <thead>
    <tr>';
echo '<th  colspan="3">Datos</th>';
$sql="SELECT * FROM `mccategorias` WHERE idcole='$idcole'";
$query=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($query)) {
  $idcate="";
  $colspan=0;
  $idcate=$a['idmccategorias'];
  $nombrecategoria=$a['nombre'];
  $sql2="SELECT * FROM `modelocuadro` WHERE idmccategorias='$idcate'";
  $query2=mysqli_query($conexion,$sql2);
  $colspan=$query2->num_rows;
  echo '<th  colspan="'.$colspan.'">'.$nombrecategoria.'</th>';
}
echo '</tr>
<tr>
<th>Clave</th>
<th >Nombre</th>
<th >Total</th>';
$sql="SELECT * FROM `modelocuadro` WHERE idcole='$idcole' ORDER BY orden ASC";
$query=mysqli_query($conexion,$sql);
if (!$query) {
  errorsql($conexion);
}
while ($a=mysqli_fetch_array($query)) {
  $nombre=$a['nombre'];
  $idmodelo=$a['idmodelo'];
  $asesor=$a['asesor'];
  if ($asesor==0) {
    $sqlna="SELECT * FROM `nombreactividades` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' AND idbloque='$bloque' AND idactividad='$idmodelo' AND idmateria='$idmateria' LIMIT 1";
    $queryna=mysqli_query($conexion,$sqlna);
    if ($queryna->num_rows>0) {
      while ($c=mysqli_fetch_array($queryna)) {
        $nombre=$c['nombre'];
      }
    }
  }else {
    $sqlna="SELECT * FROM `nombreactividades` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' AND idbloque='$bloque' AND idactividad='$idmodelo' LIMIT 1";
    $queryna=mysqli_query($conexion,$sqlna);
    if ($queryna->num_rows>0) {
      while ($c=mysqli_fetch_array($queryna)) {
        $nombre=$c['nombre'];
      }
    }
  }

  $renombrar=$a['renombrar'];
  if ($renombrar==1 AND $asesor==0) {
    echo '<th class="vtext" ><a href="javascript:void(0)" class="actividad" data-toggle="modal" data-target="#con-close-modal" id="'.$idmodelo.'"><p class="rotatetext">'.$nombre.'</p></a></th>';
    //echo '<a href="javascript:void(0)"></a>';
  }else {
    echo '<th class="vtext"  ><p class="rotatetext">'.$nombre.'</p></th>';
  }
}
echo '</tr>
</thead>
<tbody>';
$sql="SELECT clave, idalumno, CONCAT (apellidos,', ', nombres) as nombre FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' ORDER BY clave ASC";
include('../../conexion/conexion.php');
$datos=array();
$resultado = mysqli_query($conexion,$sql);
if ($resultado) {
  while( $data = mysqli_fetch_array($resultado)){
    echo "<tr>";
    $clave=$data['clave'];
    $idalumno=$data['idalumno'];
    $nombre=$data['nombre'];
    $row="";
    $total=0;
    echo "<td>$clave</td>";
    echo "<td nowrap>$nombre</td>";
    $sqlactividades="SELECT * FROM `modelocuadro` WHERE idcole='$idcole' ORDER BY orden ASC";
    $queryactividades=mysqli_query($conexion,$sqlactividades);
    while ($act=mysqli_fetch_array($queryactividades)) {
      $idactividad=$act['idmodelo'];
      $asesor=0;
      $asesor=$act['asesor'];
      if ($asesor==0) {
        $sqlnotas="SELECT idnota, asignado, obtenido FROM `notas` WHERE idalumno='$idalumno' AND idmateria='$idmateria' AND idbloque='$bloque' AND idmodelo='$idactividad' LIMIT 1";
        $conect=mysqli_query($conexion,$sqlnotas);
        if ($conect) {
          $filas=$conect->num_rows;
          if ($filas==0) {
            $sqlinsert="INSERT INTO `notas`(`idnota`, `idcole`, `idgrado`, `idmateria`, `idbloque`, `idmodelo`, `idalumno`, `asignado`, `obtenido`) VALUES ('','$idcole','$idgrado','$idmateria','$bloque','$idactividad','$idalumno','0','0')";
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
</table></div>
</div>';
 ?>
