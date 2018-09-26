<?php
	session_start();
	error_reporting(0);
	$varsesion = $_SESSION['usuario'];
	$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
				$query = "SELECT username FROM users";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error()); 
				$ver=0;
				while ($row = pg_fetch_row($result)){
					if ($varsesion == $row[0]) {
						$ver=1;
					}
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

	$destinatario=$_POST['destin'];
	$dire=$_POST['dir'];
	$idd=$_POST['dest'];
	$ido= $_POST['origen'];
	$status="1";
	$tienda="local";
	switch ($idd) {
		case '01001':
			$destino = 'Guatemala';
			break;
		case '04001':
			$destino = 'Chimaltenango';
			break;
		case '03001':
			$destino = 'Sacatepequez';
			break;
		case '05001':
			$destino = 'Escuintla';
			break;
		case '11001':
			$destino = 'Retahuleu';
			break;
		case '12001':
			$destino = 'San Marcos';
			break;
		case '10001':
			$destino = 'Suchitepequez';
			break;

	}
	switch ($ido) {
		case '01001':
			$origen = 'Guatemala';
			break;
		case '04001':
			$origen = 'Chimaltenango';
			break;
		case '03001':
			$origen = 'Sacatepequez';
			break;
		case '05001':
			$origen = 'Escuintla';
			break;
		case '11001':
			$origen = 'Retahuleu';
			break;
		case '12001':
			$origen = 'San Marcos';
			break;
		case '10001':
			$origen = 'Suchitepequez';
			break;

	}
	if(isset($_POST['submit'])){
		$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998")
			or die('Could not connect: ' . pg_last_error());

		$query = "INSERT INTO ordenes (status, destinatario, direccion, destino, origen, idd, ido, tienda) VALUES('$status', '$destinatario', '$dire', '$destino', '$origen', '$idd', '$ido', '$tienda')";
		$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());

		if($result){
			pg_free_result($result);
			pg_close($dbconn);
			echo "<script>
                    location.href = 'welcome.php'
            		alert(\"Orden ingresada exitosamente\")
        			</script>";
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
