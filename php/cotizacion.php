
<!DOCTYPE html>
<html>
<head>
	<title>DHL | Guatemala</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="../css/e.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="imgage/png" href="../images/tab_logo.png" sizes="32x32">
</head>
<body class="fondo">
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <img class="nav_logo" src="../images/nav_logo.png">
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="#">Home</a></li>
	      <li><a href="#">Page 1</a></li>
	      <li><a href="#">Page 2</a></li>
	    </ul>
	  </div>
	</nav>

	<?php

		error_reporting(0);

		$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
		$query = "SELECT DISTINCT origen FROM costos";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$query2 = "SELECT DISTINCT destino FROM costos";
		$result1 = pg_query($query2) or die('Query failed: ' . pg_last_error());

		echo "<center>";
			echo "<form action='";
			echo htmlspecialchars($_SERVER['PHP_SELF']);
			echo "' method='post' class='form-register'>";

			echo "<h4 class=''>Aquí podrá ver los precios del envío desde el orígen al destino.<br>Si no aparece el depertamento que busca, significa que aún no tenemos cobertura en ese lugar, pero estamos trabajando en ello.</h4>
			 	<div class=''>";

			 	echo "<select class='' name='origen' required>";
	 				echo "<option value='' disabled selected>Origen del paquete</option>";
					while ($row = pg_fetch_row($result)){
			 			echo "<option value='$row[0]'>$row[0]</option>";
			 		}
				echo "</select>";
			 	
				echo "<br><br>";
			 
				echo "<select class='' name='destino' required>";
		 			echo "<option value='' disabled selected>Destino del paquete</option>";
					while ($row = pg_fetch_row($result1)){
			 			echo "<option value='$row[0]'>$row[0]</option>";
				 	}
		 		echo "</select>";

			 	echo "<br><br>";

			 	echo "<input type='submit' name='submit' value='Consultar' class=''>";

			 	echo "<br><br>";

			 	if(isset($_POST['submit'])){
					$origen=$_POST["origen"];
					$destino=$_POST["destino"];

					$f1=0;
					$f2=0;
	
					if(!empty($origen)){
						$f1=1;
					}
					if(!empty($destino)){
						$f2=1;
					}

					if($f1=1 && $f2=1){
						$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' .pg_last_error());

						$query2 = "SELECT * FROM costos WHERE '$destino'=destino AND '$origen'=origen";
						$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
						$rows1 = pg_num_rows($result2);

						if($rows1>0){
							$row = pg_fetch_row($result2);
							$precio = $row[3];
							echo "El precio es: ";
							echo "Q.";
							echo $precio;
							echo ".00";
						}
					}
	 			echo "</div>";
			echo "</form>";
		echo "</center>";

		pg_free_result($result2);
		pg_close($dbconn);
	}

	pg_free_result($result);
	pg_free_result($result1);
	pg_close($dbconn);

?>
</body>
</html>
