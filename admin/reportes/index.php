<?php

require '../lib/sesion.php';
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
require_once('../../assets/TCPDF/tcpdf.php');
include '../../assets/datetime.php';

class PDF extends TCPDF
{
	public function Footer()
	{
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0,10,"Sistema LIA | www.inmedcoop.com | Usuario Administrador | "."Pagina ".$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0,0,'C');
	}
	public function sHeader(){

	}
}
//$pdf = new PDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$pdf= new PDF('L','mm','Legal');

$pageLayout = array(355.6, 215.9); //  or array($height, $width)
$pdf = new PDF('L', 'mm', $pageLayout, true, 'UTF-8', false);
// set document information
$pdf->SetCreator("LIA System");
$pdf->SetAuthor('www.inmedcoop.com');
$pdf->SetTitle('Cuadro de Registros');
$pdf->SetSubject('IMED REGISTROS PDF');
$pdf->setPrintHeader(false);

$sqlg="SELECT * FROM `materias` INNER JOIN `grados` ON materias.idgrado=grados.idgrado INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria INNER JOIN `profesores` ON materias.idprofesor=profesores.idprofesor WHERE materias.idcole='$idcole' ORDER BY materias.idprofesor ASC";
$queryg=mysqli_query($conexion,$sqlg);
if ($queryg) {
	while ($a=mysqli_fetch_array($queryg)) {
		$idmateria=$a['idnombremateria'];
		$bloque=$bloqueencurso;
		$idusuario=$a['idprofesor'];
		$idgrado=$a['idgrado'];
		$ngrado=$a['boton'];
		$sec=$a['seccion'];
		$nprofe=$a['nombres']." ".$a['apellidos'];
		if ($a['nombreficha']=="") {
			$nclase=$a['nombre'];
		}else {
			$nclase=$a['nombreficha'];
		}

		$pdf->AddPage();

		$pdf->Image("$fpshared",10,8,19,19,'JPG');
		$pdf->Cell(34,3,'',0);
		$pdf->Cell(250,8,'Instituto Mixto de Educación Diversificada por Cooperativa IMED',0,0,'C');
		//$pdf->Cell(50,9,,0,0,'R');
		$pdf->Ln(8);
		$pdf->Cell(34,3,'',0);
		$pdf->Cell(250,3,"Registro de Calificaciones ".date('Y'),0,0,'C');
		$pdf->Ln(6);
		$pdf->SetFont("Helvetica","B",14);
		$pdf->Cell(34,3,'',0);
		$pdf->Cell(250,3,"$ngrado $sec",0,0,'C');
		$pdf->Ln(8);
		$pdf->SetFont("times","",11);
		$pdf->Cell(34,3,'',0);
		$pdf->Cell(15,10,"Materia: ",0);
		$pdf->SetFont("times","BI",11);
		$pdf->Cell(100,10,$nclase,0);
		$pdf->SetFont("times","",11);
		$pdf->Cell(17,10,"Profesor: ",0);
		$pdf->SetFont("times","BI",11);
		$pdf->Cell(100,10,$nprofe,0);
		$pdf->Ln(10);
		/**
		* Inicio del head del cuadro
		*/

		$pdf->SetFont("times","BI",11);
		$pdf->Cell(12,32," Clave ",1);
		$pdf->Cell(75,32," Nombre del Alumno ",1);
		$pdf->SetFont("times","B",10);
		$sql="SELECT * FROM `modelocuadro` WHERE idcole='$idcole'";
		$query=mysqli_query($conexion,$sql);
		$anch=220;
		$columns=$query->num_rows;
		$ac=$anch/$columns;
		$sql="SELECT * FROM `mccategorias` WHERE idcole='$idcole'";
		$query=mysqli_query($conexion,$sql);
		while ($a=mysqli_fetch_array($query)) {
			$idcate="";
			$colspan=0;
			$idcate=$a['idmccategorias'];
			$nombrecategoria=$a['nombre'];
			$sql2="SELECT * FROM `modelocuadro` WHERE idmccategorias='$idcate'";
			$query2=mysqli_query($conexion,$sql2);
			$colspan=$query2->num_rows*$ac;

			$pdf->Cell($colspan,7,$nombrecategoria,1,0,'C');
		}
		$pdf->Cell(26,32," Total ",1,0,'C');
		$pdf->Ln(7);
		/**
		* inicio del porcentaje de los saberes
		*/
		$pdf->Cell(87,18,"",0);
		$sql="SELECT * FROM `mccategorias` WHERE idcole='$idcole'";
		$query=mysqli_query($conexion,$sql);
		while ($a=mysqli_fetch_array($query)) {
			$idcate="";
			$colspan=0;
			$idcate=$a['idmccategorias'];
			$pc=$a['porcentaje'];
			$sql2="SELECT * FROM `modelocuadro` WHERE idmccategorias='$idcate'";
			$query2=mysqli_query($conexion,$sql2);
			$colspan=$query2->num_rows*$ac;
			$pdf->Cell($colspan,5,$pc."%",1,0,'C');
		}
		$pdf->Ln(5);
		$pdf->SetFillColor(239, 239, 239);
		$pdf->Cell(87,20,"",0);
		$pdf->SetFont("times","",6);
		$sql="SELECT * FROM `modelocuadro` WHERE idcole='$idcole' ORDER BY orden ASC";
		$query=mysqli_query($conexion,$sql);
		if (!$query) {
			errorsql($conexion);
		}
		while ($a=mysqli_fetch_array($query)) {
			$nombre=$a['nombre'];
			$idmodelo=$a['idmodelo'];
			$asesor=$a['asesor'];
			if ($asesor==0) {
				$sqlna="SELECT * FROM `nombreactividades` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' AND idbloque='$bloque' AND idactividad='$idmodelo' AND idmateria='$idmateria' LIMIT 1";
				$queryna=mysqli_query($conexion,$sqlna);
				if ($queryna->num_rows>0) {
					while ($c=mysqli_fetch_array($queryna)) {
						$nombre=$c['nombre'];
					}
				}
			}else {
				$sqlna="SELECT * FROM `nombreactividades` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' AND idbloque='$bloque' AND idactividad='$idmodelo' LIMIT 1";
				$queryna=mysqli_query($conexion,$sqlna);
				if ($queryna->num_rows>0) {
					while ($c=mysqli_fetch_array($queryna)) {
						$nombre=$c['nombre'];
					}
				}
			}
			$renombrar=$a['renombrar'];
			if ($renombrar==1 || $asesor==1) {
				$nombre="";
			}
			$pdf->MultiCell($ac, 20, $nombre, 1, 'C', 0, 0, '', '', true);
		}
		$pdf->Ln(20);
		/**
		* inicio del listado de alumnos
		*/
		$sql="SELECT clave, idalumno, CONCAT (apellidos,', ', nombres) as nombre FROM `alumnos` WHERE idcole='$idcole' AND idgrado='$idgrado' AND seccion='$sec' ORDER BY clave ASC";
		$datos=array();
		$resultado = mysqli_query($conexion,$sql);
		if ($resultado) {
			while( $data = mysqli_fetch_array($resultado)){
				$clave=$data['clave'];
				$idalumno=$data['idalumno'];
				$nombre=$data['nombre'];
				$row="";
				$total=0;
				$pdf->SetFont("times","",10);
				$pdf->Cell(12,5,$clave,1,0,'L');
				$pdf->Cell(75,5,$nombre,1,0,'L');
				$sqlactividades="SELECT * FROM `modelocuadro` WHERE idcole='$idcole' ORDER BY orden ASC";
				$queryactividades=mysqli_query($conexion,$sqlactividades);
				while ($act=mysqli_fetch_array($queryactividades)) {
					$pdf->Cell($ac,5,"",1,0,'C');
				}
				$pdf->Cell(26,5,"",1,0,'C');
				$pdf->Ln(5);
			}
		}else {
			echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
		}

	}
}else {
	errorsql($conexion);
}


//$pdf->setPrintFooter(false);



//******************************************************

$pdf->Output("IMED Bloque "."$bloque - $ngrado $sec - $nclase".".pdf",'I');
?>
