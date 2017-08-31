<?php



    $data = json_decode(file_get_contents('php://input'), true);

    

    if(empty($data['Usuario']) || empty($data['Clave'])) {
		
		$Respuesta['Codigo'] = 2;
        $Respuesta['Mensaje'] =  "Ingrese nombre de usuario y contraseña.";

	} else {

        require("mysql/conexion.php");

        $strSQL = "Select ID, CONCAT(Nombre, ' ', Apellido) as Nombre, Skin From Usuarios Where Usuario = '" . $data['Usuario'] . "' 
            And Contraseña = '" . $data['Clave'] . "'";
            
        $query = mysqli_query($conn, $strSQL);

        if (!$query) {
            $Respuesta['Codigo'] = 10;
            $Respuesta['Mensaje'] =  'MySQL Error: ' . mysqli_error($conn);
            echo json_encode($Respuesta);
            return;
        }
        $valor = mysqli_fetch_assoc($query);
        
        if($valor['ID'] == '') { //ERROR DE CONEXION
            $Respuesta['Codigo'] = 2;
            $Respuesta['Mensaje'] =  "Nombre de usuario o contraseña incorrecto.";
        } else { //LOGIN CORRECTO!
            session_start();
            $_SESSION['UsuarioID'] = $valor['ID'];
            $_SESSION['Nombre'] = $valor['Nombre'];
            $_SESSION['Skin'] = $valor['Skin'];
            $Respuesta['Codigo'] = 1;
            if( $data['Clave'] == $data['Usuario'] ) $Respuesta['Codigo'] = 3; //Primer inicio
        }
	}

    echo json_encode($Respuesta);