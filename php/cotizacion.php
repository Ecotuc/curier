<?php
	session_start();
	error_reporting(0);
	$varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion == ''){
		$varsesion= 'local';
	}
	$cualquiera= 1;
?>
<!DOCTYPE html>
<html>
<head>
	<title>DHL Guatemala | Cotización</title>
	<?php include'navbar.php' ?>
<body class="fondo5">
	<?php

		error_reporting(0);

		$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
		$query = "SELECT DISTINCT origen FROM costos";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$query2 = "SELECT DISTINCT destino FROM costos";
		$result1 = pg_query($query2) or die('Query failed: ' . pg_last_error());

			echo "<form action='",htmlspecialchars($_SERVER['PHP_SELF']), "' method='post' class='form_cot'>" ;

			echo "<center>";
				echo "<h2 class=''>Aquí podrá ver los precios del envío desde el orígen al destino.Si no aparece el depertamento que busca, significa que aún no tenemos cobertura en ese lugar, pero estamos trabajando en ello.</h2>
			 	<div class=''></center>";
			 	echo "<div class=\"form-row new\">";
			 	echo "<select class='col-lg-5' name='origen' sytle=\"height: 25px;\" required>";
	 				echo "<option value='' disabled selected>Origen del paquete</option>";
					while ($row = pg_fetch_row($result)){
			 			echo "<option value='$row[0]'>$row[0]</option>";
			 		}
				echo "</select>
					<div class='col-lg-2'></div>";
						 
				echo "<select class='col-lg-5' name='destino' sytle=\"height: 25px;\"  required>";
		 			echo "<option value='' disabled selected>Destino del paquete</option>";
					while ($row = pg_fetch_row($result1)){
			 			echo "<option value='$row[0]'>$row[0]</option>";
				 	}
		 		echo "</select>";
		 		echo "</div>";
			 	echo "<br><br>";

			 	echo "<center><input type='submit' name='submit' value='Consultar' class='btn btn-primary'></center>";

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
							$precio = $row[4];
							echo "El precio es: ";
							echo "Q.";
							echo $precio;
							echo ".00";
						}
					}
	 			echo "</div>";
			echo "</form>";

		pg_free_result($result2);
		pg_close($dbconn);
	}

	pg_free_result($result);
	pg_free_result($result1);
	pg_close($dbconn);

?>

</body>
</html>
