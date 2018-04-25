<?php
require '../lib/sesion.php';
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
require_once('../../assets/TCPDF/tcpdf.php');
require "../../assets/qr/phpqrcode/qrlib.php";
include '../../assets/datetime.php';
$idalumno=d("id");
$idgrado=d("idgrado");
$sec=d("sec");
//$idgrado=1;
//$sec="A";
include '../../assets/datetime.php';
class PDF extends TCPDF{
	public function Header(){
		global $fpshared,$ncole,$abrcole,$lemacole,$dominio;
		$this->Ln(10);
		$this->Image($fpshared,10,7,20,20,'JPG');
		$this->Image("images/logoescudo.jpg",180,8,19,19,'JPG');
		$this->Cell(190,7,$ncole." ".$abrcole,0,0,'C');
		$this->Ln(3);
		$sp=4;
		$fontname = TCPDF_FONTS::addTTFfont(K_PATH_FONTS . 'ITCEDSCR.TTF', 'TrueTypeUnicode', '', 8);
		$this->SetFont($fontname, '', 16, '', false);
		$this->Ln($sp);

		$this->Cell(190,3,$lemacole,0,0,'C');

		$this->Ln($sp);
		$this->SetFont("Helvetica","",8);
		$this->Ln(3);
		$this->Cell(190,3,"San Luis Jilotepeque, Jalapa. Guatemala.",0,0,'C');

		$this->Ln($sp);
		$this->Cell(190,3,"Ciclo Escolar ".date('Y'),0,0,'C');
	}
	function Footer(){
		$this->SetY(-15);
		$this->SetFont('helvetica', 'I', 8);
		$this->Cell(0,10,"Sistema de Calificaciones LIA | Usuario Administrador | "."Pagina ".$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0,0,'C');
	}
}

$pageLayout = array(279.6, 215.9); //  or array($height, $width)
$pdf = new PDF('P', 'mm', $pageLayout, true, 'UTF-8', false);

/**
* @var Encabezados
*/
$pdf->SetCreator("LIA System");
$pdf->SetAuthor('imed/inebco');
$pdf->SetTitle('Ficha de calificaciones');
$pdf->SetSubject(' REGISTROS PDF');
$pdf->SetMargins(10,25,10,TRUE);

$sqlg="SELECT * FROM `alumnos` INNER JOIN `grados` ON alumnos.idgrado=grados.idgrado WHERE alumnos.idgrado='$idgrado' AND alumnos.seccion='$sec' ORDER BY alumnos.clave ASC";
$queryg=mysqli_query($conexion,$sqlg);
while ($aa=mysqli_fetch_array($queryg)) {
	$idalumno=$aa['idalumno'];

	$pdf->AddPage();
	$pdf->SetAutoPageBreak(TRUE,PDF_MARGIN_BOTTOM);

	/**
	* @var Datos_del_alumno
	*/
	$sql="SELECT * FROM `alumnos` INNER JOIN `grados` ON alumnos.idgrado=grados.idgrado WHERE alumnos.idalumno='$idalumno' AND alumnos.idcole='$idcole' LIMIT 1";
	$query=mysqli_query($conexion,$sql);
	while ($a=mysqli_fetch_array($query)) {
		$ap=$a['apellidos'];
		$n=$a['nombres'];
		$na=$ap.", ".$n;
		$gra=$a['boton'];
		$sec=$a['seccion'];
		$g=$gra." ".$sec;
		$cc=$a['clases'];
		$idgrado=$a['idgrado'];
		$codigo=$a['codigo'];
	}
	$at=($cc/15)*10;
	$pdf->Ln(5);

	$pdf->SetFont("aefurat","",11);
	$pdf->Cell(40,10,"Nombre del alumno(a): ",0);
	$pdf->SetFont("aefurat","B",14);
	$pdf->Cell(147,10,$na,"B");
	$pdf->Ln(12);
	$pdf->SetFont("times","",11);
	$pdf->Cell(40,7,"Grado: ",0);
	$pdf->SetFont("times","BI",11);
	$pdf->Cell(120,7,$g,0);
	$pdf->Ln(3);
	$pdf->Ln($at);
	$pdf->SetFont("aefurat","",11);
	$pdf->Cell(190,10,"FICHA DE CALIFICACIONES ",0,0,'C');
	$pdf->Ln(10);

	/**
	* @var Inicio_de_la_ficha
	* @var Inicio_POnderacion
	*/
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
	$pdf->SetFont("times","",7);
	$pdf->Cell(87,13,"",0);
	$pdf->Cell(10,13,"NOTA",1,0,'C');
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
	$if=0;
	$cp=0;
	$cn=0;
	for ($i=1; $i <= $cc ; $i++) {
		$mfancho=8;
		$pdf->SetFillColor(255, 255, 255);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont("times","B",9);
		//$pdf->SetFont("Century","",9);
		$pdf->SetFont("aefurat","",8);

		for ($e=1; $e <= 4; $e++) {
			$ib1 = 100;
			$ib1p = 15;

			if ($e>$bloqueencurso) {
				$ib1="";
				$ib1p="";
			}else {
				/**
				* @var busquedapunteos*********************************
				*/
				$sql2 = "SELECT * FROM `materias` INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria WHERE materias.idcole='$idcole' AND num='$i' AND idgrado='$idgrado' AND seccion='$sec' ORDER BY num ASC";
				$query2 = mysqli_query($conexion,$sql2);
				if(!$query2){
					errorsql($conexion);
				}else{
					while( $b = mysqli_fetch_array($query2)){
						$idmateria=$b['idnombremateria'];
						if ($b['nombreficha']=="") {
							$nm=$b['nombre'];
						}else {
							$nm=$b['nombreficha'];
						}
						if ($e==1) {
							$pdf->Cell(12,$mfancho," $i ",1,0,'C');
							//1, 'J', 1, 1, 125, 145, true, 0, false, true, 60, 'M', true
							//$pdf->MultiCell(75, $mfancho, $nm, 1, 'J', 1, 0, '' ,'', false);
							$pdf->MultiCell(75, $mfancho, $nm."\n", 1, 'J', 1, 0, '', '', false);
							//$pdf->MultiCell(75,$mfancho,$nm,1);
						}
						$sql4="SELECT *,SUM(obtenido) as tt FROM `notasasesores` WHERE idalumno='$idalumno' AND idbloque='$e' GROUP BY idbloque LIMIT 1";
						$query4=mysqli_query($conexion,$sql4);
						if ($query4->num_rows==0) {
							$asesor=0;
						}
						while ($c=mysqli_fetch_array($query4)) {
							$asesor=$c['tt'];
						}
						$sql3="SELECT *,SUM(obtenido) as tt FROM `notas` WHERE idmateria='$idmateria' AND  idalumno='$idalumno' AND idbloque='$e' GROUP BY idmateria LIMIT 1";
						$query3=mysqli_query($conexion,$sql3);
						if ($query3->num_rows==0) {
							$tt=$asesor;
							$ib1=0;
						}
						while ($c=mysqli_fetch_array($query3)) {
							$tt=$asesor+$c['tt'];
							if ($tt>100) {
								$tt=100;
							}
							$ib1=$tt;
							$ib1p=$ib1*0.15;
							$ib1p=round($ib1p,0);
							$if=$if+$ib1p;
							$cn=$cn+$ib1;
							if ($ib1<60) {
								$cp=$cp+1;
							}
						}

					}
				}
				//*********************************

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
		$if=0;
		$pdf->SetFont("times","B",8);
		$pdf->Ln($mfancho);
	}
	$r=$pdf->GetY()+3;
	$pdf->Ln(10);
	$cnt=$cn/$cc;
	if ($cp>0) {
		$msgl2="¡Debe Mejorar! ";
		$color=255;
		$c2=0;
	}else {
		if ($cnt>90) {
			$msgl2="Excelente ¡Felicitaciones!";
			$color=0;
			$c2=190;
		}else {
			$msgl2="¡Felicitaciones! ";
			$color=0;
			$c2=0;
		}

	}
	$urlfile="../../assets/qr/temp/$codigo.png";
	$contenido = "$dominio/ext/?id=$codigo"; //Texto

	$pdf->Cell(25,6,"OBSERVACIONES: ",0);
	$pdf->Cell(152,0,"",0);
	$pdf->Ln(0);
	$pdf->Cell(33,6,"",0);
	$pdf->Cell(5,4,"  ___________________________________________________________________________________________________________",0);
	//$msgl2="  "; //MENSAJE EN LINEA 2
	$pdf->SetFont("times","BI",12);
	$pdf->Ln(-2);
	$pdf->Cell(45,6," ",0);
	$pdf->SetTextColor($color,$c2,0);
	$pdf->Cell(152,4,$msgl2,0);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont("times","",8);
	$pdf->Ln(12);
	$pdf->Cell(93,4,"f._____________________________________",0,0,'C');
	$pdf->Cell(93,4,"f._____________________________________",0,0,'C');
	$pdf->Ln(-2);
	$fontname = TCPDF_FONTS::addTTFfont(K_PATH_FONTS . 'ITCEDSCR.TTF', 'TrueTypeUnicode', '', 8);
	$pdf->SetFont($fontname, '', 14, '', false);
	$pdf->Cell(93,4,"Lessly Xiomara Cerna Arita",0,0,'C');
	$pdf->SetFont("times","",8);
	$pdf->Ln(6);
	$pdf->Cell(93,4,"Profa. Lessly Xiomara Cerna Arita de G",0,0,'C');
	$pdf->Cell(93,4,"Nombre del padre o encargado",0,0,'C');
	$pdf->Ln(6);
	$pdf->Cell(93,4,"Directora del Establecimiento",0,0,'C');
	/////************************************************Ciclo de generar ficha
}

$nombrearchivo="$na-$abrcole-$datetime.pdf";
$pdf->Output($nombrearchivo,'I');
?>
