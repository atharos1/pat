<?php

require_once('../VerificarLogin.php');

$FechaDesde = $_GET['FechaDesde'];
$FechaHasta = $_GET['FechaHasta'];

$strSQL = "SELECT 
    p.ID, 
	CONCAT(pac.Apellido, ', ', pac.Nombre) as Paciente, pre.Nombre as 'Prepaga', pac.NumPrepaga as 'NumPrepaga',
	CONCAT(m.Apellido, ', ', m.Nombre) as Medico, m.Matricula as Matricula, 
	h.Nombre as Hospital, 
	par.Nombre as 'Localizacion',
	DATE_FORMAT(p.FechaOrden, '%d/%m/%Y') as FechaOrden, 
    DATE_FORMAT(p.Cuando, '%d/%m/%Y') as Cuando, 
	DiagPatol.Nombre as 'DiagPatol1', 
    Imagenes 

	FROM Protocolos p 
	LEFT JOIN Pacientes pac On pac.Id = p.PacienteID 
	LEFT JOIN Medicos m On m.Id = p.MedicoID 
	LEFT JOIN Hospitales h On h.Id = p.HospitalID 
	LEFT JOIN Prepagas pre On pre.Id = pac.Prepaga 
    LEFT JOIN Partes par ON par.ID = p.Localizacion 
    Left Join DiagPatol On DiagPatol.ID = p.Tumor1 

	WHERE p.Cuando BETWEEN STR_TO_DATE('$FechaDesde', '%d/%m/%Y') AND STR_TO_DATE('$FechaHasta', '%d/%m/%Y') 
    ORDER BY ID";

require("conexion.php");

$query = mysqli_query($conn, $strSQL);

if (!$query) {
	echo 'MySQL Error: ' . mysqli_error($conn);
	die;
}	

// Camino a los include
set_include_path('../../vendors/PHPExcel/Classes/');
// PHPExcel
require_once 'PHPExcel.php';
// PHPExcel_IOFactory
include 'PHPExcel/IOFactory.php';
// Creamos un objeto PHPExcel
$objPHPExcel = new PHPExcel();
// Leemos un archivo Excel 2007
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("../../Templates/Protocolos.xls");

// Indicamos que se pare en la hoja uno del libro
$objPHPExcel->setActiveSheetIndex(0);
//Escribimos en la hoja en la celda B1

    $i = 2;
    while($row = mysqli_fetch_array($query)){

        $strSQL = "select count(*) as Cant from matenv where Material = 1 and ProtocoloID = $row[ID]";
        $querymat = mysqli_query($conn, $strSQL);
        $mat = mysqli_fetch_array($querymat);

        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $row["Cuando"]);
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $row["ID"]);
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $row["Medico"]);
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $row["Matricula"]);
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $row["Paciente"]);
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $row["Prepaga"]);
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $row["NumPrepaga"]);
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $row["Hospital"]);
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $row["Localizacion"]);
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, $row["DiagPatol1"]);

        if( $row["Imagenes"] == 1 or $mat["Cant"] != 0 ) {
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, "Sí");
        } else {
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, "No");
        }

        $i++;
    }

/*
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'Hola mundo');
// Color rojo al texto
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
// Texto alineado a la derecha
$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
// Damos un borde a la celda
$objPHPExcel->getActiveSheet()->getStyle('B2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);*/
//Guardamos el archivo en formato Excel 2007
//Si queremos trabajar con Excel 2003, basta cambiar el 'Excel2007' por 'Excel5' y el nombre del archivo de salida cambiar su formato por '.xls'
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"Protocolos.xls\"");
header("Cache-Control: max-age=0");

ob_clean();

// Write file to the browser
$objWriter->save('php://output');

//$objWriter->save("Archivo_salida.xls");