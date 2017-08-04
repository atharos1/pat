<?php

    require_once('../VerificarLogin.php');

 

    $ID = $_GET['ID'];

    

    $strSQL = "Select 

    Apellido, Nombre, DNI,

            Sexo, 

            Domicilio, Provincia, CP,

            Telefono, Telefono2, 

            Prepaga, NumPrepaga,

            DATE_FORMAT(Nacimiento, '%d/%m/%Y') as Nacimiento, Edad, 

            Observaciones 

            FROM Pacientes 

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