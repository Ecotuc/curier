<?php
	session_start();
	error_reporting(0);
	$varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion == '' || !($varsesion== 'admin')){
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
		<meta charset="utf-8">
		<title>DHL | Guatemala | <?php echo $varsesion; ?></title>
		<link href="../css/estilo.css" rel="stylesheet" type="text/css">
		<link rel="icon" type="imgage/png" href="../images/tab_logo.png" sizes="32x32">
	</head>
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
				if(!($varsesion =='admin')){
						echo "<li class=\"active\"><a href=\"welcome.php\">Ingresar ordenes</a></li>";
				}
			 ?>
			<?php
				if($varsesion =='admin'){
						echo "<li class=\"active\"><a href=\"welcome.php\">Ingresar ordenes</a></li>";
						echo "<li><a href=\"tiendas.php\">Ingresar Tienda</a></li>
          				<li><a href=\"costos.php\">Ingresar costos</a></li>";
				}
			 ?>
			<li><a href="cerrarsesion.php">Cerrar Sesión</a></li>
	    </ul>
	  </div>
	</nav>

<?php

	session_start();
	error_reporting(0);

	$_SESSION['usuario'] = $usuario;
	$name=$_POST['nombre'];
	$dire=$_POST['dir'];
	$origen=$_POST['dest'];

	if(isset($_POST['submit'])){
		$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998")
			or die('Could not connect: ' . pg_last_error());
		$query = "INSERT INTO tienda VALUES('$name', '$dire', '$origen')";
		$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
		if($result){
			pg_free_result($result);
			pg_close($dbconn);
			echo "Tienda agregada con éxito";
			// header("location:tiendas.php");/
		}else {
			pg_free_result($result);
			pg_close($dbconn);
			echo "Por favor inténtelo de nuevo más tarde.";
			echo "<script>
            		setTimeout(function() {
                    location.href = 'welcome.php';
            		}, 2000);
        			</script>";
			
		}



	}
?>

</html>
