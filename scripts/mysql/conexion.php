<?php
	$servername = "127.0.0.1";
	$username = "root";
	$password = "ventormenta1";
	$db = "patol";
	
	$conn = new mysqli($servername, $username, $password, $db);

	if (mysqli_connect_error()) {
		die("Error en la conexión con la base de datos: " . mysqli_connect_error());
	}

	mysqli_set_charset($conn, "utf8");
?>