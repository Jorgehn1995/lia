<?php
require_once 'PHPExcel.php';
// PHPExcel_IOFactory
include 'PHPExcel/IOFactory.php';
// Creamos un objeto PHPExcel
$objPHPExcel = new PHPExcel();
// Leemos un archivo Excel 2007
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("plantillalistados.xlsx");
// Indicamos que se pare en la hoja uno del libro
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Listado de Alumnos');
$sheet = $objPHPExcel->getActiveSheet();


require '../lib/sesion.php';

$idcole=$_SESSION["idcole"];
include('../../conexion/conexion.php');
$sql="SELECT * FROM `grados` WHERE idcole='$idcole'";
$query=mysqli_query($conexion,$sql);
$cel=6;
while ($a=mysqli_fetch_array($query)) {
  $idgrado=$a['idgrado'];
  for ($i=1; $i <=5 ; $i++) {
    $n="sec".$i;
    $sec=$a[$n];
    if ($sec!="") {
      //echo "$idgrado - $n <br>";
      $sentencia = "SELECT * FROM `alumnos` INNER JOIN `grados` ON alumnos.idgrado=grados.idgrado WHERE alumnos.idcole='$idcole' AND alumnos.idgrado='$idgrado' ORDER BY alumnos.apellidos ASC";
      $resultado = mysqli_query($conexion,$sentencia);
      if (!$resultado) {
        errorsql($conexion);
      }

      while ($datos=mysqli_fetch_array($resultado)) {
        $cel+=1;
        //Escribimos en la hoja en la celda B1
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$cel, $datos['boton']);
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$cel, $datos['seccion']);
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$cel, $datos['clave']);
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$cel, $datos['apellidos'].", ".$datos['nombres']);
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$cel, $datos['codigo']);
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$cel, (date("Y-m-d")-$datos['nacimiento'])." Años");
        // Color rojo al texto
        //$objPHPExcel->getActiveSheet()->getStyle('D'.$cel)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
        // Texto alineado a la derecha
        //$objPHPExcel->getActiveSheet()->getStyle('D'.$cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        // Damos un borde a la celda
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$cel.':'.'H'.$cel)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
        $styleArray = array(
          'borders' => array(
            'top' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
            'left' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
            'right' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
            'bottom' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
          ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('A'.$cel)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$cel)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$cel)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$cel)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$cel)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$cel)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$cel)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$cel)->applyFromArray($styleArray);

        //$objPHPExcel->getActiveSheet()->getStyle('D'.$cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        //$objPHPExcel->getActiveSheet()->getStyle('D'.$cel)->getFill()->getStartColor()->setARGB('FFFF0000');
      }
    }
  }
}
/////**********************************************************

include('../../conexion/cerrar_conexion.php');
$filename = "alumnos-". date("Y-m-d-H-i-s").".xlsx";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
//Guardamos el archivo en formato Excel 2007
//Si queremos trabajar con Excel 2003, basta cambiar el 'Excel2007' por 'Excel5' y el nombre del archivo de salida cambiar su formato por '.xls'
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($filename);
unlink($filename);
?>
