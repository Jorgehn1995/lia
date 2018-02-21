<?php
function dias_mes($mes, $anio)
{
  //Si la extensión que mencioné está instalada, usamos esa.
  if( is_callable("cal_days_in_month"))
  {
    $datos =  cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
    //$valores = "El mes ".$mes_letra." del ".$anio." tiene ".$datos." dias.";
    $valores = $datos;
    return $valores;
  }
  else
  {
    //Lo hacemos a mi manera.
    return date("d",mktime(0,0,0,$mes+1,0,$anio));
  }
}
function recorrer($mes){
  $dias= dias_mes($mes, date("Y"));
  $dia=array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo");
  for ($i=1; $i <=$dias ; $i++) {
    $date=date("Y")."-$mes-$i";
    $totaldate=date("N",strtotime($date));
    if ($totaldate==6 OR $totaldate==7) {
    }else {
      echo $i." ".$dia[$totaldate-1]."<br>";
    }
  }
}
echo recorrer(2);
//Esto ya pintara los dias del mes de Marzo de 2011
//echo dias_mes(3,2011);
?>
