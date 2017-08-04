<?php
	require_once('../VerificarLogin.php');

	$ProtocoloID = $_GET['ID'];
	
	$strSQL = "SELECT p.ID, 
	p.PacienteID, CONCAT(pac.Apellido, ', ', pac.Nombre) as Paciente, obra.Nombre as 'Prepaga', 
	CASE WHEN pac.Edad = '0' THEN CONCAT(DATE_FORMAT(pac.Nacimiento, '%d/%m/%Y'), ' (',  TIMESTAMPDIFF(YEAR,pac.Nacimiento,CURDATE()), ' años)') ELSE CONCAT('Desconocida (', pac.Edad, ' años)') END as 'Nacimiento',  
	p.MedicoID, CONCAT(m.Apellido, ', ', m.Nombre) as Medico, 
	p.HospitalID, h.Nombre as Hospital, 
	p.TipoTumor, p.Localizacion, p.LocHueso, p.Lado, 
	d1.Nombre as 'Tumor1', p.Tumor1 as 'Tumor1ID', p.Tumor1Duda, d2.Nombre as 'Tumor2', p.Tumor2 as 'Tumor2ID', p.Tumor2Duda, 
	p.DiagnosticoClinico as 'HistorialClinico', p.DiagPresuntivo as 'DiagnosticoPresuntivo', 
	DATE_FORMAT(p.FechaOrden, '%d/%m/%Y') as FechaOrden, DATE_FORMAT(p.Cuando, '%d/%m/%Y') as FechaIngreso, 
	p.Informe1 as 'InformePrincipal', p.Informe2 as 'InformeComplementario',
	p.Imagenes as 'Imagenes', p.ImagenesObs as 'ImagenesObs', 
	Estado 

	FROM Protocolos p 
	LEFT JOIN Pacientes pac On pac.Id = p.PacienteID 
	LEFT JOIN Medicos m On m.Id = p.MedicoID 
	LEFT JOIN Hospitales h On h.Id = p.HospitalID 
	LEFT JOIN DiagPatol d1 On d1.Id = p.Tumor1 
	LEFT JOIN DiagPatol d2 On d2.Id = p.Tumor2 
	Left Join Prepagas obra ON pac.Prepaga = obra.ID 

	WHERE p.ID = $ProtocoloID";

	require("conexion.php");

	$query = mysqli_query($conn, $strSQL);

	if (!$query) {
		echo 'MySQL Error: ' . mysqli_error($conn);
		die;
	}
		
	$dataArray = array();
	$protAnteriores = array();
	$row = mysqli_fetch_assoc($query);

	$strSQL = "Select 
	ID, 
	Material as 'MaterialID', 
	FijadoEn as 'FijadoEnID', 
	ObtenidoPor as 'ObtenidoPorID', 
	CASE WHEN Material = 0 Then '' WHEN Material = 1 Then 'Taco' 
	WHEN Material = 2 Then 'Frasco' 
	WHEN Material = 3 Then 'Preparado histológico' 
	WHEN Material = 4 Then 'Imágenes' 
	WHEN Material = 5 Then 'Frotis' 
	WHEN Material = 6 Then 'Tubo' 
	WHEN Material = 7 Then 'Sachet' END as 'Material',
	Cantidad, 
	CASE WHEN FijadoEn = 0 Then '' WHEN FijadoEn = 1 Then 'Sin fijar' 
	WHEN FijadoEn = 2 Then 'Solución fisiológica' 
	WHEN FijadoEn = 3 Then 'Formol' 
	WHEN FijadoEn = 4 Then 'Alcohol' 
	WHEN FijadoEn = 5 Then 'Bouin' END as 'FijadoEn', 
	CASE WHEN ObtenidoPor = 0 Then '' WHEN ObtenidoPor = 1 Then 'Intraoperatoria' 
	WHEN ObtenidoPor = 2 Then 'Necrosis tumoral' 
	WHEN ObtenidoPor = 3 Then 'Punción' 
	WHEN ObtenidoPor = 4 Then 'Quirúrgica' END as 'ObtenidoPor',
	Contenido,
	Obs 
	From MatEnv Where ProtocoloID = $ProtocoloID And Estado = 0";

	$query = mysqli_query($conn, $strSQL);

	if (!$query) {
		echo 'MySQL Error: ' . mysqli_error($conn);
		die;
	}

	$i = 0;
	while($fila = mysqli_fetch_array($query)){
		$dataArray[$i] = array();
		$dataArray[$i] = $fila;
		$i++;
	}

	$row['MatEnv'] = $dataArray;


	$strSQL = "Select ID From Protocolos WHERE PacienteID = $row[PacienteID] AND Id <> $ProtocoloID";

	$query = mysqli_query($conn, $strSQL);

	if (!$query) {
		echo 'MySQL Error: ' . mysqli_error($conn);
		die;
	}

	$i = 0;
	while($fila = mysqli_fetch_array($query)){
		$protAnteriores[$i] = $fila["ID"];
		$i++;
	}

	$row["protAnteriores"] = $protAnteriores;

	echo json_encode($row);