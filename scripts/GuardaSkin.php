<?php
	require_once('VerificarLogin.php');
	
	require('mysql/conexion.php');

	$Respuesta = [];
	$data = json_decode(file_get_contents('php://input'), true);

		$strSQL = "UPDATE Usuarios SET Skin =  '$data[Skin]'	WHERE ID = " . $_SESSION['UsuarioID'];

		if (mysqli_query($conn, $strSQL)) { 
			$Respuesta['Codigo'] = 1;
			$_SESSION['Skin'] = $data["Skin"];
		} else {
			$Respuesta['Codigo'] = 10;
            $Respuesta['Mensaje'] =  'MySQL Error: ' . mysqli_error($conn);
			return;
		}

	echo json_encode($Respuesta);