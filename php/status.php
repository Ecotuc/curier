<?php
	session_start();
	error_reporting(0);
	$varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion == ''){
		$varsesion= 'local';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>DHL | Guatemala</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="../css/estilo.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="imgage/png" href="../images/tab_logo.png" sizes="32x32">
</head>
<body class="fondo">
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <img class="nav_logo" src="../images/nav_logo.png">
	    </div>
	    <ul class="nav navbar-nav">
      		<?php
				if(!($varsesion =='admin') && !($varsesion == 'local')){
						echo "<li><a href=\"welcome.php\">Ingresar ordenes</a></li>
						<li class=\"active\"><a href=\"cotizacion.php\">Cotización</a></li>
						<li><a href=\"cerrarsesion.php\">Cerrar Sesión</a></li>";
				
				}elseif($varsesion =='admin'){
						echo "<li><a href=\"welcome.php\">Ingresar ordenes</a></li>";
						echo "<li><a href=\"tiendas.php\">Ingresar Tienda</a></li>
          				<li><a href=\"costos.php\">Ingresar costos</a></li>
          				<li class=\"active\"><a href=\"cotizacion.php\">Cotización</a></li>
          				<li><a href=\"cerrarsesion.php\">Cerrar Sesión</a></li>";
				}elseif ($varsesion == 'local') {
					echo"<li><a href=\"index.html\">Home</a></li>
	     			 <li class=\"active\"><a href=\"cotizacion.php\">Cotización</a></li>";
				}
			 ?>
	    </ul>
	  </div>
	</nav>



	
</body>
</html>