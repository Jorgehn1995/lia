<?php
require '../lib/sesion.php';
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
require_once('../../assets/TCPDF/tcpdf.php');
include '../../assets/datetime.php';


include '../../assets/datetime.php';
class PDF extends TCPDF{
	public function Header(){
		global $fpshared,$ncole,$abrcole,$lemacole;
		$this->Ln(10);
		$this->Image($fpshared,10,8,19,19,'JPG');
		//$this->Image("images/logoescudo.jpg",180,8,19,19,'JPG');
		$this->Cell(34,8,'',0);
		$this->Cell(120,8,$ncole,0,0,'C');
		$this->Ln(8);
		$this->Cell(34,7,'',0);
		$this->Cell(120,7,$abrcole,0,0,'C');
		$this->Ln(7);
		$this->Cell(34,6,'',0);
		$fontname = TCPDF_FONTS::addTTFfont(K_PATH_FONTS . 'ITCEDSCR.TTF', 'TrueTypeUnicode', '', 8);
		$this->SetFont($fontname, '', 14, '', false);
		$this->Cell(120,6,$lemacole,0,0,'C');
		$this->Ln(6);
		$this->SetFont("Helvetica","B",8);
		$this->Cell(34,3,'',0);
		$this->Cell(120,3,"San Luis Jilotepeque",0,0,'C');
		$this->Ln(3);
		$this->SetFont("Helvetica","B",5);
		$this->Cell(34,3,'',0);
		$this->Cell(120,3,"Ciclo Escolar ".date('Y'),0,0,'C');
	}
	function Footer(){
		$this->SetY(-15);
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0,10,"Sistema LIA | Usuario Administrador | "."Pagina ".$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0,0,'C');
	}
}

$pageLayout = array(279.6, 215.9); //  or array($height, $width)
$pdf = new PDF('P', 'mm', $pageLayout, true, 'UTF-8', false);
//$pdf= new PDF('P','mm','L');
// set document information
$pdf->SetCreator("LIA System");
$pdf->SetAuthor('imed/inebco');
$pdf->SetTitle('Cuadro de Registro');
$pdf->SetSubject(' REGISTROS PDF');
$pdf->SetMargins(10,35,10,TRUE);
$pdf->AddPage();
$pdf->SetAutoPageBreak(TRUE,PDF_MARGIN_BOTTOM);




$pdf->Ln(5);
$pdf->SetFont("aefurat","",11);
$pdf->Cell(40,10,"Nombre del alumno(a): ",0);
$pdf->Cell(120,10,utf8_decode("  %%apellidos, %%nombres "),1);
$pdf->Ln(12);
$pdf->SetFont("times","",11);
$pdf->Cell(13,10,"Grado: ",0);
$pdf->SetFont("times","BI",11);
$pdf->Cell(90,10," %%grado ",0);
$pdf->SetFont("times","",11);
$pdf->Cell(16,10,"Seccion: ",0);
$pdf->SetFont("times","BI",11);
$pdf->Cell(9,10," %%seccion ",0);
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


for ($i=1; $i < 16 ; $i++) {
	$mfancho=8;
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont("times","B",9);
	//$pdf->SetFont("Century","",9);
	$pdf->Cell(12,$mfancho," $i ",1,0,'C');
	$pdf->Cell(75,$mfancho,"%%materia",1);
	$pdf->SetFont("courier","",10);
	for ($e=1; $e < 5; $e++) {
		$ib1 = 100;
		$ib1p = 15;
		$if = "100%";
		if ($e>2) {
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
$pdf->Ln(8);
$pdf->SetFont("times","",11);
$pdf->Cell(46,4,"Rendimiento Académico: ",0);
$pdf->SetFont("times","B",12);
$msgl1=""; //MENSAJE EN LINEA 1
$pdf->SetTextColor("0", "0", "0");
$pdf->Cell(20,4,"%%fr1",0,0,'C',TRUE);
$pdf->SetTextColor(0, 0, 255);
$pdf->Cell(20,4,"%%fr2",0);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(8);
$pdf->SetFont("times","",11);
$pdf->Cell(25,6,"OBSERVACIONES: ",0);
$pdf->Cell(152,0,"",0);
$pdf->Ln(0);
$pdf->Cell(33,6,"",0);
$pdf->Cell(5,4,"  _______________________________________________________________________________",0);
$msgl2=" "; //MENSAJE EN LINEA 2
$pdf->Cell(152,4,"%%mensaje",0);

$pdf->Ln(15);
$pdf->Cell(93,4,"f._______________________________",0,0,'C');
$pdf->Cell(93,4,"f._______________________________",0,0,'C');
$pdf->Ln(0);
$fontname = TCPDF_FONTS::addTTFfont(K_PATH_FONTS . 'ITCEDSCR.TTF', 'TrueTypeUnicode', '', 8);
$pdf->SetFont($fontname, '', 12, '', false);
$pdf->Cell(93,4,"Lessly Xiomara Cerna Arita",0,0,'C');
$pdf->SetFont("times","",8);
$pdf->Ln(4);
$pdf->Cell(93,4,"Profa. Lessly Xiomara Cerna Arita de G",0,0,'C');
$pdf->Cell(93,4,"Nombre del padre o encargado",0,0,'C');
$pdf->Ln(4);
$pdf->Cell(93,4,"Directora del Establecimiento",0,0,'C');

/////************************************************Ciclo de generar ficha
$nombrearchivo="nombrearchivo.pdf";
$pdf->Output($nombrearchivo,'I');
?>
