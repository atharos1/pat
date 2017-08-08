<?php 
	session_start();
    if( !isset($_SESSION['UsuarioID'] )) header('Location: default.php?url=' . urlencode($_SERVER['REQUEST_URI']) );