<?php
	require_once('../VerificarLogin.php');

    if (!isset($valor)) $valor = $_GET["valorcombo"];
    if (!isset($combo)) $combo = $_GET["combo"];
    if (!isset($set) ) $set = 0;

    switch ($combo) {
        case 'TipoTumor':
            $strSQL = "Select ID, Nombre From Partes Where Padre = ". $valor;
            break;
        case 'Localizacion':
            $strSQL = "Select t.ID, t.Nombre From Partes t Where Padre = (Select t1.Hijo From Partes t1 Where t1.ID = ". $valor ." And t1.Hijo <> 0)";
            break;
        /*case 4:
        case 5:
            $strSQL = "Select t.ID, t.Nombre From DiagPatol t Where Padre = " . $valor;
            break;*/
    }

    include("conexion.php");

    $query = mysqli_query($conn, $strSQL);
        if (!$query) {
            echo 'MySQL Error: ' . mysqli_error($conn);
            die;
        }
            
    $echo = "";
            
    if ( isset($set) ) {
        while($row = mysqli_fetch_array($query)){
            $echo = $echo . '<option value="' . $row['ID'] . '"';
            if( $row['ID'] == $set ) $echo = $echo . ' selected';
                $echo = $echo . '>' . $row['Nombre'] . '</option>'; 
            }
    } else {
        while($row = mysqli_fetch_array($query)){
            $echo = $echo . '<option value="' . $row['ID'] . '">' . $row['Nombre'] . '</option>'; 
        }
    }
            
    $add = "";
    if($echo == "") { $add=" disabled"; }
            
    switch ($combo) {
        case 'TipoTumor':
            echo "<select id='Localizacion' class='selectpicker formControl' title='Localización' data-live-search='true' data-id=0 onChange='CargaCombos();'" . $add .">";
            break;
        case 'Localizacion':
            echo "<select id='LocHueso' class='selectpicker formControl' title='Loc. en el hueso' data-live-search='true' data-id=0" . $add .">";
            break;
        /*case 4:
            echo "<select class='selectpicker' id='tumor1' name='tumor1' data-size='7' title='Diagnóstico patológico 1' data-live-search='true'" . $add .">";
            echo "select id='Localizacion' class='selectpicker' title='Loc. en el hueso' data-live-search='true' data-id=0 onChange='CargaCombos(this,3)'" . $add .">";
            break;
        case 5:
            echo "<select class='selectpicker' id='tumor2' name='tumor2' data-size='7' title='Diagnóstico patológico 2' data-live-search='true'" . $add .">";
            echo "select id='Localizacion' class='selectpicker' title='Loc. en el hueso' data-live-search='true' data-id=0 onChange='CargaCombos(this,3)'" . $add .">";
            break;*/
    }
            
    echo $echo;
    echo "</select>";