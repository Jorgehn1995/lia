<?php
require '../lib/sesion.php';
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
require '../../assets/datetime.php';

function change($idpersonal,$idnota,$notanueva){
  /**
  * @var $idpersonal    es el id del profesor que hizo el cambio
  * @var $notaanterior  es la nota que tenia antes del cambio
  * @var $msg           es el mensaje que se mostara al profesor **
  * @var $notanueva     es la nueva nota que se agregará
  * @var $modelo        es el id del modelo en que se agrego la nota
  * @var $idnota        es el id de la nota que se modifico
  * @var $idalumno      es el id del alumno al que se le aplico un cambio
  * @var $idmateria     es el id de la materia del alumno
  * @var $bloque        es en el bloque en el que se aplicó
  * @var $datetime      es el momento en que se realizo el cambio
  */
  global $conexion,$datetime;
  $sql="SELECT * FROM `notasasesores` WHERE idnota='$idnota' LIMIT 1";
  $query=mysqli_query($conexion,$sql);
  if ($query->num_rows==0) {
    return false;
  }else {
    while ($a=mysqli_fetch_array($query)) {
      //$idmateria=$a['idmateria'];
      $bloque=$a['idbloque'];
      $modelo=$a['idmodelo'];
      $notaanterior=$a['obtenido'];
      $idalumno=$a['idalumno'];
    }
    $msg=1;
    if ($notaanterior==0) {
      $msg=1;
    }else {
      if ($notanueva>$notaanterior) {
        $msg=2;
      }else {
        if ($notanueva==0) {
          $msg=0;
        }else {
          $msg=3;
        }
      }
    }
    $sql2="INSERT INTO `cambiosasesores`( `idpersonal`, `notaanterior`, `msg`, `notanueva`, `idnota`, `idalumno`, `bloque`, `idmodelo`, `hora`) VALUES ('$idpersonal','$notaanterior','$msg','$notanueva','$idnota','$idalumno','$bloque','$modelo','$datetime')";
    $query2=mysqli_query($conexion,$sql2);
  }
}


$idcuadro=dx("idnota");
//$campo=dx("campo");
//exit("$idcuadro");
$punteo=d("punteo");
change($idusuario,$idcuadro,$punteo);
$sql="UPDATE `notasasesores` SET obtenido='$punteo' WHERE idnota='$idcuadro'";
$con=mysqli_query($conexion,$sql);
if ($con) {
  echo "Exito";
}else {
  errorsql($conexion);
}
require '../../conexion/cerrar_conexion.php';
 ?>
