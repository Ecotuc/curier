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
	<form class="form_status"method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="orden">Número de orden</label>
		<input type="text" name="orden" placeholder="Ejemplo 11111">
		<button type="submit" class="btn btn-primary col-md-5" name="submit">Rastrear pedido</button>
	</form>
	<center>
	<?php 
		$status = 0;
		$order=$_POST['orden'];
		if(isset($_POST['submit'])){
		$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998")
			or die('Could not connect: ' . pg_last_error());
		$query = "SELECT status FROM ordenes
				  WHERE orden = '$order'";
		$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
		$row = pg_fetch_row($result);
		$status = $row[0];
		echo "<br><br><br>El número de orden es: ", $order," <br><br><br>
			  El status de la orden es: <h1>", $status, "</h1><br><br><br>";

		}

	?>
  	</center>








	



</body>
</html>