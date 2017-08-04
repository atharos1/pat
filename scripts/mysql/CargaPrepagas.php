<?php
    require_once('../VerificarLogin.php');
    
    if (!isset($set) ) $set = '';

    $strSQL = "Select ID, Nombre From Prepagas Where Desactivado = 0";

    include("conexion.php");

    $query = mysqli_query($conn, $strSQL);
        if (!$query) {
            echo 'MySQL Error: ' . mysqli_error($conn);
            die;
        }


        $echo = '';

    while($row = mysqli_fetch_array($query)){
        $echo = $echo . '<option value="' . $row['ID'] . '">' . $row['Nombre'] . '</option>'; 
    }
            
    echo "<select id='Pac_Prepaga' class='selectpicker' title='Prepaga' data-live-search='true'>";
            
    echo $echo;
    echo "</select>";