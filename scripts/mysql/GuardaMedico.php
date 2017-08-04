<?php
	require_once('../VerificarLogin.php');
	
	require('conexion.php');


	$Respuesta = [];
	$data = json_decode(file_get_contents('php://input'), true);

	$ID = $data["ID"];

	$data = array_map(function($value) {
    	if ( is_array( $value ) == false ) return "'" . $value . "'";
	}, $data);

	if( $ID == 0 ) { //Nueva

		$strSQL = "INSERT INTO Medicos (
			Apellido, Nombre, Matricula,
			Domicilio, Telefono, Email,
			AgregadoPor
			) VALUES (
			$data[Apellido], $data[Nombre], $data[Matricula],
			$data[Domicilio], $data[Telefono], $data[Email], 
			$_SESSION[UsuarioID]
		)";

		if (mysqli_query($conn, $strSQL)) {
 			$ID = mysqli_insert_id($conn);
 			
			$Respuesta['Codigo'] = 1;
			$Respuesta['Mensaje'] = $ID;
		} else {
			$Respuesta['Codigo'] = 10;
            $Respuesta['Mensaje'] =  'MySQL Error: ' . mysqli_error($conn);
			echo json_encode($Respuesta); return;
		}
			
	} else { //Existente

		$strSQL = "UPDATE Medicos SET 
			Apellido =  $data[Apellido], Nombre = $data[Nombre], Matricula = $data[Matricula],
			Domicilio = $data[Domicilio], Telefono = $data[Telefono], Email = $data[Email] 
			WHERE ID = " . $data['ID'];

		if (mysqli_query($conn, $strSQL)) { 
			$Respuesta['Codigo'] = 1;
			$Respuesta['Mensaje'] = $ID;
		} else {
			$Respuesta['Codigo'] = 10;
            $Respuesta['Mensaje'] =  'MySQL Error: ' . mysqli_error($conn);
			echo json_encode($Respuesta); return;
		}

	}

	echo json_encode($Respuesta);