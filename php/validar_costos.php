<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>DHL | Guatemala | <?php echo $varsesion; ?></title>
		<link href="../css/estilo.css" rel="stylesheet" type="text/css">
		<link rel="icon" type="imgage/png" href="../images/tab_logo.png" sizes="32x32">
		<?php include 'navbar.php' ?>
	</head>
	

<?php

	$origen=$_POST['origen'];
	$idd=$_POST['idd'];
	$destino=$_POST['destino'];
	$ido=$_POST['ido'];
	$precio=$_POST['precio'];
	if(isset($_POST['submit'])){
		$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998")
			or die('Could not connect: ' . pg_last_error());
		$query = "INSERT INTO costos VALUES('$idd', '$ido', '$destino', '$origen', '$precio')";
		$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
		if($result){
			pg_free_result($result);
			pg_close($dbconn);
			echo "Costo agregado con éxito";
			 header("location:tiendas.php");
		}else {
			pg_free_result($result);
			pg_close($dbconn);
			echo "Por favor inténtelo de nuevo más tarde.";
			echo "<script>
            		setTimeout(function() {
                    location.href = 'costos.php';
            		}, 2000);
        			</script>";
			
		}



	}
?>

</html>
