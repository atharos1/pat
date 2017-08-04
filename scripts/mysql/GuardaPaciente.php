<?php

    require_once('../VerificarLogin.php');

 

    require('conexion.php');

 

    $Respuesta = [];

    $data = json_decode(file_get_contents('php://input'), true);

 

    $ID = $data["ID"];

    if ( empty( $data["Sexo"] ) )               $data["Sexo"] = 0;

    if ( empty( $data["Etnia"] ) )              $data["Etnia"] = 0;

    //if ( empty( $data["Civil"] ) )                $data["Civil"] = 0;

    //if ( empty( $data["Pais"] ) )                 $data["Pais"] = 0;

    if ( empty( $data["Provincia"] ) )          $data["Provincia"] = 0;

    if ( empty( $data["Prepaga"] ) )            $data["Prepaga"] = 0;

 

    //$data['FechaOrden'] = date('Y-m-d', strtotime($data['FechaOrden']));

 

    $data = array_map(function($value) {

        if ( is_array( $value ) == false ) return "'" . $value . "'";

    }, $data);

 

    if( $ID == 0 ) { //Nueva

 

        $strSQL = "INSERT INTO Pacientes (

            Apellido, Nombre, DNI,

            Sexo, Nacimiento,

            Domicilio, Provincia, CP,

            Telefono, Telefono2, 

            Edad,

            Prepaga, NumPrepaga, 

            Observaciones, 

            AgregadoPor

        ) VALUES (

            $data[Apellido], $data[Nombre], $data[DNI],

            $data[Sexo], STR_TO_DATE($data[Nacimiento], '%d/%m/%Y'), 

            $data[Domicilio], $data[Provincia], $data[CP], 

            $data[Telefono], $data[Telefono2],

            $data[Edad],

            $data[Prepaga], $data[NumPrepaga], 

            $data[Observaciones], 

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

 

        $strSQL = "UPDATE Pacientes SET 

            Apellido =  $data[Apellido], Nombre = $data[Nombre], DNI = $data[DNI],

            Sexo = $data[Sexo], Nacimiento = STR_TO_DATE($data[Nacimiento], '%d/%m/%Y'),

            Domicilio = $data[Domicilio], Provincia = $data[Provincia], CP = $data[CP],

            Telefono = $data[Telefono], Telefono2 = $data[Telefono2], 

            Edad = $data[Edad],

            Prepaga = $data[Prepaga], NumPrepaga = $data[NumPrepaga], 

            Observaciones = $data[Observaciones] 

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