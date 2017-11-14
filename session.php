<?php
	// Establecemos otra variable 'Error', que nos informará si hay una error al introducir el usuario o contraseña y que se viasualice en el mismo login
	$errors = array();
	// Establece la conexión a la base de datos
	$conexion = mysqli_connect ('localhost', 'root', '', 'proyecto2_res');
	mysqli_query($conexion,"SET NAMES 'utf8'");
	// mysqli_set_charset($conexion,'utf-8');
	// Si hay algún error al intentar conectarse, establecemos un aviso sino, sigue con la conexión.
	if (!$conexion) {
		echo "Error: No se pudo conectar a MySQL. " . PHP_EOL;
		echo "Errno de depuración: " . mysqli_connect_errno () . PHP_EOL;
		echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
		exit;
	}
	// Continua en login.php
?>