<?php
require('../../assets/fpdf/fpdf.php');
setlocale(LC_ALL,"es_ES");
include '../../plugins/datetime.php';
if (isset($_GET["grado"])) {
	$rgrado=$_GET["grado"]
}else {
	$rgrado="";
}
if (isset($_GET["seccion"])) {
	$rseccion=$_GET["seccion"];
}else {
	$rseccion="";
}
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

$pdf->Cell(10,5,"Clave",1);
$pdf->Cell(10,5,"Nombre",1);
$pdf->Cell(10,5,"#R.C",1);
$pdf->Cell(15,5,"Fecha",1);
$pdf->Cell(50,5,"Nombre",1);
$pdf->Cell(50,5,"Descripcion",1);
$pdf->Cell(15,5,"$"."Cole",1);
$pdf->Cell(15,5,"$"."Compu",1);
$pdf->Cell(15,5,"Total",1);

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
	$pdf->SetFont("times","",7);
	$pdf->Cell(10,$ln,$consultacuota["id"],0);
	$pdf->Cell(10,5,$consultacuota["recibo"],0);
	$pdf->Cell(10,5,$consultacuota["recibocompu"],0);
	$pdf->Cell(15,5,$consultacuota["fecha"],0);
	$pdf->Cell(50,5,utf8_decode($consultacuota["apellidos"]).", ".utf8_decode($consultacuota["nombres"]),0);
	$pdf->SetFont("times","",6);
	$pdf->MultiCell(50,5,utf8_decode($consultacuota["descrip"]),0);
	$pdf->SetFont("times","",7);
	$_yf = $pdf->GetY();
  $_xf = $pdf->GetX();
	$pdf->SetY($_y);
	$pdf->SetX($_x+145);
	//----------------------------
	$pdf->Cell(15,5,"Q ".$consultacuota["totalmes"],0);
	$pdf->Cell(15,5,"Q ".$consultacuota["totalcompu"],0);
	$pdf->Cell(15,5,"Q ".$consultacuota["total"],0);
	//-----------------------------
	$linea=$_yf-$_y;
	$pdf->Ln(0);
	$pdf->Cell(190,$linea,"",1);
	$pdf->Ln($linea);
	$totalpc=$totalpc+$consultacuota["totalcompu"];
	$totalcole=$totalcole+$consultacuota["totalmes"];
}
$totalreporte=$totalpc+$totalcole;
$pdf->Ln(15);
$pdf->SetFont("Helvetica","",9);
$pdf->Cell(145,5,"",0);
$pdf->Cell(30,5,"Colegiaturas",1);
$pdf->Cell(15,5,"Q ".$totalcole,1);
$pdf->Ln(5);
$pdf->Cell(145,5,"",0);
$pdf->Cell(30,5,utf8_decode("Computación"),1);
$pdf->Cell(15,5,"Q ".$totalpc,1);
$pdf->Ln(5);
$pdf->Cell(145,5,"",0);
$pdf->Cell(30,5,utf8_decode("Total"),1);
$pdf->Cell(15,5,"Q ".$totalreporte,1);
include ("../../conexion/cerrar_conexion.php");
/////************************************************Ciclo de generar ficha
$nombrearchivo="HOLA.pdf";
$pdf->Output($nombrearchivo,'I');
?>
