<?php
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
function uploadphotoprofile($photo, $usuario){
  $date=getdate();
  $fecha="$date[mday]-$date[month]-$date[year]-$date[hours]-$date[minutes]-$date[seconds]";
  $uploadedfileload="true";
  $uploadedfile_size=$_FILES[$photo]['size'];
  ////echo $_FILES[$photo];
  $msg="";

  if ($_FILES[$photo]['size']>8388608){

    $msg='tamano';
    $uploadedfileload="false";}
    if (!($_FILES[$photo]['type'] =="image/jpeg" OR $_FILES[$photo]['type'] =="image/gif" OR $_FILES[$photo]['type'] =="image/bmp")){
      $msg='tipo';
      ////echo $_FILES[$photo]['type'];
      $uploadedfileload="false";}
      //$file_name=$_FILES[$photo]['name'];
      $file_name=$_FILES[$photo]['name'];
      $ext=$_FILES[$photo]['type'];
      $extension="";
      if ($ext=="image/jpeg") {
        $extension=".jpg";
      }
      if ($ext=="image/gif") {
        $extension=".gif";
      }
      if ($ext=="image/bmp") {
        $extension=".bmp";
      }
      $fotonueva="$usuario$fecha$extension";
      $add="../../assets/images/tempo/$fotonueva";
      //echo "aqui";
      if($uploadedfileload=="true"){

        if(move_uploaded_file ($_FILES[$photo]['tmp_name'], $add)){
          $origen=$add;
          //$origen="img/imagen.jpg";
          $destino="../../assets/images/users/$fotonueva";
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
          if (isset($fotoperfil)) {
            unlink("$fotoperfil");
          }
          unlink("$add");


          return $fotonueva;
          //header("location:../set/?fp=exito");
        }else{
          //echo "false";
          //header("location:../set/?fp=err");
          //header("location:edit.php?fotoperfil=error");
        }
      }else{
        ////echo "$msg";
        header("location:../set/?fp=$msg");
        //header("location:edit.php?fotoperfil=$msg");
      }
    }
    ////echo "error";


  ?>
