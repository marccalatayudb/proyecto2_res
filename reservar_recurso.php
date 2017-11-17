<?php
	include 'session.php';

	$idusuario=$_REQUEST['idusuario'];
	$idreserva=$_REQUEST['idreserva'];
	$idreserva_recurso=$_REQUEST['idreserva_recurso'];
	date_default_timezone_set("Europe/Madrid");
	$localdateres=date("Y-m-d H:i:s");

	$reservarUno="UPDATE `reserva` SET `idusuario`='$idusuario', `disponibilidad` = 0 WHERE `reserva`.`idreserva` = '$idreserva'";
	mysqli_query($conexion, $reservarUno);

	if ($reservarUno==true) {
		$reservarDos="UPDATE `reserva_recurso` SET `idreserva` = '$idreserva', `fecha_hora_reserva` = '$localdateres' WHERE `reserva_recurso`.`idreserva_recurso` = '$idreserva_recurso'";
		mysqli_query($conexion, $reservarDos);
	}

	header('Location: recursos.php');

?>