<?php
include "assets/datetime.php";
function ago($time)
{
  $periodos = array("segundo", "minuto", "hora", "día", "semana", "mes", "año", "década");
  $duraciones = array("60","60","24","7","4.35","12","10");
  $now = time();
  $diferencia = $now - $time;
  for($j = 0; $diferencia >= $duraciones[$j] && $j < count($duraciones)-1; $j++) {
    $diferencia /= $duraciones[$j];
  }
  $diferencia = round($diferencia);
  if($diferencia != 1) {
    if($j != 5){
      $periodos[$j].= "s";
    }else{
      $periodos[$j].= "es";
    }
  }
  return "hace $diferencia ".utf8_encode($periodos[$j]);
  //echo ago(strtotime("2017-12-25"));
}


//echo $datetime."<br>----------------<br>";
//echo ago($datetime);

$d = new DateTime(date("Y-m-d h:i:s"), new DateTimeZone("America/Guatemala"));

var_dump($d->getTimestamp()); // 1457690400
echo utf8_decode(ago($d->getTimestamp()));
echo "<br>Fecha: ".$d->format("Y-m-d");
echo "<br>Hora: ".$d->format("h:i:s a");


 ?>
