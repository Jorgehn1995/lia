<?php
setlocale(LC_ALL, 'es_GT');
date_default_timezone_set("America/Guatemala");
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$time=getdate();
$horas=$time['hours'];
$minutos=$time['minutes'];
if ($horas<10) {
  $horas="0".$horas;
}
if ($minutos<10) {
  $minutos="0".$minutos;
}
$segundos=$time['seconds'];
if ($segundos<10) {
  $segundos="0".$segundos;
}
$datetime=date('Y-m-d H:i:s');
$hora="$horas:$minutos:$segundos";
// echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
$dias= date('d');
$meses= date('m');
$año= date('y');
$fecha = "$dias/$meses/$año";
$fechasql="$año-$meses-$dias";
//echo "$fecha / $hora";
?>
