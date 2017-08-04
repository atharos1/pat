<?php

	require_once('../VerificarLogin.php');

	$ID = $_GET['ID'];
	
	$strSQL = "SELECT m.Apellido as 'ApellidoMedico', m.Email as 'MailMedico', h.Email as 'MailHospital', h.Nombre as 'NombreHospital', 
	p.MailSend 
    FROM Protocolos p 
    LEFT JOIN Medicos m ON m.ID = p.MedicoID 
    LEFT JOIN Hospitales h ON h.ID = p.HospitalID 
    WHERE p.ID = $ID";

	require("conexion.php");

	$query = mysqli_query($conn, $strSQL);

	if (!$query) {
		echo 'MySQL Error: ' . mysqli_error($conn);
		die;
	}
		
	$row = mysqli_fetch_assoc($query);

	echo json_encode($row);