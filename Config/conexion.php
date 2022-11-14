<?php
	
	$mysqli = new mysqli('localhost', 'yespoint_Ef', 'contraseña2001', 'yespoint_salav');
	$mysqli -> set_charset("utf8");
	if($mysqli->connect_error){
		
		die('Error en la conexion' . $mysqli->connect_error);
		
	}
?>