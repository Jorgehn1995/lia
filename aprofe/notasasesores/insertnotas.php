<?php
require '../lib/sesion.php';
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
$idcuadro=dx("idnota");
//$campo=dx("campo");
//exit("$idcuadro");
$punteo=d("punteo");
$sql="UPDATE `notasasesores` SET obtenido='$punteo' WHERE idnota='$idcuadro'";
$con=mysqli_query($conexion,$sql);
if ($con) {
  echo "Exito";
}else {
  errorsql($conexion);
}
require '../../conexion/cerrar_conexion.php';
 ?>
