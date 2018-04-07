<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
$idgrado="1";
$seccion="A";
$idbloque="1";
$idgrado=dx("idgrado");
$seccion=dx("sec");
$idbloque=$bloqueencurso;


echo '<table style="word-wrap: break-word" border="1" class="table table-bordered table-hover">
<thead>
<tr>
<td>Clave</td>
<td>Nombre</td>';
$sql = "SELECT * FROM `materias` INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria WHERE materias.idcole='$idcole' AND idgrado='$idgrado' AND seccion='$seccion' ORDER BY num ASC";
$query = mysqli_query($conexion,$sql);
if(!$query){
  errorsql($conexion);
}else{
  while( $a = mysqli_fetch_array($query)){
    $rr=substr ( $a['corto'], 0, 5 ) ;
    echo '<td>'.$rr.'</td>';
  }
}
echo '<td>Ficha</td>';
echo '</tr>
</thead>
<tbody>
';
$sql="SELECT * FROM `alumnos` WHERE idgrado='$idgrado' AND seccion='$seccion' ORDER BY clave";
$query=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($query)) {
  $idalumno=$a['idalumno'];
  echo '<tr><td>'.$a['clave'].'</td><td>'.$a['apellidos'].", ".$a['nombres'].'</td>';
  $sql2 = "SELECT * FROM `materias` INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria WHERE materias.idcole='$idcole' AND idgrado='$idgrado' AND seccion='$seccion' ORDER BY num ASC";
  $query2 = mysqli_query($conexion,$sql2);
  if(!$query2){
    errorsql($conexion);
  }else{
    while( $b = mysqli_fetch_array($query2)){
      $idmateria=$b['idnombremateria'];
      $sql4="SELECT *,SUM(obtenido) as tt FROM `notasasesores` WHERE idalumno='$idalumno' AND idbloque='$idbloque' GROUP BY idbloque LIMIT 1";
      $query4=mysqli_query($conexion,$sql4);
      if ($query4->num_rows==0) {
        $asesor=0;
      }
      while ($c=mysqli_fetch_array($query4)) {
        $asesor=$c['tt'];
      }
      $sql3="SELECT *,SUM(obtenido) as tt FROM `notas` WHERE idmateria='$idmateria' AND  idalumno='$idalumno' AND idbloque='$idbloque' GROUP BY idmateria LIMIT 1";
      $query3=mysqli_query($conexion,$sql3);
      if ($query3->num_rows==0) {
        $tt=$asesor;
        echo '<td>'.$tt.'</td>';
      }
      while ($c=mysqli_fetch_array($query3)) {
        if ($c['tt']==0 || $c['tt']=="") {
          $tt=0;
        }else {
          $tt=$asesor+$c['tt'];
        }
        if ($tt>100) {
          $tt=100;
        }
        if ($tt<60) {
          if ($c['tt']==0) {
            $rt="";
          }else {
            $rt='<span class="badge badge-danger">'.$tt.'</span>';
          }
        }else {
          $rt=$tt;
        }
        echo '<td>'.$rt.'</td>';
      }
    }
    echo '<td><button type="button" class="btn btn-sm btn-success btn-ficha" name="button"><i class=" ti-notepad "></i></button></td>';
  }
  echo '</tr>';
}


echo '
</tbody>
</table>';
?>
