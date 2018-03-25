<?php

require '../lib/sesion.php';
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
require_once('../../assets/TCPDF/tcpdf.php');
include '../../assets/datetime.php';
$val=d("lk");
//$val="1-1-1-A";
if ($val==0 || $val=="") {
	exit('<div class="">
	<div class="text-center">
	<br>
	<img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
	<h3 class="text-muted">Error!</h3>
	<div id="icon">
	<h5 class="text-muted">Se produjo un error al cargar el cuadro <br> Error No: 0x0000001 </h5>
	</div>
	</div>
	</div>');
}
if ($val=="Grado") {
	exit('<div class="">
	<div class="text-center">
	<br>
	<img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
	<h3 class="text-muted">Error!</h3>
	<div id="icon">
	<h5 class="text-muted">Se produjo un error al cargar el cuadro <br> Error No: 0x0000001 </h5>
	</div>
	</div>
	</div>');
}
$v=explode("-",$val);

if (!array_key_exists(0,$v) || !array_key_exists(1,$v) || !array_key_exists(2,$v) || !array_key_exists(3,$v)) {
	exit('<div class="">
	<div class="text-center">
	<br>
	<img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
	<h3 class="text-muted">Error</h3>
	<div id="icon">
	<h5 class="text-muted">Parece que ha habido un error al cargar el cuadro<br>Codigo de error: 0x0003 tablacuadro.php</h5><br>
	</div>
	<div class="form-group">
	<button type="button" class="btn btn-outline-success btn-change" name="button">Selecionar Cuadro</button>
	</div>
	</div>
	</div>');
}
$idmateria=$v[0];
$bloque=$v[1];
$idgrado=$v[2];
$sec=$v[3];
if ($bloque>$bloqueencurso) {
	exit('<div class="">
	<div class="text-center">
	<br>
	<img src="../../assets/images/nodatafound.png" width="80" height="auto" alt=""><br>
	<h3 class="text-muted">Bloque No Habilitado</h3>
	<div id="icon">
	<h5 class="text-muted">El bloque '.$bloque.' aún no ha sido habilitado para ingreso de calificaciones<br>Por favor selecione otro bloque</h5><br>
	</div>
	<div class="form-group">
	<button type="button" class="btn btn-outline-success btn-change" name="button">Selecionar Cuadro</button>
	</div>
	</div>
	</div>');
}
$ssqqll="SELECT * FROM `materias` INNER JOIN `grados` ON materias.idgrado=grados.idgrado INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria WHERE materias.idcole='$idcole' AND materias.idgrado='$idgrado' AND materias.seccion='$sec' AND materias.idnombremateria='$idmateria' AND materias.idprofesor='$idusuario' LIMIT 1";
$qquery=mysqli_query($conexion,$ssqqll);
if ($qquery->num_rows==0) {
	exit('<div class="">
	<div class="text-center">
	<br>
	<img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
	<h3 class="text-muted">Accesso No Autorizado</h3>
	<div id="icon">
	<h5 class="text-muted">No tienes acceso a este cuadro de  calificaciones <br> selecciona otro cuadro</h5>
	</div>
	<div class="form-group">
	<button type="button" class="btn btn-outline-success btn-change" name="button">Selecionar Cuadro</button>
	</div>
	</div>
	</div>');
}else {
	while ($e=mysqli_fetch_array($qquery)) {
		$nclase=$e['nombreficha'];
		$ngrado=$e['boton'];
		if ($nclase=="") {
			$nclase=$e['nombre'];
		}
	}
}

class PDF extends TCPDF{
	public function Footer(){
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0,10,"Sistema LIA | Usuario Profesor | "."Pagina ".$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0,0,'C');
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
		$this->Cell(45,10,"Página: ".$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0);
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
$pdf->AddPage();
$pdf->SetAutoPageBreak(TRUE,PDF_MARGIN_BOTTOM);
//$pdf->headcuadro();
//$pdf->Ln(75);
//******************************************************
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


//******************************************************

$pdf->Output("IMED Bloque "."$bloque - $ngrado $sec - $nclase".".pdf",'I');
?>
