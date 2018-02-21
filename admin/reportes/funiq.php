<?php
require('../../assets/fpdf/fpdf.php');
include '../../assets/datetime.php';
require '../../assets/glib/isset.php';
require '../lib/sesion.php';
/* Inicio del las variables centrales*/
$fecha=d("f");	//fecha de la consulta
if ($fecha=="" || $fecha=="undefined") {
	$fecha=date("d/m/Y");
}

$tipodatos="Reporte Fecha Unica"; //tipo de datos
$resumen=dmylargo($fecha); // resumen de datos
$nuser=nombreusuario($idusuario); //nombre del usuario de lia

$setcole=viewsetstatus("rcole");

$table=1;

$f = date_format(date_create_from_format('d/m/Y',$fecha),'Y-m-d');

$columnpc=d("cpc");
if ($columnpc=="" || $columnpc==0) {
	$columnpc="";
}
$uniqid=uniqid();


class PDF extends FPDF{
	function Header(){
		$this->SetTextColor(75,75,75);
		$this->Image("images/logoinebco.jpg",10,8,9,10,'JPG');
		//$pdf->Cell(34,8,'',0);
		$this->SetFont("Helvetica","",14);
		$this->Cell(30,8,utf8_decode('INEBCO'),0,0,'R');
		$this->SetFont("Helvetica","B",8);
		global $uniqid, $table;
		$this->Cell(130,4,'Hoja de datos # ',0,0,'R');
		$this->Cell(30,4,'Pag # ',0,0,'R');
		$this->Ln(4);
		$this->Cell(160,4,$uniqid,0,0,'R');
		$this->Cell(30,4,$this->PageNo().'/{nb}',0,0,'R');
		$this->Ln(1);
		$this->SetDrawColor(200,200,200);
		$this->Cell(190,5,"","B",0,'L');
		$this->Ln(5);
		if ($this->PageNo()>1 And $table==1) {
			$this->table();
		}
	}
	function Footer(){
		$this->SetY(-15);
		$this->SetFont("Helvetica","",7);
		$this->SetTextColor(130,130,130);
		$this->Cell(190,4,utf8_decode("LIA - System of Learning, Investigation and Advanced School Management - JH Developer"." - ".date("h:s a")),0,0,'C');
	}
	function table(){
		$this->SetTextColor(75,75,75);
		$this->SetDrawColor(175,175,175);
		$this->Cell(10,5,"#","B,T",0,'L');
		$this->Cell(30,5,"Alumno","B,T");

		global $setcole;
		if ($setcole) {
			$this->Cell(120,5,utf8_decode("Descripción"),"B,T");
			$this->Cell(10,5,"CC","B,T");
			$this->Cell(10,5,"PC","B,T");
			$this->Cell(10,5,"TOTAL","B,T");
		}else {
			$this->Cell(140,5,utf8_decode("Descripción"),"B,T");
			$this->Cell(10,5,"PC","B,T");
		}

		$this->Ln(5);
		$this->SetFont("Helvetica","",7);
		$this->SetTextColor(130,130,130);
	}
}
$s="No";
if (isset($_GET['d'])) {
	if ($_GET['d']=="N") {
		$s="No";
	}else {
		$s="Si";
	}
}
$pdf= new PDF('P','mm','Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->Header();
$pdf->SetTextColor(70,70,70);
$pdf->AddFont('Script','','ITCEDSCR.php');
$pdf->AddFont('Century','','Century.php');
$pdf->SetFont("Helvetica","B",14);
$pdf->Ln(10);
include 'headficha.php';
$pdf->table();
require '../../conexion/conexion.php';
$ColeInscrip=0;$ColeCole=0;$ColeOE=0;
$PcInscrip=0;$PcCole=0;
$sql="SELECT * FROM `detalles` INNER JOIN `alumnos` ON detalles.idalumno = alumnos.idalumno WHERE detalles.fecha='$f' ORDER BY fecha desc";
$query=mysqli_query($conexion,$sql);
if ($query) {
	if ($query->num_rows==0) {
		$pdf->Cell(190,5,"---- SIN DATOS ----","B,T",0,'C');
		$pdf->Ln(5);
	}
	while ($a=mysqli_fetch_array($query)) {
		//nombres
		$n=explode(" ",$a['nombres']);
		$ap=explode(" ",$a['apellidos']);
		$nn=utf8_decode($n[0]." ".$ap[0]);
		//totales
		$tcole=$a['inscrip']+$a['colegiatura']+$a['oe'];
		$tcompu=$a['inscrip_pc']+$a['compu'];
		$tt=$tcole+$tcompu;
		$ColeInscrip+=$a['inscrip'];
		$ColeCole+=$a['colegiatura'];
		$ColeOE+=$a['oe'];
		$PcInscrip+=$a['inscrip_pc'];
		$PcCole+=$a['compu'];
		//tabla
		if (strlen($a['descripcion'])>75) {
			$ln=5;
			$de=str_split($a['descripcion'],75);
			$descripcion=utf8_decode($de[0]." ".$de[1]);
		}else {
			$ln=5;
			$descripcion=utf8_decode($a['descripcion']);
		}

		$pdf->Cell(10,$ln,$a['inscrip'],"B,T",0,'L');
		$pdf->Cell(30,$ln,$nn,"B,T");

		if ($setcole) {
			$pdf->Cell(120,$ln,$descripcion,"B,T",0,'L');
			$pdf->Cell(10,$ln,"Q $tcole","B,T",0,'R');
			$pdf->Cell(10,$ln,"Q $tcompu","B,T",0,'R');
			$pdf->Cell(10,$ln,"Q $tt","B,T",0,'R');
		}else {
			$pdf->Cell(140,$ln,$descripcion,"B,T",0,'L');
			$pdf->Cell(10,$ln,"Q $tcompu","B,T",0,'R');
		}

		$pdf->Ln($ln);
	}
	$pdf->SetFont("Helvetica","",7);
	$pdf->Cell(190,5,"**************************************************** Ultima linea de datos ****************************************************",0,0,'C');
	$pdf->Ln(10);

	$table=0;
	if ($setcole) {
		$pdf->Cell(30,5,"Anotaciones:","");
		$pdf->Ln(5);
		$pdf->MultiCell(80,5,utf8_decode("El total de la seccion 'COLEGIO' puede que no coincida en materia de fechas y totales con la cuenta corriente"),"");
		$pdf->Ln(-15);
		/* Total Colegio */
		$pdf->Cell(190,5,"******** Colegio *******",0,0,'R');
		$pdf->Ln(5);
		$pdf->Cell(160,5,"Inscripciones Colegio:",0,0,'R');
		$pdf->Cell(30,5,"Q ".round($ColeInscrip,2),0,0,'R');
		$pdf->Ln(5);
		$pdf->Cell(160,5,"Operacion Escuela:",0,0,'R');
		$pdf->Cell(30,5,"Q ".round($ColeOE ,2),0,0,'R');
		$pdf->Ln(5);
		$pdf->Cell(160,5,"Colegiaturas:",0,0,'R');
		$pdf->Cell(30,5,"Q ".round($ColeCole ,2),0,0,'R');
		$pdf->Ln(5);
		$pdf->SetTextColor(75,75,75);
		$pdf->SetFont("Helvetica","B",9);
		$pdf->Cell(160,10,"Total Colegio:",0,0,'R');
		$pdf->Cell(30,10,"Q ".round($ColeInscrip+$ColeOE+$ColeCole ,2),"T",0,'R');
		$pdf->Ln(15);
		$pdf->SetTextColor(130,130,130);
		$pdf->SetTextColor(130,130,130);
		$pdf->SetFont("Helvetica","",7);
	}

	/* Total Computacion */
	$pdf->Cell(190,5,"******** Computacion *******",0,0,'R');
	$pdf->Ln(5);
	$pdf->Cell(160,5,"Inscripciones Computacion:",0,0,'R');
	$pdf->Cell(30,5,"Q ".round( $PcInscrip,2),0,0,'R');
	$pdf->Ln(5);
	$pdf->Cell(160,5,"Colegiaturas:",0,0,'R');
	$pdf->Cell(30,5,"Q ".round($PcCole ,2),0,0,'R');
	$pdf->Ln(5);
	$pdf->SetTextColor(75,75,75);
	$pdf->SetFont("Helvetica","B",9);
	$pdf->Cell(160,10,"Total Computacion:",0,0,'R');
	$pdf->Cell(30,10,"Q ".round( $PcCole+$PcInscrip,2),"T",0,'R');
	$pdf->Ln(10);
	$pdf->SetFont("Helvetica","",7);
	$pdf->SetTextColor(130,130,130);
	$pdf->SetTextColor(130,130,130);
}

require '../../conexion/cerrar_conexion.php';
$bande=0;
$ln=5;
$_y=0;
$totalpc=0;
$totalcole=0;
$totalreporte=0;
$_x=0;

/////************************************************Ciclo de generar ficha
$nombrearchivo="HOLA.pdf";
$pdf->Output($nombrearchivo,'I');
?>
