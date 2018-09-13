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
	<title>DHL Guatemala | Tracking</title>
	<?php include "navbar.php" ?>
<body class="fondo4">

	<form class="form-register-tiendas"method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	  <div>
	    <div class="col-lg-5 row">
	      <input type="text" class="form-control" placeholder="Número de Orden" name="orden">
	    </div>
	    <div class="col-lg-2"></div>
		<button type="submit" class=" btn btn-primary col-lg-5 col-md-2" name="submit">Rastrear pedido</button>
	  </div>
	</form>
	<br><br><br><br><br><br>
  	
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
				echo "<div class=\"bp\">
						<div class=\"progress col-lg-10 col-md-7 col-md-5\">";
							switch ($status) {
								case 1:
									echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" style=\"width:20%\"><h5>Orden nueva</h5></div>";
									break;
								case 2:
									echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" style=\"width:20%\"><h5>Orden nueva</h5></div>
									<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" style=\"width:20%\"><h5>Surtiéndose</h5></div>";
									break;
								case 3:
									echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" style=\"width:20%\"><h5>Orden nueva</h5></div>
									<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" style=\"width:20%\"><h5>Surtiéndose</h5></div>
									<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" style=\"width:20%\"><h5>Empacándose</h5></div>";
									break;
								case 4:
									echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" style=\"width:20%\"><h5>Orden nueva</h5></div>
									<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" style=\"width:20%\"><h5>Surtiéndose</h5></div>
									<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" style=\"width:20%\"><h5>Empacándose</h5></div>
									<div class=\"progress-bar progress-bar-route\" role=\"progressbar\" style=\"width:20%\"><h5>En ruta</h5></div>";
									break;
								case 5:
									echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" style=\"width:20%\"><h5>Orden nueva</h5></div>
									<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" style=\"width:20%\"><h5>Surtiéndose</h5></div>
									<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" style=\"width:20%\"><h5>Empacándose</h5></div>
									<div class=\"progress-bar progress-bar-route\" role=\"progressbar\" style=\"width:20%\"><h5>En ruta</h5></div>
									<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" style=\"width:20%\"><h5>Entregada</h5></div>";
									break;
								default:
									echo "<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" style=\"width:100%\"><h5>No existe ninguna orden asociada a este número de orden</h5></div>";

							}
				echo " </div>
					 </div>";
			}
		?>	    







	



</body>
</html>