<?php
require('../../assets/fpdf/fpdf.php');
include '../../assets/datetime.php';
require '../../assets/glib/isset.php';
require '../lib/sesion.php';
require '../../conexion/conexion.php';
setlocale(LC_ALL, 'es_GT');
date_default_timezone_set("America/Guatemala");
//$mes=date("m");
/* Inicio del las variables centrales*/
//echo $idgrado." ".$seccion ."<br>";

$m=d("m");
$mes=$m;
//$pagesize="h";
$pagesize=d("size");
if ($pagesize=="") {
	$pagesize="v";
}
if ($pagesize=="v") {
	$modo="P";
	$rest=160;
	$alto=6;
	$anchonombre=60;
}else {
	$modo="L";
	$rest=280;
	$alto=5;
	$anchonombre=80;
}
$fecha=d("f");	//fecha de la consulta
if ($fecha=="" || $fecha=="undefined") {
	$fecha=date("d/m/Y");
}


$tipodatos="Alumnos";
$resumen="Reporte Cantidad Alumnos";
$nuser="INEBCO";
$mesarray=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre");
$uniqid=uniqid();
$table=1;
$f = date_format(date_create_from_format('d/m/Y',$fecha),'Y-m-d');
function dias_mes($mes, $anio){
  //Si la extensión que mencioné está instalada, usamos esa.
  if( is_callable("cal_days_in_month")){
    $datos =  cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
    //$valores = "El mes ".$mes_letra." del ".$anio." tiene ".$datos." dias.";
    $valores = $datos;
    return $valores;
  }else{
    //Lo hacemos a mi manera.
    return date("d",mktime(0,0,0,$mes,0,$anio));
  }
}
class PDF extends FPDF{
	function Header(){
		global $uniqid, $table, $mes, $nombregrado, $seccion,$logobn,$abrcole,$rest;
		$this->SetTextColor(0,0,0);
		$this->Image($logobn,15,15,9,10,'JPG');
		$this->SetFont("Helvetica","",14);
		$this->Cell(10,8,"",0,0,'R');
		$this->Cell(20,8,utf8_decode($abrcole),0,0,'L');
		$this->SetFont("Helvetica","B",8);
		$this->Cell(40,4,'Mes de Asistencia: ',0,0,'R');
		$this->Cell(30,4,'Grado:',0,0,'R');
		$this->Cell(55,4,utf8_decode('Sección:'),0,0,'R');
		$this->Cell(20,4,'Pag # ',0,0,'R');
		$this->Ln(4);
		$mesarray=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre");
		$this->Cell(60,8,"",0,0,'R');
		$this->Cell(30,4,$mesarray[$mes-1],0,0,'L');
		$this->Cell(55,4,utf8_decode($nombregrado),0,0,'L');
		$this->Cell(20,4,"$seccion",0,0,'L');
		$this->Cell(10,4,$this->PageNo().'/{nb}',0,0,'L');
		$this->Ln(1);
		$this->SetDrawColor(0,0,0);
		$this->Cell(180,5,"","B",0,'L');
		$this->Ln(10);

	}
	function recorrer(){
		$this->SetDrawColor(0,0,0);
		$this->SetFont("times","",5);
		global $mes,$alto,$rest;
		$dias= dias_mes($mes, date("Y"));
		$ancho=$rest/$dias;
	  $dia=array("Lun","Mar","Mie","Jue","Vie","Sab","Dom");
	  for ($i=1; $i <=$dias ; $i++) {
	    $date=date("Y")."-$mes-$i";
	    $totaldate=date("N",strtotime($date));
			$this->SetFont("Helvetica","B",6);
	    if ($totaldate==6 OR $totaldate==7) {
	    }else {
	      //echo $i." ".$dia[$totaldate-1]."<br>";

				$this->Cell($ancho,5,$dia[$totaldate-1],1,0,'C');
	    }
	  }
	}
	function cuadro(){
		global $mes,$alto,$rest;
		$this->SetDrawColor(0,0,0);
	  $dias= dias_mes($mes, date("Y"));
		$ancho=$rest/$dias;
	  $dia=array("Lun","Mar","Mie","Jue","Vie","Sab","Dom");
	  for ($i=1; $i <=$dias ; $i++) {
	    $date=date("Y")."-$mes-$i";
	    $totaldate=date("N",strtotime($date));
			$this->SetFont("Helvetica","B",6);
	    if ($totaldate==6 OR $totaldate==7) {
	    }else {
	      //echo $i." ".$dia[$totaldate-1]."<br>";

				$this->Cell($ancho,$alto,"",1,0,'C');
	    }
	  }
	}
	function diasmes(){
		global $mes,$alto,$rest;
	  $dias= dias_mes($mes, date("Y"));
		$ancho=$rest/$dias;
	  $dia=array("Lun","Mar","Mie","Jue","Vie","Sab","Dom");
	  for ($i=1; $i <=$dias ; $i++) {
	    $date=date("Y")."-$mes-$i";
	    $totaldate=date("N",strtotime($date));
			$this->SetFont("Helvetica","B",6);
	    if ($totaldate==6 OR $totaldate==7) {
	    }else {
	      //echo $i." ".$dia[$totaldate-1]."<br>";

				$this->Cell($ancho,5,$i,1,0,'C');
	    }
	  }
	}
	function SecondHeader(){
		global $tipodatos, $resumen, $nuser;
		//SEGUNDA LINEA DE ENCABEZADO
		$this->SetFont("Helvetica","B",10);
		$this->Cell(100,6,utf8_decode('INEBCO'),0,0,'');
		$this->Cell(15,7,'',0);
		$this->SetFont("Helvetica","B",8);
		$this->Cell(33,7,'Tipo de Datos: ',0,0,'');
		$this->SetFont("Helvetica","",8);
		$this->Cell(42,7,$tipodatos,0,0,'R');
		$this->SetFont("Helvetica","",8);
		$this->Ln(6);
		$this->Cell(100,4,utf8_decode('Instituto de Educación Básica Por Cooperativa'),0,0,'');
		$this->Cell(15,7,'',0);
		$this->SetFont("Helvetica","B",8);
		$this->Cell(33,7,'Resumen de Datos: ',0,0,'');
		$this->SetFont("Helvetica","",8);
		$this->Cell(42,7,$resumen,0,0,'R');
		$this->SetFont("Helvetica","",8);
		$this->Ln(4);
		$this->Cell(100,4,utf8_decode("").dmylargo(date("d/m/Y")),0,0,'');
		$this->Cell(15,7,'',0);
		$this->SetFont("Helvetica","B",8);
		$this->Cell(33,12,'Usuario de LIA: ',0,0,'');
		$this->SetFont("Helvetica","",8);
		$this->Cell(42,12,$nuser,0,0,'R');
		$this->SetFont("Helvetica","",8);
		$this->Ln(4);
		$this->Cell(100,4,utf8_decode('San Luis Jilotepeque, Jalapa. Guatemala.'),0,0,'');
		$this->Ln(10);
		$this->SetFont("Helvetica","B",8);
	}
	function Footer(){
		$this->SetY(-15);
		$this->SetFont("Helvetica","",7);
		$this->SetTextColor(130,130,130);
		$this->Cell(190,4,utf8_decode("LIA - System of Learning, Investigation and Advanced School Management - JH Developer"." - ".date("h:s a")),0,0,'C');
	}
}
$pdf= new PDF($modo,'mm',array(216,330));
$pdf->SetMargins(15, 15 , 15);
$pdf->AliasNbPages();


$sql2="SELECT * FROM `grados` WHERE idcole='$idcole'";
$query2=mysqli_query($conexion,$sql2);
while ($a=mysqli_fetch_array($query2)) {
	$nombregrado=$a['boton'];
	$idgrado=$a['idgrado'];
	for ($u=1; $u <=5 ; $u++) {
    $idg=$a["idcole"];
    $n="sec".$u;
		if ($a[$n]!=""){
			$seccion=$a[$n];
			$pdf->AddPage();
			$pdf->SetDrawColor(0,0,0);
			$pdf->Cell(190,10,utf8_decode($nombregrado)." ".$seccion,"L",0,'L');
			$pdf->Ln(5);
			$pdf->SetTextColor(70,70,70);
			$pdf->AddFont('Script','','ITCEDSCR.php');
			$pdf->AddFont('Century','','Century.php');
			$pdf->SetFont("Helvetica","B",14);
			$pdf->Ln(10);
			$pdf->SetFont("Helvetica","B",7);
			$pdf->SetDrawColor(75,75,75);
			$pdf->Cell(10,10,"Clave",1,0,'L');
			$pdf->Cell($anchonombre,10,"Alumno",1,0,'C');
			$pdf->recorrer();
			$pdf->Ln(5);
			$pdf->SetFont("Helvetica","B",7);
			$pdf->Cell($anchonombre+10,5,"",0,0,'C');
			$pdf->diasmes();
			$pdf->Ln(5);
			$num=1;
			$sql="SELECT * FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$seccion' ORDER BY clave";
			$query=mysqli_query($conexion,$sql);
			if ($query->num_rows==0) {
				$nombre=utf8_decode("");
				$pdf->Cell(190,5,"****Sin Alumnos Asignados****",0,0,'C');
				$pdf->Ln(5);
			}

			while ($al=mysqli_fetch_array($query)) {
				$nombre=utf8_decode($al['apellidos'].", ".$al['nombres']);
				$pdf->SetFont("Helvetica","B",7.5);
				$pdf->Cell(10,$alto,$al['clave'],1,0,'L');
				$pdf->Cell($anchonombre,$alto,$nombre,1,0,'L');

				$pdf->cuadro();
				$pdf->Ln($alto);
				$pdf->SetFont("Helvetica","B",7.5);
				$num++;
			}
    }
  }
}


require '../../conexion/cerrar_conexion.php';
/////************************************************Ciclo de generar ficha
$nombrearchivo="Asistencia $abrcole ".$mesarray[$mes-1]." TODOS LOS GRADOS ".date("d/m/Y")."-".date("h:s a").".pdf";
$pdf->Output($nombrearchivo,'D');
?>
