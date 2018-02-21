<?php


require_once 'PHPExcel.php';
$objPHPExcel = new PHPExcel();


$objPHPExcel->
getProperties()
->setCreator("LIA SISTEM")
->setLastModifiedBy("www.inebco.com")
->setTitle("Listado de alumnos")
->setSubject("Listado de Grados y Secciones")
->setDescription("Listado de Grados y Secciones")
->setKeywords("LIA SYSTEM WWW.INEBCO.COM")
->setCategory("reportes");



$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Nombre')
->setCellValue('B1', 'E-mail')
->setCellValue('C1', 'Twitter')
->setCellValue('A2', 'David')
->setCellValue('B2', 'dvd@gmail.com')
->setCellValue('C2', '@davidvd');

$objPHPExcel->getActiveSheet()->setTitle('Usuarios');
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: <span id="IL_AD1" class="IL_AD">attachment</span>;<span id="IL_AD5" class="IL_AD">filename</span>="01simple.xls"');
header('Cache-Control: max-age=0');

$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('Hola.xlsx');
exit;
exit;
?>
