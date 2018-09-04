<?php
	session_start();
	error_reporting(0);

	$varsesion = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<br><br>
	<title>Inicio sesion</title>
	<meta charset="utf-8">
	<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
	<link href="../css/e.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="imgage/png" href="../images/tab_logo.png" sizes="32x32">
</head>

<body class="fondo">

	<form action="validar_index.php" method="post" class="form-register" >

		<!-- <h2 class="form-titulo">Login</h2> -->
	 	<center class="contenedor-inputs">
	 		<input type="text" name="usuario" placeholder="Usuario" class="input-48" required>
	 		<input type="password" name="contraseña" placeholder="Contraseña" class="input-48" required>
	 		<input type="submit" name="submit" value="Ingresar" class="btn-enviar" required>
	 		<h3 class="form__link">¿Aún no tienes una cuenta? <a href="registro.php" style="text-decoration: none; color:yellow;">Ingresa aquí</a></h3>
	 	</center>
	</form>
</body>
</html>