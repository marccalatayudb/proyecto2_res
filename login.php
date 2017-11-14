<?php
	// Incluye la página php de conexión con la base de datos.
	include 'session.php';
	// Cuando el Botón Entrar (de la página de login "index.php") se ha pulsado, envía los datos del formulario:
	if (isset($_POST['login'])) {
		// Se inicia la sesion
		session_start();
		// Establece el nombre de usuario y la contraseña en una variable
		$username = $_POST['username'];
		$password = $_POST['password'];
		// Establecemos una consulta en la base de datos con el usuario y la contraseña enviada y que sean iguales a las que hay en la base de datos
		$sql = "SELECT * FROM `usuario` WHERE `alias` = '".$username."' AND `pwd` = '".$password."'";
		// Realiza la consulta a la base de datos
		$result = mysqli_query($conexion, $sql);
		// Obtiene el número de resultados/filas de la consulta realizada, 0 (ninguno) o 1 (Si hay un valor)
		$row = mysqli_num_rows($result);
		// Comprueba que la consulta, si ha encontrado alguna coincidencia, es mayor a 0
		if ($row==1) {
			// Si no hay ningún error el usuario inicia sesión
			$_SESSION['username'] = $username;
			echo "Bienvenido! ".$_SESSION['username'];
			header('location: recursos.php');
		} else {
			// Si el usuario o la contraseña no coinciden con los que están almacenados en la base de datos envía el error
			$message = "Usuario o Contraseña incorrectas";
			// array_push($errors, "Usuario o Contraseña incorrectas");
			// header('location: index.php');
			echo $message;
			echo "<br><br><a href='index.php'>Volver</a>";
		}
	}

	// Comprueba que la opción "Cerrar Sesión" se ha seleccionado
	if (isset($_GET['logout'])) {
		// La Sesión se destruye junto con toda la información registrada del logeo
		session_destroy();
		// Especifica la Sesión del usuario logeado y destruye toda la información registrada del logeo
		unset($_SESSION['username']);
		// Una vez ha hecho lo anterior redirige al usuario hacía la página de registro
		header('location: index.php');
	}
	// Cierrra la conexión con la Base de datos
	mysqli_close($conexion);

?>

