<?php
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
require '../../assets/crypt.php';
require '../../assets/glib/uploader.php';
$idcole=dx("idcole");
$usuario=dx("user");
$pass=dx("password");
$pass=encriptar($pass);
$nombre=dx("nombre");
$abr=dx("abr");
$dir=dx("dir");
$tel=dx("tel");
$lema=d("lema");
$email=dx("email");;
$primaria=chk("primaria");
$basico=chk("basico");
$diversificado=chk("diversificado","n");
//$logotipo=dx("logotipo");
if (isset($_FILES['logotipo'])) {
  $logotipo=uploadphotoprofile("logotipo",$usuario);
}else {
  $logotipo="";
}
$terminos=dx("terminos");
$logo="";

  $sql="UPDATE `colegio` SET `nombre`='$nombre',`abr`='$abr',`token`='',`lema`='$lema',`direccion`='$dir',`telefono`='$tel',`email`='$email',`activo`='SI',`logo`='$logotipo',`pf`='1',`primaria`='$primaria',`basico`='$basico',`diversificado`='$diversificado' WHERE `colegio`.`idcole`='$idcole'";
  $up=mysqli_query($conexion,$sql);
  $sql="UPDATE `usuarios` SET `activo`='1',`usuario`='$usuario',`pass`='$pass' WHERE `idcole`='$idcole' AND `modulo`='D'";
  $up=mysqli_query($conexion,$sql);

include '../../conexion/cerrar_conexion.php';
 ?>
