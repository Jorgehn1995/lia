<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/datetime.php';
// En versiones de PHP anteriores a la 4.1.0, debería utilizarse $HTTP_POST_FILES en lugar
// de $_FILES.
$dir_subida = 'archivos/';
$uniqid=uniqid();
$extension = end(explode(".", $_FILES['uploadfile']['name']));


$nombresubido=basename($_FILES['uploadfile']['name']);
$tamanio=basename($_FILES['uploadfile']['size']);
$nombresistema=$uniqid.".".$extension;
$raiz=$_POST['raiz'];
$fecha=$datetime;


//$fichero_subido = $dir_subida . basename($_FILES['uploadfile']['name']);
$fichero_subido = $dir_subida . $nombresistema;


if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $fichero_subido)) {
  $tipoarchivo="14";
  $sqltipo="SELECT * FROM `tipoarchivo` WHERE extension='.$extension' LIMIT 1";
  $querytipo=mysqli_query($conexion,$sqltipo);
  if ($querytipo->num_rows==0) {
    $sqltipo="SELECT * FROM `tipoarchivo` WHERE extension='unknown' LIMIT 1";
    $querytipo=mysqli_query($conexion,$sqltipo);
  }
  while ($a=mysqli_fetch_array($querytipo)) {
    $idtipoarchivo=$a['idtipoarchivo'];
  }
  $sqlup="INSERT INTO `nube`(`idcole`, `idpersonal`, `raiz`, `nombre`, `direccion`, `tipo`, `peso`, `creacion`) VALUES ('$idcole','$idusuario','$raiz','$nombresubido','$nombresistema','$idtipoarchivo','$tamanio','$datetime')";
  $queryup=mysqli_query($conexion,$sqlup);
  if ($queryup) {
    echo "El archivo ".$nombresubido." se ha subido con exito a tu nube";
  }else {
    errorsql($conexion);
  }

} else {
    echo "¡Posible ataque de subida de ficheros!\n";
}

//echo 'Más información de depuración:';
//print_r($_FILES);

?>
