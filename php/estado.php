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
	<div >
		<div class="col-lg-4"></div>
		<form class="form-register-status col-lg-8"method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		    <div class="form-row">
		      <div class="form-group col-md-6">
		        <label for="inputname">Nombre</label>
		        <input type="text" class="form-control" id="inputname" placeholder="Número de Orden" name="orden" required>
		      </div>
		      <div class="form-group col-md-5">
		      	<label for="tienda">Selecciona una tienda</label>
			    <?php
				    $dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
					$query = "SELECT * FROM tienda";
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());

				 	echo "<select name='tienda' class='form-control' required>";
			 		echo "<option value='' disabled selected>Tienda</option>";
					while ($row = pg_fetch_row($result)){
					 	echo "<option value='$row[0]'>$row[0]</option>";
					}
					echo "</select>";
			    ?>		      	
		      </div>	      
		    </div>
		    <div class="form-row">
		    	<div class="form-group col-lg-6">
					<button type="submit" class=" btn btn-primary" name="submit">Rastrear pedido</button>	
		    	</div>
		    	<div class="form-group col-lg-6">
					<?php if ($varsesion == 'admin') {
						echo "<button type=\"submit\" class=\" btn btn-primary\" name=\"estado\">Estado siguiente</button>";
					} ?>
		    	</div>
		    </div>
		</form>
		
	</div>


  	
	<?php 
		$string = '100';
		$status = 0;
		$order=$_POST['orden'];
		$tienda=$_POST['tienda'];
		$ch = preg_match_all("/[0-9]/", $order, $matches);
		if(isset($_POST['submit'])){
			if ($ch != 0) {
				$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998")
					or die('Could not connect: ' . pg_last_error());
				$query = "SELECT status FROM ordenes
						  WHERE orden = '$order' AND tienda='$tienda'";
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
								break;
							}
				echo " </div>
					 </div>";
				
			}else{
				echo "<center><strong><h1 style= \"color: red;\">Por favor ingrese un número de orden válido.</strong></h1></center>";
			}

		}elseif ((isset($_POST['estado']))) {
			if ($ch != 0) {
				$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998")
					or die('Could not connect: ' . pg_last_error());
				$query = "SELECT status FROM ordenes
						  WHERE orden = '$order'";
				$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
				$row = pg_fetch_row($result);
				$status = $row[0];
				if ($status==1 || $status==2 || $status==3 || $status==4 || $status==5) {
					$status = (int)$status + 1;

					if ((int)$status >5) {
						echo "<center><strong><h1 style= \"color: red;\">¡El paquete ya ha sido entregado! </strong></h1></center>";
					}elseif ((int)$status >0) {
						$query = "UPDATE ordenes SET status = $status WHERE orden = '$order' ";
						$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
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
										break;
									}
						echo " </div>
							 </div>";
					}else{
						echo "<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" style=\"width:100%\"><h5>No existe ninguna orden asociada a este número de orden</h5></div>";
					}
				}else{
					echo "<div class=\"bp\">
								<div class=\"progress col-lg-10 col-md-7 col-md-5\">";
					echo "<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" style=\"width:100%\"><h5>No existe ninguna orden asociada a este número de orden</h5></div>
							</div>
						</div>";
				}
			}else{
			echo "<center><strong><h1 style= \"color: red;\">Por favor ingrese un número de orden válido.</strong></h1></center>";
			}
		}
	?>	    

</body>
</html>