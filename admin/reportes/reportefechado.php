<?php
require('../../assets/fpdf/fpdf.php');
setlocale(LC_ALL,"es_ES");
include '../../assets/datetime.php';


if (isset($_GET['d'])) {
	if ($_GET['d']=="hoy") {
		$iDia=date("d");
		$fDia=date("d");
		$iMes=date("m");
		$fMes=date("m");
		$iA=date("Y");
		$fA=date("Y");
		$tabH="active";
		$tabF="";
	}else {
		$iDia=$_GET['iDia'];
		$fDia=$_GET['fDia'];
		$iMes=$_GET['iMes'];
		$fMes=$_GET['fMes'];
		$iA=$_GET['iAn'];
		$fA=$_GET['fAn'];
		$tabH="";
		$tabF="active";
	}
}
$inicio="$iA-$iMes-$iDia";
$final="$fA-$fMes-$fDia";


$pdf= new FPDF('P','mm','Letter');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->AddFont('Script','','ITCEDSCR.php');
$pdf->AddFont('Century','','Century.php');
$pdf->SetFont("Helvetica","B",14);
include 'headficha.php';
$pdf->Cell(34,3,'',0);
$pdf->Cell(120,3,"Informe por Fecha del ".$inicio." al ".$final,0,0,'C');
$pdf->Ln(3);
$pdf->SetFont("Helvetica","B",6);
$pdf->Cell(34,3,'',0);
$pdf->Cell(120,3,"San Luis Jilotepeque ".date('Y'),0,0,'C');
$pdf->Ln(5);

$pdf->Cell(10,5,"#",1);
$pdf->Cell(7,5,"RC",1);
$pdf->Cell(7,5,"RPC",1);
$pdf->Cell(12,5,"Fecha",1);
$pdf->Cell(40,5,"Nombre",1);
$pdf->Cell(90,5,"Descripcion",1);
$pdf->Cell(10,5,"$"."Cole",1);
$pdf->Cell(10,5,"$"."Compu",1);
$pdf->Cell(10,5,"Total",1);

$pdf->Ln(5);
$bande=0;
$ln=5;
$_y=0;
$totalpc=0;
$totalcole=0;
$totalreporte=0;
$_x=0;
include ("../../conexion/conexion.php");
$consulta="SELECT * FROM `transacciones` WHERE fecha>='$inicio' AND fecha<='$final' ";
$resultado = mysqli_query($conexion,$consulta);
while($consultacuota = mysqli_fetch_array($resultado)){
	$_y = $pdf->GetY();
  $_x = $pdf->GetX();
	$pdf->SetFont("times","",6);
	$pdf->Cell(10,$ln,$consultacuota["Id"],1);
	$pdf->Cell(7,5,$consultacuota["recibo"],1);
	$pdf->Cell(7,5,$consultacuota["recibocompu"],1);
	$pdf->Cell(12,5,$consultacuota["fecha"],1);
	$pdf->Cell(40,5,utf8_decode($consultacuota["apellidos"]).", ".utf8_decode($consultacuota["nombres"]),1);
	$pdf->SetFont("times","B",5);
	$pdf->Cell(90,5,utf8_decode($consultacuota["descrip"]),1);
	$pdf->SetFont("times","",6);
	$_yf = $pdf->GetY();
  $_xf = $pdf->GetX();
	//----------------------------
	$pdf->Cell(10,5,"Q ".$consultacuota["totalmes"],1);
	$pdf->Cell(10,5,"Q ".$consultacuota["totalcompu"],1);
	$pdf->Cell(10,5,"Q ".$consultacuota["total"],1);
	//-----------------------------
	$linea=5;
	$pdf->Ln(0);
	//$pdf->Cell(190,$linea,"",1);
	$pdf->Ln($linea);
	$totalpc=$totalpc+$consultacuota["totalcompu"];
	$totalcole=$totalcole+$consultacuota["totalmes"];
}
$totalreporte=$totalpc+$totalcole;
$pdf->Ln(15);
$pdf->SetFont("Helvetica","",9);
$pdf->Cell(145,5,"",0);
$pdf->Cell(30,5,"Colegiaturas",0);
$pdf->Cell(15,5,"Q ".$totalcole,0);
$pdf->Ln(5);
$pdf->Cell(145,5,"",0);
$pdf->Cell(30,5,utf8_decode("Computación"),0);
$pdf->Cell(15,5,"Q ".$totalpc,0);
$pdf->Ln(5);
$pdf->Cell(145,5,"",0);
$pdf->Cell(30,5,utf8_decode("Total"),0);
$pdf->Cell(15,5,"Q ".$totalreporte,0);
include ("../../conexion/cerrar_conexion.php");
/////************************************************Ciclo de generar ficha
$nombrearchivo="HOLA.pdf";
$pdf->Output($nombrearchivo,'I');
?>
