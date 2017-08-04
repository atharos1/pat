<?php 
    $info['ID'] = $_SESSION['UsuarioID'];
    $info['Nombre'] = $_SESSION['Nombre'];

    echo '<script>';
        echo 'var UserInfo = ' . json_encode($info) . ';';
    echo '</script>';  