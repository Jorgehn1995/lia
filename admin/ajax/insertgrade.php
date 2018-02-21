<?php

require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
$peticion=dx("peticion");
$id=d("id");
$ciclo=dx("ciclo");
$grado=dx("grado");
$esp=dx("esp");
$espn=dx("espn");
$cc=dx("cc");
$sec1=d("sec1");
$sec2=d("sec2");
$sec3=d("sec3");
$sec4=d("sec4");
$sec5=d("sec5");
$cc=dx("cc");
if ($ciclo=="Primaria" || $ciclo=="Básico") {
  $n=$ciclo;
  $boton=$grado." ".$n;
}else {
  $n=$ciclo;
  $ciclo="Diversificado";
  $boton=$grado." ".$n." ".$espn;
}

$idcole=dx("idcole");
if ($espn=="") {
  $espn=$boton;
}
//exit("$id");
if ($peticion=="insert") {
  $sql="INSERT INTO `grados`(`idgrado`, `idcole`, `ciclo`, `grado`, `tipo`, `nombre`, `corto`, `boton`, `sec1`, `sec2`, `sec3`, `sec4`, `sec5`, `activo`, `clases`)VALUES ('0','$idcole','$ciclo','$grado','$n','$esp','$espn','$boton','$sec1','$sec2','$sec3','$sec4','$sec5','Activo','$cc')";
  $query=mysqli_query($conexion,$sql);
  if ($query) {
    echo "Exito";
  }else {
    echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
  }
}else {
  $sql="UPDATE `grados` SET `ciclo`='$ciclo',`grado`='$grado',`tipo`='$n',`nombre`='$esp',`corto`='$espn',`boton`='$boton',
  `sec1`='$sec1',`sec2`='$sec2',`sec3`='$sec3',`sec4`='$sec4',`sec5`='$sec5',`activo`='Activo',`clases`='$cc' WHERE idgrado='$id'";
  $query=mysqli_query($conexion,$sql);
  if ($query) {
    echo "Actualizado";
  }else {
    echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
  }
}
require '../../conexion/cerrar_conexion.php';
?>
