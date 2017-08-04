<?php 
	session_start();
    if( !isset($_SESSION['UsuarioID'] )) header('Location: default.php');