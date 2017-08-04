<?php
	require_once('../VerificarLogin.php');
	
	require('conexion.php');


	$Respuesta = [];
	$data = json_decode(file_get_contents('php://input'), true);

	$ID = $_GET["ID"];

	$GuardaFecha = "";
	if( $data["Estado"] == 1 ) { //Agrego fecha de cierre
		$fecha = date('Y-m-d H:i:s');
		$GuardaFecha = ", FechaCierre = '" . date('Y-m-d H:i:s') . "'";
	}

	$data = array_map(function($value) {
    	if ( is_array( $value ) == false ) return "'" . $value . "'";
	}, $data);

		$strSQL = "UPDATE Protocolos SET 
			Estado =  $data[Estado] 
			$GuardaFecha 
			WHERE ID = " . $ID;

		if (mysqli_query($conn, $strSQL)) { 
			$Respuesta['Codigo'] = 1;
			$Respuesta['Mensaje'] = $ID;
		} else {
			$Respuesta['Codigo'] = 10;
            $Respuesta['Mensaje'] =  'MySQL Error: ' . mysqli_error($conn);
			echo json_encode($Respuesta); return;
		}

	echo json_encode($Respuesta);