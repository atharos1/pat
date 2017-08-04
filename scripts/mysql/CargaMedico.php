<?php
	require_once('../VerificarLogin.php');

	$ID = $_GET['ID'];
	
	$strSQL = "Select 
	Apellido, Nombre, Matricula,
			Domicilio, Telefono, Email   
            FROM Medicos 
            WHERE ID = $ID";

	require("conexion.php");

	$query = mysqli_query($conn, $strSQL);

	if (!$query) {
		echo 'MySQL Error: ' . mysqli_error($conn);
		die;
	}
		
	$dataArray = array();
	$row = mysqli_fetch_assoc($query);

	echo json_encode($row);