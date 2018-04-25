<?php

require '../lib/sesion.php';
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
require_once('../../assets/TCPDF/tcpdf.php');
include '../../assets/datetime.php';
$bloque=d("b");
if ($bloque=="") {
$bloque=$bloqueencurso;
}
//$bloque=1;
class PDF extends TCPDF
{
	public function Footer()
	{
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0,10,"Sistema LIA | Usuario Administrador | "."Pagina ".$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0,0,'C');
	}
	public function Header(){
		$this->Ln(10);
		global $fpshared,$ncole,$ngrado,$sec,$nclase,$idcole,$idusuario,$conexion,$bloque,$idmateria,$idgrado;
		$this->Image("$fpshared",10,8,19,19,'JPG');
		$this->Cell(34,3,'',0);
		$this->Cell(250,8,$ncole,0,0,'C');
		$this->Ln(8);
		$this->Cell(34,3,'',0);
		$this->Cell(250,3,"Registro de Calificaciones ".date('Y'),0,0,'C');
		$this->Ln(6);
		$this->SetFont("Helvetica","B",14);
		$this->Cell(34,3,'',0);
		$this->Cell(250,3,"$ngrado $sec",0,0,'C');
		$this->Ln(8);
		$this->SetFont("times","",11);
		$this->Cell(34,3,'',0);
		$this->Cell(15,10,"Materia: ",0);
		$this->SetFont("times","BI",11);
		$this->Cell(100,10,$nclase,0);
		$this->SetFont("times","",11);
		$this->Cell(17,10,"Profesor: ",0);
		$this->SetFont("times","BI",11);
		$pn="";
		$sqln="SELECT * FROM `profesores` WHERE idcole='$idcole' AND idprofesor='$idusuario' LIMIT 1";
		$queryn=mysqli_query($conexion,$sqln);
		while ($p=mysqli_fetch_array($queryn)) {
			$pn=$p['nombres']." ".$p['apellidos'];
		}
		$this->Cell(120,10,$pn,0);
		$this->Cell(45,10,"Bloque: ".$bloque,0);
		$this->Ln(10);
		$this->SetFont("times","BI",11);
		$this->Cell(12,32," Clave ",1);
		$this->Cell(75,32," Nombre del Alumno ",1);
		$this->SetFont("times","B",10);
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

			$this->Cell($colspan,7,$nombrecategoria,1,0,'C');
		}
		$this->Cell(26,32," Total ",1,0,'C');
		$this->Ln(7);
		$this->Cell(87,18,"",0);
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
			$this->Cell($colspan,5,$pc."%",1,0,'C');
		}
		$this->Ln(5);
		$this->SetFillColor(239, 239, 239);
		$this->Cell(87,20,"",0);
		$this->SetFont("times","",6);
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
			//$this->RotatedText(10,20,substr($nombre,0,8),90);
			//$this->Cell($ac,20,substr($nombre,0,8),1,0,'C');
			//$nb=$this->WordWrap($nombre,120);

			//$this->Cell($ac,20,substr(utf8_decode($nombre), 0, 8),1,0,'C');
			$this->setCellPaddings(1,1,1,1);
			$this->MultiCell($ac, 20, $nombre, 1, 'C', 0, 0, '', '', true);


		}
		$this->Ln(15);
	}
}
//$pdf = new PDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$pdf= new PDF('L','mm','Legal');

$pageLayout = array(355.6, 215.9); //  or array($height, $width)
$pdf = new PDF('L', 'mm', $pageLayout, true, 'UTF-8', false);
// set document information
$pdf->SetCreator("LIA System");
$pdf->SetAuthor('imed/inebco');
$pdf->SetTitle('Cuadro de Registro');
$pdf->SetSubject(' REGISTROS PDF');
//$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);
$pdf->SetMargins(10,74,10,TRUE);

$sqlg="SELECT * FROM `materias` INNER JOIN `grados` ON materias.idgrado=grados.idgrado INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria INNER JOIN `profesores` ON materias.idprofesor=profesores.idprofesor WHERE materias.idcole='$idcole' AND materias.idprofesor='$idusuario' ORDER BY materias.idprofesor ASC ";
$queryg=mysqli_query($conexion,$sqlg);
if ($queryg) {
	while ($a=mysqli_fetch_array($queryg)) {
		$idmateria=$a['idnombremateria'];
		//$bloque=$bloqueencurso;
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
		/**
		* inicio del listado de alumnos
		*/
		$sql="SELECT * FROM `modelocuadro` WHERE idcole='$idcole'";
		$query=mysqli_query($conexion,$sql);
		$anch=220;
		$columns=$query->num_rows;

		$ac=$anch/$columns;
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

						$idactividad=$act['idmodelo'];
						$asesor=0;
						$asesor=$act['asesor'];
						if ($asesor==0) {
							$sqlnotas="SELECT idnota, asignado, obtenido FROM `notas` WHERE idalumno='$idalumno' AND idmateria='$idmateria' AND idbloque='$bloque' AND idmodelo='$idactividad' LIMIT 1";
							$conect=mysqli_query($conexion,$sqlnotas);
							if ($conect) {
								$filas=$conect->num_rows;
								if ($filas==0) {
									$sqlinsert="INSERT INTO `notas`(`idnota`, `idcole`, `idgrado`, `idmateria`, `idbloque`, `idmodelo`, `idalumno`, `asignado`, `obtenido`) VALUES ('','$idcole','$idgrado','$idmateria','$bloque','$idactividad','$idalumno','0','0')";
									$r=mysqli_query($conexion,$sqlinsert);
									if ($r) {
										$conect=mysqli_query($conexion,$sqlnotas);
									}else {
										exit(errorsql($conexion));
									}
								}
								while ($a=mysqli_fetch_array($conect)) {
									$pdf->Cell($ac,5,cero($a['obtenido']),1,0,'C');
									$total+=$a['obtenido'];
								}
							}else {
								echo errorsql($conexion);
							}
						}else {
							$sqlnotas="SELECT idnota, asignado, obtenido FROM `notasasesores` WHERE idalumno='$idalumno' /*AND idmateria='$idmateria'*/ AND idbloque='$bloque' AND idmodelo='$idactividad' LIMIT 1";
							$conect=mysqli_query($conexion,$sqlnotas);
							if ($conect) {
								$filas=$conect->num_rows;
								if ($filas==0) {
									$sqlinsert="INSERT INTO `notasasesores`(`idnota`, `idcole`, `idgrado`, `idbloque`, `idmodelo`, `idalumno`, `asignado`, `obtenido`) VALUES ('','$idcole','$idgrado','$bloque','$idactividad','$idalumno','0','0')";
									$r=mysqli_query($conexion,$sqlinsert);
									if ($r) {
										$conect=mysqli_query($conexion,$sqlnotas);
									}else {
										exit(errorsql($conexion));
									}
								}
								while ($a=mysqli_fetch_array($conect)) {
									$pdf->Cell($ac,5,cero($a['obtenido']),1,0,'C');
									$total+=$a['obtenido'];
								}
							}else {
								echo errorsql($conexion);
							}
						}
				}
				$pdf->Cell(26,5,$total,1,0,'C');
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

$pdf->Output("$abrcole Registros Bloque "."$bloque".".pdf",'D');
?>
