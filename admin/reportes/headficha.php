<?php



//SEGUNDA LINEA DE ENCABEZADO
$pdf->SetFont("Helvetica","B",10);
$pdf->Cell(100,6,utf8_decode('INEBCO'),0,0,'');
$pdf->Cell(15,7,'',0);
$pdf->SetFont("Helvetica","B",8);
$pdf->Cell(33,7,'Tipo de Datos: ',0,0,'');
$pdf->SetFont("Helvetica","",8);
$pdf->Cell(42,7,"%%Tipodatos",0,0,'R');
$pdf->SetFont("Helvetica","",8);
$pdf->Ln(6);
$pdf->Cell(100,4,utf8_decode('Instituto de Educación Básica Por Cooperativa'),0,0,'');
$pdf->Cell(15,7,'',0);
$pdf->SetFont("Helvetica","B",8);
$pdf->Cell(33,7,'Resumen de Datos: ',0,0,'');
$pdf->SetFont("Helvetica","",8);
$pdf->Cell(42,7,"%%",0,0,'R');
$pdf->SetFont("Helvetica","",8);
$pdf->Ln(4);
$pdf->Cell(100,4,utf8_decode("")."%%fecha_larga",0,0,'');
$pdf->Cell(15,7,'',0);
$pdf->SetFont("Helvetica","B",8);
$pdf->Cell(33,12,'Usuario de LIA: ',0,0,'');
$pdf->SetFont("Helvetica","",8);
$pdf->Cell(42,12,"%%usuario",0,0,'R');
$pdf->SetFont("Helvetica","",8);
$pdf->Ln(4);
//$pdf->SetTextColor(150,150,150);
$pdf->Cell(100,4,utf8_decode('San Luis Jilotepeque, Jalapa. Guatemala.'),0,0,'');

//$pdf->SetTextColor(70,70,70);

//$pdf->Ln(7);

//$pdf->Cell(34,6,'',0);

$pdf->Ln(10);
$pdf->SetFont("Helvetica","B",8);
//$pdf->Ln(8);

 ?>
