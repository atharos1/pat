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

		$strSQL = "INSERT INTO Hospitales (
			Nombre, Telefono, Direccion, Sector, 
			AgregadoPor
			) VALUES (
			$data[Nombre], $data[Telefono], $data[Direccion], $data[Sector], 
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

		$strSQL = "UPDATE Hospitales SET 
			Nombre =  $data[Nombre], Telefono = $data[Telefono], Direccion = $data[Direccion],
			Sector = $data[Sector] 
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