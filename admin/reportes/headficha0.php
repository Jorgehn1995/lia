<?php
//$pdf->Image("images/logoinebco.jpg",10,8,15,19,'JPG');
//$pdf->Image("images/logoescudo.jpg",180,8,19,19,'JPG');
$pdf->Image("images/logoinebco.jpg",184,8,11,15,'JPG');
//$pdf->Cell(34,8,'',0);
$pdf->SetFont("Helvetica","",12);
$pdf->Cell(120,8,utf8_decode('INEBCO'),0,0,'');

$pdf->Ln(6);
$pdf->Cell(120,8,utf8_decode('Instituto de Educación Básica por Cooperativa - INEBCO'),0,0,'');
$pdf->SetFont("Helvetica","",8);
$pdf->Cell(120,7,'San Luis Jilotepeque, Jalapa. Guatemala, Guatemala.',0,0,'');
$pdf->Ln(5);

$pdf->Cell(120,7,'Sabado 27 de Febrero de 2018',0,0,'');
$pdf->Ln(13);
$pdf->SetFont("Helvetica","B",8);
$pdf->Cell(28,7,'Tipo de Reporte: ',0,0,'');
$pdf->SetFont("Helvetica","",8);
$pdf->Cell(25,7,'Por Fecha',0,0,'');
$pdf->Ln(7);
$pdf->SetFont("Helvetica","B",8);
$pdf->Cell(33,7,'Contenido de Reporte: ',0,0,'');
$pdf->SetFont("Helvetica","",8);
$pdf->Cell(25,7,'Fecha de reporte',0,0,'');

//$pdf->Cell(34,6,'',0);

$pdf->Ln(9);
$pdf->SetFont("Helvetica","B",8);
//$pdf->Ln(8);

 ?>
