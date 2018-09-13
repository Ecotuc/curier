	<?php
		if(isset($cualquiera)){
			if (!($cualquiera==1)) {
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
			}
		}else{
			session_start();
				error_reporting(0);
				$varsesion = $_SESSION['usuario'];
				if($varsesion == null || $varsesion == '' || $varsesion == 'local'){
					echo "<body class='fondo'>";
						echo "<script>
									alert(\"Debe iniciar sesión\");
									window.location= 'index.html'
								</script>";
				}
		}
	?>

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
						echo "<li><a id='welcome-option' href=\"welcome.php\">Ingresar ordenes</a></li>
						<li><a href=\"cotizacion.php\">Cotización</a></li>
						<li><a id='status-option' href=\"status.php\">Status</a></li>
						<li><a href=\"cerrarsesion.php\">Cerrar Sesión</a></li>
						<li ><a id='status-option' href=\"#\">" ,$varsesion,"</a></li>";
				
				}else if($varsesion =='admin'){
						echo "<li><a id='welcome-option' href=\"welcome.php\">Ingresar ordenes</a></li>
						<li><a href=\"tiendas.php\">Ingresar Tienda</a></li>
          				<li><a href=\"costos.php\">Ingresar costos</a></li>
          				<li><a href=\"cotizacion.php\">Cotización</a></li>
          				<li><a id='status-option' href=\"status.php\">Status</a></li>
          				<li><a href=\"cerrarsesion.php\">Cerrar Sesión</a></li>
          				<li ><a id='status-option' href=\"#\">" ,$varsesion,"</a></li>";
				}else if ($varsesion == 'local') {
					echo"<li><a id='welcome-option' href=\"index.html\">Home</a></li>
	     			 <li><a href=\"cotizacion.php\">Cotización</a></li>
	     			 <li><a id='status-option' href=\"status.php\">Status</a></li>";
				}
			?>

	    </ul>
	  </div>
	</nav>
</head>

<script>
	var href = document.location.href;
	var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);
	if(lastPathSegment == "status.php"){
		$('#status-option').addClass('active');
		console.log('hola');
	}else if(lastPathSegment == "welcome.php"){
		$('#welcome-option').addClass('active');
	}
</script>