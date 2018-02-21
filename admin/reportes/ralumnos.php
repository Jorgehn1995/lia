<?php
require('../../assets/fpdf/fpdf.php');
include '../../assets/datetime.php';
require '../../assets/glib/isset.php';
require '../lib/sesion.php';
calcularedades($idcole);
/* Inicio del las variables centrales*/
$fecha=d("f");	//fecha de la consulta
if ($fecha=="" || $fecha=="undefined") {
	$fecha=date("d/m/Y");
}
$tipodatos="Alumnos";
$resumen="Estadistica de Genero y Edades";
$nuser="INEBCO";
$uniqid=uniqid();
$table=1;
$f = date_format(date_create_from_format('d/m/Y',$fecha),'Y-m-d');
class PDF extends FPDF{
	function Header(){
		global $uniqid, $table;
		$this->SetTextColor(75,75,75);
		$this->Image("images/logoinebco.jpg",10,8,9,10,'JPG');
		$this->SetFont("Helvetica","",14);
		$this->Cell(30,8,utf8_decode('INEBCO'),0,0,'R');
		$this->SetFont("Helvetica","B",8);
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
	function table(){

	}
}

$pdf= new PDF('P','mm','Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTextColor(70,70,70);
$pdf->AddFont('Script','','ITCEDSCR.php');
$pdf->AddFont('Century','','Century.php');
$pdf->SetFont("Helvetica","B",14);
$pdf->Ln(10);
$pdf->SecondHeader();
require '../../conexion/conexion.php';
$sql="SELECT * FROM `grados` WHERE idcole='$idcole'";
$query=mysqli_query($conexion,$sql);
if ($query) {
	while ($a=mysqli_fetch_array($query)) {
		$idgrado=$a['idgrado'];
		$nombre=$a['boton'];
		//Cantidad de hombres y mujeres
		$sql2="SELECT * FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado'";
		$query2=mysqli_query($conexion,$sql2);
		$total=$query2->num_rows;
		$sql2="SELECT * FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado' AND genero='F'";
		$query2=mysqli_query($conexion,$sql2);
		$mujeres=$query2->num_rows;
		$sql2="SELECT * FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado' AND genero='M'";
		$query2=mysqli_query($conexion,$sql2);
		$hombres=$query2->num_rows;
		$sql2="SELECT * FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado' AND activo!='Retirado' ";
		$query2=mysqli_query($conexion,$sql2);
		$activos=$query2->num_rows;
		$retirados=$total-$activos;


		$pdf->SetTextColor(75,75,75);
		$pdf->SetDrawColor(175,175,175);
		$pdf->Cell(190,10,"Alumnos ".utf8_decode($nombre),1,0,'L');
		$pdf->Ln(15);
		$pdf->Cell(60,5,"Hombres: ","",0,'R');
		$pdf->Cell(30,5,"$hombres",0,0,'L');
		$pdf->Cell(30,5,"Activos: ","",0,'R');
		$pdf->Cell(30,5,"$activos","",0,'L');
		$pdf->Ln(5);
		$pdf->Cell(60,5,"Mujeres: ","",0,'R');
		$pdf->Cell(30,5,"$mujeres","",0,'L');
		$pdf->Cell(30,5,"Retirados: ","",0,'R');
		$pdf->Cell(30,5,"$retirados","",0,'L');
		$pdf->Ln(5);
		$pdf->Cell(60,5,"Total: ","",0,'R');
		$pdf->Cell(30,5,"$total",0,0,'L');
		$border=20;
		$bordertable=0;
		$pdf->Ln(-15);
		$pdf->Cell(150,5,"","0");
		$pdf->Cell(40,5,utf8_decode("Edades de Alumnos"),1,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(150,5,"","");
		$pdf->Cell(20,5,utf8_decode("Cantidad"),1);
		$pdf->Cell(20,5,utf8_decode("Edad"),1);
		$pdf->Ln(5);
		$sql2="SELECT * FROM `edadesxgrado` WHERE idcole='$idcole' AND idgrado='$idgrado'  ORDER BY edades";
		$query2=mysqli_query($conexion,$sql2);
		while ($a=mysqli_fetch_array($query2)) {
			$pdf->Cell(150,5,"","");
			$pdf->Cell(20,5,utf8_decode($a['cantidades']),1,0,'R');
			$pdf->Cell(20,5,utf8_decode($a['edades']),1,0,'R');
			$pdf->Ln(5);
			$bordertable+=5;
		}

		$pdf->Ln(10);
	}


	//Cantidad de hombres y mujeres
	$sql2="SELECT * FROM `alumnos` WHERE idcole='$idcole'";
	$query2=mysqli_query($conexion,$sql2);
	$total=$query2->num_rows;
	$sql2="SELECT * FROM `alumnos` WHERE idcole='$idcole' AND genero='F'";
	$query2=mysqli_query($conexion,$sql2);
	$mujeres=$query2->num_rows;
	$sql2="SELECT * FROM `alumnos` WHERE idcole='$idcole' AND genero='M'";
	$query2=mysqli_query($conexion,$sql2);
	$hombres=$query2->num_rows;
	$sql2="SELECT * FROM `alumnos` WHERE idcole='$idcole' AND activo!='Retirado' ";
	$query2=mysqli_query($conexion,$sql2);
	$activos=$query2->num_rows;
	$retirados=$total-$activos;
	$pdf->SetTextColor(75,75,75);
	$pdf->SetFillColor(200,200,200);
	$pdf->SetDrawColor(175,175,175);
	$pdf->Cell(190,10,"Total Alumnos INEBCO ",1,0,'L',true);
	$pdf->Ln(15);
	$pdf->Cell(60,5,"Hombres: ","",0,'R');
	$pdf->Cell(30,5,"$hombres",0,0,'L');
	$pdf->Cell(30,5,"Activos: ","",0,'R');
	$pdf->Cell(30,5,"$activos","",0,'L');
	$pdf->Ln(5);
	$pdf->Cell(60,5,"Mujeres: ","",0,'R');
	$pdf->Cell(30,5,"$mujeres","",0,'L');
	$pdf->Cell(30,5,"Retirados: ","",0,'R');
	$pdf->Cell(30,5,"$retirados","",0,'L');
	$pdf->Ln(5);
	$pdf->Cell(60,5,"Total: ","",0,'R');
	$pdf->Cell(30,5,"$total",0,0,'L');
	$border=20;
	$bordertable=0;
	$pdf->Ln(-15);
	$pdf->Cell(150,5,"","0");
	$pdf->Cell(40,5,utf8_decode("Edades de Alumnos"),1,0,'C');
	$pdf->Ln(5);
	$pdf->Cell(150,5,"","");
	$pdf->Cell(20,5,utf8_decode("Cantidad"),1);
	$pdf->Cell(20,5,utf8_decode("Edad"),1);
	$pdf->Ln(5);
	$sql2="SELECT * FROM `edades` WHERE idcole='$idcole'  ORDER BY edades";
	$query2=mysqli_query($conexion,$sql2);
	while ($a=mysqli_fetch_array($query2)) {
		$pdf->Cell(150,5,"","");
		$pdf->Cell(20,5,utf8_decode($a['cantidades']),1,0,'R');
		$pdf->Cell(20,5,utf8_decode($a['edades']),1,0,'R');
		$pdf->Ln(5);
		$bordertable+=5;
	}


	$pdf->Ln(10);
}else {
	errorsql($conexion);
}

require '../../conexion/cerrar_conexion.php';
/////************************************************Ciclo de generar ficha
$nombrearchivo="Reporte LIA $uniqid-".date("d/m/Y")."-".date("h:s a").".pdf";
$pdf->Output($nombrearchivo,'I');
?>
