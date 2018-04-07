<?php
require('../../assets/fpdf/fpdf.php');
$r=0;
$g=0;
$b=0;
if(isset($_GET['acodigo'])){
	$amigo=$_GET['acodigo'];
} else {
	$amigo="";
}
if(isset($_GET['rc'])){
	$colorR=utf8_decode($_GET['rc']);
} else {
	$colorR="255, 0, 0";
}
if ($colorR=="R") {
	$r=255;
	$g=0;
	$b=0;
}
if ($colorR=="A") {
	$r=0;
	$g=175;
	$b=0;
}
if ($colorR=="V") {
	$r=0;
	$g=0;
	$b=255;
}
if(isset($_GET['r1'])){
	$fr1=utf8_decode($_GET['r1']);
} else {
	$fr1="";
}
if(isset($_GET['r2'])){
	$fr2=utf8_decode($_GET['r2']);
} else {
	$fr1="";
}
include 'datosamigo.php';
include 'labelrendimiento.php';
include '../plugins/datetime.php';
class PDF extends FPDF
{
function Footer()
{
    // Go to 1.5 cm from bottom
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Arial','I',8);
    // Print centered page number
		include '../plugins/datetime.php';
		if(isset($_GET['lg'])){
			$lugardegrado=$_GET['lg'];
		} else {
			$lugardegrado="";
		}
		include 'datos_a_variables.php';
		$amigo=$_GET['acodigo'];
    $this->Cell(0,10,"SEF | $cargo | $fecha | $hora | $amigo | $lugardegrado",0,0,'C');
}
}
$pdf= new PDF('P','mm','Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->AddFont('Script','','ITCEDSCR.php');
$pdf->AddFont('Century','','Century.php');
$pdf->SetFont("Helvetica","B",14);
include 'headficha.php';
$pdf->SetFont("Helvetica","B",8);
$pdf->Cell(34,3,'',0);
$pdf->Cell(120,3,"Ciclo Escolar ".date('Y'),0,0,'C');
$pdf->Ln(5);
$pdf->SetFont("times","",11);
$pdf->Cell(40,10,"Nombre del alumno(a): ",0);
$pdf->SetFont("Century","",15);
$pdf->Cell(120,10,utf8_decode("  $apellidos, $nombres "),1);
$pdf->Ln(12);
$pdf->SetFont("times","",11);
$pdf->Cell(13,10,"Grado: ",0);
$pdf->SetFont("times","BI",16);
$pdf->Cell(25,10," $grado ",0);
$pdf->SetFont("times","",11);
$pdf->Cell(16,10,"Seccion: ",0);
$pdf->SetFont("times","BI",16);
$pdf->Cell(9,10," $seccion ",0);
$pdf->Ln(10);
$pdf->SetFont("times","BI",14);
$pdf->Cell(12,25," No. ",1);
$pdf->Cell(75,25," Nombre de la Materia ",1);
$pdf->SetFont("times","B",12);
$pdf->Cell(80,7,"Bloques",1,0,'C');
$pdf->Cell(20,25," Final ",1,0,'C');
$pdf->Ln(7);
$pdf->Cell(87,18,"",0);
$pdf->Cell(20,5,"I",1,0,'C');
$pdf->Cell(20,5,"II",1,0,'C');
$pdf->Cell(20,5,"III",1,0,'C');
$pdf->Cell(20,5,"IV",1,0,'C');
//***********NOTAS Y Bloques
$pdf->Ln(5);
$pdf->SetFillColor(239, 239, 239);
$pdf->Cell(87,13,"",0);
$pdf->SetFont("times","",7);
$pdf->Cell(10,13,"NOTA",1,0,'C');
$pdf->SetFont("times","B",8);
$pdf->Cell(10,13,"15%",1,0,'C',TRUE);
$pdf->SetFont("times","",7);
$pdf->Cell(10,13,"NOTA",1,0,'C');
$pdf->SetFont("times","B",8);
$pdf->Cell(10,13,"20%",1,0,'C',TRUE);
$pdf->SetFont("times","",7);
$pdf->Cell(10,13,"NOTA",1,0,'C');
$pdf->SetFont("times","B",8);
$pdf->Cell(10,13,"25%",1,0,'C',TRUE);
$pdf->SetFont("times","",7);
$pdf->Cell(10,13,"NOTA",1,0,'C');
$pdf->SetFont("times","B",8);
$pdf->Cell(10,13,"40%",1,0,'C',TRUE);
$pdf->Ln(13);
$numeroclases=17;
if ($grado=="Primero") {
	$numeroclases=17;
} else {
	$numeroclases=16;
}
for ($i=1; $i < $numeroclases ; $i++) {
	$mfancho=9;
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont("times","B",9);
	$imateria = "$"."m"."$i"."l";
	eval("\$imateria = \"$imateria\";");
	$pdf->SetFont("Century","",9);
	$pdf->Cell(12,$mfancho," $i ",1,0,'C');
	$pdf->Cell(75,$mfancho,utf8_decode($imateria),1);
	$pdf->SetFont("courier","",10);
	for ($e=1; $e < 5; $e++) {
		$ib1 = "$"."B$e"."C"."$i";
		eval("\$ib1 = \"$ib1\";");
		$ib1p = "$"."B$e"."C"."$i"."p";
		eval("\$ib1p = \"$ib1p\";");
		$if = "$"."f"."$i";
		eval("\$if = \"$if\";");
		if ($e>$bloqueencurso) {
			$ib1="";
			$ib1p="";
		}
		if ($ib1<60) {
			$pdf->SetFillColor(255, 255, 255);
			$pdf->SetTextColor(255, 0, 0);
			$pdf->SetFont("courier","BI",12);
		}
		$pdf->Cell(10,$mfancho,$ib1,1,0,'C',TRUE);
		$pdf->SetFont("courier","",10);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFillColor(239, 239, 239);
		$pdf->Cell(10,$mfancho,$ib1p,1,0,'C',TRUE);
		$pdf->SetFillColor(255, 255, 255);
	}
	$pdf->SetFont("times","B",12);
	$pdf->Cell(20,$mfancho,$if,1,0,'C');
	$pdf->SetFont("times","B",8);
	$pdf->Ln($mfancho);
}
$pdf->Ln(3);
$pdf->SetFont("times","",11);
$pdf->Cell(46,4,utf8_decode("Rendimiento Académico: "),0);
$pdf->SetFont("times","B",12);
$msgl1=""; //MENSAJE EN LINEA 1
$pdf->SetTextColor($r, $g, $b);
$pdf->Cell(20,4,$fr1,0,0,'C',TRUE);
$pdf->SetTextColor(0, 0, 255);
$pdf->Cell(20,4,$fr2,0);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(5);
$pdf->SetFont("times","",11);
$pdf->Cell(25,6,"OBSERVACIONES: ",0);
$pdf->Cell(152,0,"",0);
$pdf->Ln(0);
$pdf->Cell(33,6,"",0);
$pdf->Cell(5,4,"  _______________________________________________________________________________",0);
$msgl2=" "; //MENSAJE EN LINEA 2
$pdf->Cell(152,4,$msgl2,0);

$pdf->Ln(9);
$pdf->Cell(93,4,"f._______________________________",0,0,'C');
$pdf->Cell(93,4,"f._______________________________",0,0,'C');
$pdf->Ln(0);
$pdf->SetFont("Script","",12);
$pdf->Cell(93,4,"Lessly Xiomara Cerna Arita",0,0,'C');
$pdf->SetFont("times","",8);
$pdf->Ln(4);
$pdf->Cell(93,4,"Profa. Lessly Xiomara Cerna Arita de G",0,0,'C');
$pdf->Cell(93,4,"Nombre del padre o encargado",0,0,'C');
$pdf->Ln(4);
$pdf->Cell(93,4,"Directora del Establecimiento",0,0,'C');

/////************************************************Ciclo de generar ficha
$nombrearchivo="$amigo-$nombres-$fecha-$hora.pdf";
$pdf->Output($nombrearchivo,'I');
?>
