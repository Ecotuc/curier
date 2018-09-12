	<?php
		session_start();
		error_reporting(0);
		$varsesion = $_SESSION['usuario'];
		if($varsesion == null || $varsesion == '' || $varsesion == 'local' ||!($varsesion=='admin')){
			echo "<body class='fondo'>";
				echo "<script>
							alert(\"Debe iniciar sesión\");
							window.location= 'index.html'
						</script>";
		}
	?>

<!DOCTYPE html>
<html>
<head>
	<title>Ingreso de tiendas | DHL Guatemala | <?php echo $varsesion; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="../css/estilo.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="imgage/png" href="../images/tab_logo.png" sizes="32x32">
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
</head>
<body class="fondo3">
  <div class="tabla">
	  <form class="form-register-tiendas" method="POST" action="validar_tienda.php">
		    <div class="form-row">
		      <div class="form-group col-md-6">
		        <label for="inputname">Nombre</label>
		        <input type="text" class="form-control" id="inputname" placeholder="Nombre de la tienda" name="nombre" required>
		      </div>
		      <div class="form-group col-md-6">
		        <label for="inputAddress">Dirección</label>
		        <input type="text" class="form-control" id="inputAddress" placeholder="10a Calle 10-30 Z17" name="dir" required>
		      </div>
		    </div>
		    <!-- <div class="col-md-3"></div> -->
		    <div class="form-group col-md-6">
		      <label for="inputAddress">Departamento al que pertenece</label>
		      <select id="inputmunicipio" class="form-control col-md-3" name="dest">
		      	<option value="01000" selected>Guatemala</option>
		        <option value="04000">Chimaltenango</option>
		        <option value="03000">Sacatepequez</option>
		        <option value="05000">Escuintla</option>
		        <option value="11000">Retahuleu</option>
		        <option value="12000">San Marcos</option>
		        <option value="10000">Suchitepequez</option>
		      </select>
		    </div>
		    <div class="col-md-3"></div>	    
		    <div class="col-md-12"></div>
		    <div class="col-md-4"></div>
		    <button type="submit" class="btn btn-primary col-md-5" name="submit">Agregar nueva tienda</button>
	  </form>
  	



  	
	  <?php 
	  	$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998")
			    			or die('Could not connect: ' . pg_last_error());

						$query1 = "SELECT * FROM tienda ORDER BY nombre";

						$resultado = pg_query($query1) or die('Query failed: ' . pg_last_error());

						while ($row = pg_fetch_row($resultado)) {
							$nombre=$row[0];
							$lugar=$row[2];
							echo $nombre, " : ", $lugar, "<br>";
						}
	  ?>
  </div>


</body>
</html>