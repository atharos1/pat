<?php
	require_once('../VerificarLogin.php');
	
	require('conexion.php');

	$Respuesta = [];
	$data = json_decode(file_get_contents('php://input'), true);
	$arrMat = $data['MatEnv'];
	$datafecha = $data["FechaOrden"];

	$ID = $data["ID"];
	if ( empty( $data["TipoTumor"] ) ) 		$data["TipoTumor"] = 0;
	if ( empty( $data["Localizacion"] ) ) 	$data["Localizacion"] = 0;
	if ( empty( $data["LocHueso"] ) ) 		$data["LocHueso"] = 0;
	if ( empty( $data["Lado"] ) ) 			$data["Lado"] = 0;
	if ( !empty( $datafecha ) ){
		$datafecha = "STR_TO_DATE($datafecha, '%d/%m/%Y')";
	} else {
		$datafecha = "null";
	}	

	//$data['FechaOrden'] = date('Y-m-d', strtotime($data['FechaOrden']));

	$data = array_map(function($value) {
    	if ( is_array( $value ) == false ) return "'" . $value . "'";
		//if ( is_array( $value ) == false ) return mysqli_real_escape_string($conn, $value);
	}, $data);

	if( $ID == 0 ) { //Nueva

		$strSQL = "INSERT INTO Protocolos (
			PacienteID, MedicoID, HospitalID,
			TipoTumor, Localizacion, LocHueso, Lado,
			Tumor1, Tumor1Duda, Tumor2, Tumor2Duda,
			FechaOrden,
			DiagnosticoClinico,
			DiagPresuntivo,
			Informe1, Informe2,
			Imagenes, ImagenesObs, 
			AgregadoPor
		) VALUES (
			$data[PacienteID], $data[MedicoID], $data[HospitalID],
			$data[TipoTumor], $data[Localizacion], $data[LocHueso], $data[Lado],
			$data[Tumor1], $data[Tumor1Duda], $data[Tumor2], $data[Tumor2Duda],
			$datafecha,
			$data[HistorialClinico],
			$data[DiagnosticoPresuntivo],
			$data[InformePrincipal], $data[InformeComplementario],
			$data[Imagenes], $data[ImagenesObs], 
			$_SESSION[UsuarioID]
		)";

		if (mysqli_query($conn, $strSQL)) {
			$ID = mysqli_insert_id($conn);
 			$Respuesta['Codigo'] = 1;
			$Respuesta['Mensaje'] = $ID;
			$Respuesta['FechaIngreso'] = date('d/m/Y');
		} else {
			$Respuesta['Codigo'] = 10;
            $Respuesta['Mensaje'] =  'MySQL Error: ' . mysqli_error($conn);
			echo json_encode($Respuesta); return;
		}

			
	} else { //Existente

		$strSQL = "UPDATE Protocolos SET 
			PacienteID =  $data[PacienteID], MedicoID = $data[MedicoID], HospitalID = $data[HospitalID],
			TipoTumor = $data[TipoTumor], Localizacion = $data[Localizacion], LocHueso = $data[LocHueso], Lado = $data[Lado],
			Tumor1 = $data[Tumor1], Tumor1Duda = $data[Tumor1Duda], Tumor2 = $data[Tumor2], Tumor2Duda = $data[Tumor2Duda],
			FechaOrden = $datafecha,
			DiagnosticoClinico = $data[HistorialClinico],
			DiagPresuntivo = $data[DiagnosticoPresuntivo],
			Informe1 = $data[InformePrincipal], Informe2 = $data[InformeComplementario], 
			Imagenes = $data[Imagenes], ImagenesObs = $data[ImagenesObs]  
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

	$myfile = fopen("log.txt", "a+") or die("Unable to open file!");
		fwrite($myfile, "[".$_SESSION["UsuarioID"]." ".date('Y/m/d H:i:s')."] ".$strSQL.PHP_EOL);
		fclose($myfile);


	for( $i = 0; $i < count($arrMat); $i++ ) {
		$regActual = $arrMat[$i];
		if ( $regActual['ID'] == 0 ) { //INSERT
			if ( $regActual['Estado'] == 0 ) {
				$strSQL = "INSERT INTO MatEnv(
					ProtocoloID, Material, Cantidad, FijadoEn, ObtenidoPor, Contenido, Obs, Quien) VALUES (
					$ID, $regActual[Material], $regActual[Cantidad], $regActual[FijadoEn], $regActual[ObtenidoPor], 
					'$regActual[Contenido]', '$regActual[Obs]', 0)";
			} else {
					$Respuesta['Codigo'] = 1;
					echo json_encode($Respuesta); return;
			} 
		} else { //UPDATE
			$strSQL = "Update MatEnv Set 
				Estado = $regActual[Estado], Material = $regActual[Material], Cantidad = $regActual[Cantidad], FijadoEn = $regActual[FijadoEn],  
				ObtenidoPor = $regActual[ObtenidoPor], Contenido = '$regActual[Contenido]', Obs = '$regActual[Obs]' WHERE ID = $regActual[ID] AND ProtocoloID = $ID";
		}
		if (mysqli_query($conn, $strSQL)) {
			$Respuesta['Codigo'] = 1;
		} else {
			$Respuesta['Codigo'] = 10;
            $Respuesta['Mensaje'] =  'MySQL Error: ' . mysqli_error($conn);
			echo json_encode($Respuesta); return;
		}

	}

	echo json_encode($Respuesta);