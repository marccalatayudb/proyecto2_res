<?php
	session_start();
	include 'session.php';
	if (isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bienvenido a Escandio</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Glyphycons -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		<div class="window">
			<!-- Visualiza el Nombre de usuario y el botón Cerrar Sesión en el header -->
			<div class="user-login-view">
				<!-- Nombre de usuario -->
				<div class="user-view-left">
					<?php
						$nsql="SELECT * FROM `usuario` WHERE `alias`= '".$_SESSION['username']."'";
						$name = mysqli_query($conexion, $nsql);
						while ($resname=mysqli_fetch_array($name)) {
							echo "<p>Bienvenido ".$resname['nombre']." ".$resname['apellidos']."</p>";
						// Continua el while del nombre más abajo...
					?>
				</div>
				<!-- Cerrar Sesión -->
				<div class="login-view-right">
					<a href="index.php?logout='1'" class="btn-logout"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesi&#243;n</a>
				</div>
			</div>

			<div class="window-contenido">
				<!-- Filtro de búsqueda -->
				<div class="window-contenido-search">
					<span class="content-search-title">B&#250;squeda</span>
					<form action="recursos.php">
						<ul>
<!-- 							<li>
								<span>
									<input type="text" name="nom_recurso">
								</span>
							</li> -->
							<li>
								<span>
									<select name="tipo_recurso">
										<option value="" selected>&#8211; Tipo de recurso &#8211;</option>
										<option value="Aula">Aulas</option>
										<option value="Despacho">Despachos</option>
										<option value="Sala">Sala de reuniones</option>
										<option value="Proyector">Proyectores</option>
										<option value="Carro">Carro de port&#225;tiles</option>
										<option value="Port&#225;til">Port&#225;tiles</option>
										<option value="M&#243;vil">M&#243;viles</option>
									</select>
								</span>
							</li>
							<li>
								<span>
									<select name="disponibilidad">
										<option value="" selected>&#8211; Disponibilidad &#8211;</option>
										<option value="1">Disponibles</option>
										<option value="0">No Disponibles</option>
									</select>
								</span>
							</li>
							<li>
								<span>
									<button type="submit" name="botonFiltro" value="Filtrar" class="btn-filtro">Filtrar</button>
								</span>
							</li>
						</ul>
					</form>
				</div>
				<!-- Contenido de la página -->
				<div class="window-contenido-view">
					<?php
							$sql="SELECT `tipo_recurso`, `nom_recurso`, `usuario`.`nombre`, `usuario`.`apellidos`, `reserva`.`idreserva`, `reserva`.`disponibilidad`, `reserva_recurso`.`idreserva_recurso`, `reserva_recurso`.`fecha_hora_reserva`, `reserva_recurso`.`fecha_hora_devolucion`
										FROM `recurso`
										LEFT JOIN `reserva_recurso` ON `recurso`.`idrecurso`=`reserva_recurso`.`idreserva_recurso`
										LEFT JOIN `reserva` ON `recurso`.`idrecurso`=`reserva`.`idreserva`
										LEFT JOIN `usuario` ON `reserva`.`idusuario`=`usuario`.`idusuario`";

							$consulta=mysqli_query($conexion,$sql);

							if (isset($_REQUEST['botonFiltro'])) {
								$tiporecurso=$_REQUEST['tipo_recurso'];
								// $nomrecurso=$_REQUEST['nom_recurso_complete'];
								$disponibilidad=$_REQUEST['disponibilidad'];

								$sql="SELECT `tipo_recurso`, `nom_recurso`, `usuario`.`nombre`, `usuario`.`apellidos`, `reserva`.`idreserva`, `reserva`.`disponibilidad`, `reserva_recurso`.`idreserva_recurso`, `reserva_recurso`.`fecha_hora_reserva`, `reserva_recurso`.`fecha_hora_devolucion`
											FROM `recurso`
											LEFT JOIN `reserva_recurso` ON `recurso`.`idrecurso`=`reserva_recurso`.`idreserva_recurso`
											LEFT JOIN `reserva` ON `recurso`.`idrecurso`=`reserva`.`idreserva`
											LEFT JOIN `usuario` ON `reserva`.`idusuario`=`usuario`.`idusuario`";

								$filtro="WHERE `recurso`.`tipo_recurso` LIKE '%$tiporecurso%' AND `reserva`.`disponibilidad` LIKE '%$disponibilidad%'";

								$sqlfiltro=$sql.$filtro;

								$consulta=mysqli_query($conexion,$sqlfiltro);
							}

							if(mysqli_num_rows($consulta)>0) {
								echo "<table class='table'>
										<tr>
											<th> Recurso </th>
											<th> Usuario </th>
											<th> Estado </th>
											<th> Fecha de Reserva </th>
											<th> Fecha de Devoluci&#243;n </th>
											<th> Reservar </th>
										</tr>

									<b> Recursos: " . mysqli_num_rows($consulta) . "</b><hr id='hr'>";

									while ($result=mysqli_fetch_array($consulta)) {
										echo "<tr>";
											echo "<td>" . $result ['nom_recurso'] . "</td>";
											echo "<td>" . $result ['nombre'] . " " . $result ['apellidos'] . "</td>";
											if ($result['disponibilidad']>0) {
												echo "<td>Disponible</td>";
											} else {
												echo "<td>No disponible</td>";
											}
											$hora_reserva=strtotime($result ['fecha_hora_reserva']);
											echo "<td>" . DATE('d/m/Y - H:i:s',$hora_reserva) . "</td>";
											$hora_devolucion=strtotime($result ['fecha_hora_devolucion']);
											echo "<td>" . DATE('d/m/Y - H:i:s',$hora_devolucion) . "</td>";
											if ($result['disponibilidad']==1) {
												echo "<td>
														<form action='reservar_recurso.php'>
															<input type='hidden' name='idusuario' value=".$resname['idusuario'].">
															<input type='hidden' name='idreserva' value=".$result['idreserva'].">
															<input type='hidden' name='idreserva_recurso' value=".$result['idreserva_recurso'].">
															<button type='submit' name='reservar' value='Reservar' class='btn btn-success reserva'>Reservar</button>
														</form>
													</td>";
											} else {
												// Si no lo está, comprueba el nombre del usuario de la sesión y lo compara con el del resultado (el de la tabla)
												if ($resname['nombre']==$result['nombre']) {
													echo "<td>
														<form action='liberar_recurso.php'>
															<input type='hidden' name='idusuario' value=".$resname['idusuario'].">
															<input type='hidden' name='idreserva' value=".$result['idreserva'].">
															<input type='hidden' name='idreserva_recurso' value=".$result['idreserva_recurso'].">
															<button type='submit' name='liberar' value='Liberar' class='btn btn-warning reserva'>Liberar</button>
														</form>
													</td>"; // Campo6
												} else {
													echo "<td><button type='button' class='btn btn-danger disabled reserva'>Reservado</button></td>"; // Campo6
												}
											}
										echo "</tr>";
									// Fin del While $result
									}
								echo "</table>";
								// echo "<br><br>Hola: ".$result['nom_recurso']." ;"
							} else {
								echo "<table class='table'>
										<tr>
											<th> Recurso </th>
											<th> Usuario </th>
											<th> Estado </th>
											<th> Fecha de Reserva </th>
											<th> Fecha de Devoluci&#243;n </th>
											<th> Reservar </th>
										</tr>

									<b> Recursos: " . mysqli_num_rows($consulta) . "</b><hr id='hr'>";

									echo "<tr>
											<td colspan='6' style='text-align:center;'>No hay datos disponibles.</td>
										</tr>";
								echo "</table>";
							// Cierra el if/while de $consulta
							}
						// Cierra el while de $resname
						}
					?>
				</div>
				<br><br><br><br>

			</div>
		</div>
	</body>
</html>
<?php
	} else {
		header('location: index.php');
	}
?>