<?php
	require_once('../VerificarLogin.php');
	
	include('../../vendors/fpdf/fpdf.php');
	include('../../vendors/fpdi/fpdi.php'); 

	

	$ProtocoloID = $_GET["Protocolo"];

	include("conexion.php");

	if($ProtocoloID >= 85759) { //Protocolo nuevo
		$strSQL = "Select DATE_FORMAT(pro.FechaCierre,'%d/%m/%Y') as 'Fecha',
		UPPER(m.Apellido) as 'MedicoApellido', m.Nombre as 'MedicoNombre', 
		UPPER(p.Apellido) as 'Apellido', p.Nombre as 'Nombre', 
		pro.Informe1, 
		pa1.Nombre as 'Localizacion', 
		pa2.Nombre as 'LocHueso', 
		CASE pro.Lado WHEN 0 Then NULL WHEN 1 Then 'izquierdo' WHEN 2 Then 'derecho' END as Lado 
		FROM Protocolos pro 
		LEFT Join Pacientes p On p.ID = pro.PacienteID 
		LEFT Join Medicos m On m.ID = pro.MedicoID 
		Left Join Partes pa1 On pa1.ID = pro.Localizacion 
		Left Join Partes pa2 On pa2.ID = pro.LocHueso 
		WHERE pro.ID = $ProtocoloID";
	} else { //Protocolo viejo
		$strSQL = "Select DATE_FORMAT(pro.FechaBiopsia,'%d/%m/%Y') as 'Fecha', CONCAT(m.Apellido, ', ', m.Nombre) as 'Medico', CONCAT(p.Apellido, ', ', p.Nombre) as 'AyN', pro.InformePrincipal as 'Informe1' 
			FROM v_Protocolos pro Inner Join v_Pacientes p On p.ID = pro.IDPaciente Inner Join v_Medicos m On m.ID = pro.IDMedico WHERE pro.IDProtocolo = $ProtocoloID";
	}

	$query = mysqli_query($conn, $strSQL);
	if (!$query) {
		echo 'MySQL Error: ' . mysqli_error($conn);
		die;
	}
					
	$row = mysqli_fetch_assoc($query);

	$PacNombre = $row["Nombre"];
	$PacApellido = $row["Apellido"];
	$MedicoNombre = $row["MedicoNombre"];
	$MedicoApellido = $row["MedicoApellido"];
	$Informe1 = $row["Informe1"];
	$Fecha = $row["Fecha"];
	$Localizacion = $row["Localizacion"];
	if( $row["LocHueso"] ) $Localizacion = $Localizacion . ", " . $row["LocHueso"];
	if( $row["Lado"] ) $Localizacion = $Localizacion . ", lado " . $row["Lado"];

	// initiate FPDI 
	$pdf =& new FPDI(); 
	// add a page 
	$pdf->AddPage(); 
	// set the sourcefile 
	$pdf->setSourceFile('../../Templates/informe.pdf'); 
	// import page 1 
	$tplIdx = $pdf->importPage(1); 
	// use the imported page as the template 
	$pdf->useTemplate($tplIdx, 0, 0); 

	// now write some text above the imported page 
	$pdf->SetFont('times'); 
	$pdf->SetTextColor(0,0,0); 

	$y = 55;

	$pdf->SetXY(20, $y); 
	$pdf->Write(0, utf8_decode("Sr. /a: " . $PacApellido . ", " . $PacNombre . ".")); 

	$y = $y + 5;

	$pdf->SetXY(20, $y); 
	$pdf->Write(0, utf8_decode("Protocolo Nº: " . $ProtocoloID . ".")); 

	$y = $y + 5;

	$pdf->SetXY(20, $y); 
	$pdf->Write(0, utf8_decode("Localización: " . $Localizacion . ".")); 

	$y = $y + 5;
/*
	$strSQL = "Select 
		ID, 
		Material as 'TipoMaterialID', 
		FijadoEn as 'FijadoEnID', 
		ObtenidoPor as 'ObtenidoPorID', 
		CASE WHEN Material = 1 Then 'Taco' 
		WHEN Material = 2 Then 'Frasco' 
		WHEN Material = 3 Then 'Preparado histológico' 
		WHEN Material = 4 Then 'Imágenes' 
		WHEN Material = 5 Then 'Frotis'
		WHEN Material = 6 Then 'Tubo'
		WHEN Material = 7 Then 'Sachet' END as 'TipoMaterial',
		Cantidad, 
		CASE WHEN FijadoEn = 1 Then 'Sin fijar' 
		WHEN FijadoEn = 2 Then 'Solución fisiológica' 
		WHEN FijadoEn = 3 Then 'Formol' 
		WHEN FijadoEn = 4 Then 'Alcohol' 
		WHEN FijadoEn = 5 Then 'Bouin' END as 'FijadoEn', 
		CASE WHEN ObtenidoPor = 1 Then 'Intraoperatoria' 
		WHEN ObtenidoPor = 2 Then 'Necrosis tumoral' 
		WHEN ObtenidoPor = 3 Then 'Punción' 
		WHEN ObtenidoPor = 4 Then 'Quirúrgica' END as 'ObtenidoPor',
		Contenido 
		From MatEnv Where ProtocoloID = $ProtocoloID And Estado = 0";

	$query = mysqli_query($conn, $strSQL);
	if (!$query) {
				echo 'MySQL Error: ' . mysqli_error($conn);
				//die;
			}
	$i = 0;
	while($row = mysqli_fetch_array($query)){
		$pdf->SetXY(40, $y); 
		$pdf->Write(0, utf8_decode($row["TipoMaterial"])); 
		
		$pdf->SetXY(40 + 23, $y); 
		$pdf->Write(0, $row["Cantidad"]); 
		
		$pdf->SetXY(40 + 46, $y); 
		$pdf->Write(0, utf8_decode($row["FijadoEn"])); 
		
		$pdf->SetXY(40 + 94, $y); 
		$pdf->Write(0, utf8_decode($row["ObtenidoPor"])); 
		
		$pdf->SetXY(40 + 132, $y); 
		$pdf->Write(0, utf8_decode($row["Contenido"])); 

		$y = $y + 5;
	}*/

	/*$pdf->SetXY(20, $y); 
	$pdf->Write(0, utf8_decode("Material recibido: " . $Medico . ".")); 

	$y = $y + 5;*/

	/*$xFirma = 140;
	$yFirma = 220;
	$pdf->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World',$xFirma,$yFirma,60,0,'PNG');
	$xFirma = $xFirma - 60;
	$pdf->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World',$xFirma,$yFirma,60,0,'PNG');*/

	$pdf->SetXY(20, $y); 
	$pdf->Write(0, utf8_decode("A indicación del Dr./a: " . $MedicoApellido . ", " . $MedicoNombre . ".")); 

	$y = $y + 5;

	$pdf->SetXY(20, $y); 
	$pdf->Write(0, utf8_decode("Fecha: " . $Fecha . ".")); 

	$y = $y + 20;

	$pdf->SetXY(75, $y); 
	$pdf->SetFont('times', 'B');
	$pdf->Write(0, "INFORME ANATOMOPATOLOGICO"); 

	$y = $y + 20;

	$pdf->SetFont('times');
	$pdf->SetXY(20, $y); 
	$pdf->MultiCell(0, 5, utf8_decode($Informe1), 0);

	$pdf->SetTitle('Informe (Protocolo #' . $ProtocoloID . ')');

	ob_end_clean();

	$data = json_decode(file_get_contents('php://input'), true);
	if( isset( $data[0] ) ) {

		$pdf->Output($ProtocoloID . '.pdf', 'F'); 

		$destino = array();
		$destino = $data;

		$file = "../mysql/$ProtocoloID.pdf";

		include("../PHPMailer/sendinforme.php");

		unlink("../mysql/$ProtocoloID.pdf");

		if( $Respuesta["Codigo"] == 1 ) {//Todo OK

			$strSQL = "SELECT MailSend FROM Protocolos WHERE ID = $ProtocoloID";
			$query = mysqli_query($conn, $strSQL);
			if (!$query) {
				echo 'MySQL Error: ' . mysqli_error($conn);
				die;
			}
							
			$resultados = mysqli_fetch_assoc($query);

			$long = count($destino);
			$cadena = $resultados["MailSend"];
			for($i = 0; $i < $long; $i++) {
				if (!stristr($cadena, $destino[$i]["correo"])) $cadena .= $destino[$i]["correo"] . "; ";
			}

			$strSQL = "UPDATE Protocolos SET 
			MailSend = '$cadena' 
			WHERE ID = " . $ProtocoloID;

			if (mysqli_query($conn, $strSQL)) { 
				$Respuesta['Codigo'] = 1;
				$Respuesta['Mensaje'] = 1;
			} else {
				$Respuesta['Codigo'] = 10;
				$Respuesta['Mensaje'] =  'MySQL Error: ' . mysqli_error($conn);
				echo json_encode($Respuesta); return;
			}
		}

		echo json_encode($Respuesta);

	} else {
		$pdf->Output('Protocolo ' . $ProtocoloID . '.pdf', 'I'); 
	}

?>