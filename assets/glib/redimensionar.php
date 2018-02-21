<?php
//--------------AQUI SE EMPIEZA A REDUCIR LA FOTO-----------------------------------------
$origen=$add;
//$origen="img/imagen.jpg";
$destino="img/$fotonueva";
$destino_temporal=tempnam("tmp/","tmp");


$file = $origen;  // Dirección de la imagen

$imagen = getimagesize($file);    //Sacamos la información
//$ancho = $imagen[0]*0.20;              //Ancho
//$alto = $imagen[1]*0.20;
$ancho=300;
$alto=300;
if ($ancho<300) {
  $ancho=300;
  $alto=300;
}
if ($alto<300) {
  $ancho=300;
  $alto=300;
}
redimensionar_jpeg($origen, $destino_temporal, $ancho, $alto, 100);

// guardamos la imagen
$fp=fopen($destino,"w");
fputs($fp,fread(fopen($destino_temporal,"r"),filesize($destino_temporal)));
fclose($fp);

// mostramos la imagen
function redimensionar_jpeg($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad)
{
  // crear una imagen desde el original
  $img = ImageCreateFromJPEG($img_original);
  // crear una imagen nueva
  $thumb = imagecreatetruecolor($img_nueva_anchura,$img_nueva_altura);
  // redimensiona la imagen original copiandola en la imagen
  ImageCopyResized($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img));
  // guardar la nueva imagen redimensionada donde indicia $img_nueva
  ImageJPEG($thumb,$img_nueva,$img_nueva_calidad);
  ImageDestroy($img);
}
unlink("$fotoperfil");
include("../../conexion/conexion.php");
$consulta="UPDATE `colegio` SET `logo`='$destino'  WHERE idcole= $idcole";
$resultado = mysqli_query($conexion,$consulta);
include("../../conexion/cerrar_conexion.php");
//--------------AQUI SE TERMINA DE REDUCIR LA FOTO-----------------------------------------
?>
