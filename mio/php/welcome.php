<?php
	session_start();
	error_reporting(0);
	$varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion == ''|| ($varsesion != 'admin')){
		echo "<body class='fondo'>";
		echo "<h2 class='form-titulo'>Debe iniciar como usuario existente para ingresar</h2>";
			echo "<script>
						setTimeout(function() {
								location.href = 'index.html';
						}, 2000);
					</script>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>DHL | Guatemala | $varsesion</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="../css/e.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="imgage/png" href="../images/tab_logo.png" sizes="32x32">
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <img class="nav_logo" src="../images/nav_logo.png">
	    </div>
	    <ul class="nav navbar-nav">
      		<?php
				if(!($varsesion =='admin')){
						echo "<li class=\"active\"><a href=\"#\">Ingresar ordenes</a></li>";
          				echo "<li><a href=\"displayusuarios.php\">Usuarios</a></li>";
				}
			 ?>
			<?php
				if($varsesion =='admin'){
						echo "<li class=\"active\"><a href=\"#\">Ingresar ordenes</a></li>";
						echo "<li><a href=\"tiendas.php\">Ingresar Tienda</a></li>
          				<li><a href=\"costos.php\">Ingresar costos</a></li>";
				}
			 ?>
			<li><a href="cerrarsesion.php">Cerrar Sesión</a></li>
	    </ul>
	  </div>
	</nav>
</head>
<body class="fondo2">
	
	<form class="form-register">
	    <div class="form-row">
	      <div class="form-group col-md-6">
	        <label for="inputname">Destinatario</label>
	        <input type="text" class="form-control" id="inputname" placeholder="Nombre de quien recibe">
	      </div>
	      <div class="form-group col-md-6">
	        <label for="inputAddress">Dirección</label>
	        <input type="text" class="form-control" id="inputAddress" placeholder="10a Calle 10-30 Z17">
	      </div>
	    </div>
	    <!-- <div class="col-md-3"></div> -->
	    <div class="form-group col-md-6">
	      <label for="inputAddress">Lugar de destino</label>
	      <select id="inputmunicipio" class="form-control col-md-3" name="dest">
	      	<option selected>Guatemala</option>
	          <option>...</option>
	      </select>
	    </div>
	    <div class="col-md-3"></div>	    
	    <div class="col-md-12"></div>
	    <div class="col-md-4"></div>
	    <button type="submit" class="btn btn-primary col-md-3">Crear orden</button>
	</form>

</body>
</html>