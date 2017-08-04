<?php
	
	require_once('VerificarLogin.php');

	require('mysql/conexion.php');

	$Respuesta = [];
	$ResultadoUpdate = 1;
	$Update = "";

	$data = json_decode(file_get_contents('php://input'), true);

	$data["Comodin"] = ""; //Inicializo una array

	$ID = $_SESSION["UsuarioID"];

	$data = array_map(function($value) {
		if ( ( is_array( $value ) == false ) ) return "'" . $value . "'";
	}, $data);

	if ( !array_key_exists("ClaveVieja", $data) ) $data["ClaveVieja"] = "";
	if ( !array_key_exists("Clave", $data) ) $data["Clave"] = "";
	if ( !array_key_exists("Nombre", $data) ) $data["Nombre"] = "";
	if ( !array_key_exists("Apellido", $data) ) $data["Apellido"] = "";
	if ( !array_key_exists("Skin", $data) ) $data["Skin"] = "";	
	if ( !array_key_exists("Avatar", $data) ) $data["Avatar"] = "";	

	if ($data["Skin"] != "" ) {
		if( $Update != "") $Update .= ", ";
		$Update .= "Skin = $data[Skin]";
		$_SESSION['Skin'] = $data["Skin"];
	}
	if ($data["Nombre"] != "" ) {
		if( $Update != "") $Update .= ", ";
		$Update .= "Nombre = $data[Nombre]";
	}
	if ($data["Apellido"] != "" ) {
		if( $Update != "") $Update .= ", ";
		$Update .= "Apellido = $data[Apellido]";
	}

	if ($data["Avatar"] != "" ) {
		$encodedSkin = str_replace(' ','+',$data["Avatar"]);
		$decodedSkin = base64_decode($encodedSkin);

		$uri = base64_decode(substr($encodedSkin,strpos($encodedSkin,",")+1));

  		file_put_contents("../img/Avatares/" . $ID . ".png", $uri);
	} else {
		if( !file_exists("../img/Avatares/" . $ID . ".png") ) copy("../img/Avatares/default.png", "../img/Avatares/" . $ID . ".png");
	}

	if ( $Update != "" ) {
		$strSQL = "UPDATE Usuarios SET 
			$Update 
			WHERE ID = " . $ID;

		if (!mysqli_query($conn, $strSQL)) {  //ERROR
			$Respuesta['Codigo'] = 10;
			$Respuesta['Mensaje'] =  'MySQL Error: ' . mysqli_error($conn);
			echo json_encode($Respuesta); return;
		}
	}




	$strSQL = "Select Usuario, CONCAT(Nombre, ' ', Apellido) as Nombre, Contraseña as ClaveActual From Usuarios WHERE ID = $ID";
	$query = mysqli_query($conn, $strSQL);
	if (!$query) {
		echo 'MySQL Error: ' . mysqli_error($conn);
		die;
	}
	$row = mysqli_fetch_assoc($query);

	$_SESSION['Nombre'] = $row["Nombre"];

	if ($data["Clave"] != null ) { //Cambia contraseña

		if( ($row["ClaveActual"] != $row["Usuario"]) and ($data["Clave"] != $data["ClaveVieja"]) ) { //Cambio de clave no permitido
			$Respuesta['Codigo'] = 10;
			$Respuesta['Mensaje'] =  "No se ha completado el cambio de contraseña. 
			Asegurate de que la contraseña anterior esté bien escrita, o que tengas permiso para llevar a cabo esta acción.";
			echo json_encode($Respuesta); return;
		} else { //Todo OK
			$strSQL = "UPDATE Usuarios SET 
			Contraseña =  $data[Clave] 
			WHERE ID = " . $ID;

			if (!mysqli_query($conn, $strSQL)) { 
				$Respuesta['Codigo'] = 10;
				$Respuesta['Mensaje'] =  'MySQL Error: ' . mysqli_error($conn);
				echo json_encode($Respuesta); return;
			}
		}
	}

	if( $ResultadoUpdate == 1 ) {
		$Respuesta['Codigo'] = 1;
		$Respuesta['Mensaje'] = $ID;
	} else {
		$Respuesta['Codigo'] = 10;
		$Respuesta['Mensaje'] =  "Error desconocido.";
	}


	echo json_encode($Respuesta);