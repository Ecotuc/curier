<!DOCTYPE html>
<html>
<head>
	<title>DHL | Guatemala </title>
	<?php include 'navbar.php' ?>
<body class="fondo2">
	<form class="form-register divcenter " method="POST" action="validar_orden.php">
	    <div class="form-row">
	      <div class="form-group col-md-5">
	        <label for="inputname">Destinatario</label>
	        <input type="text" class="form-control" id="inputname" placeholder="Nombre de quien recibe" name="destin" required>
	      </div>
	      <div class="form-group col-md-5">
	        <label for="inputAddress">Dirección</label>
	        <input type="text" class="form-control" id="inputAddress" placeholder="10a Calle 10-30 Z17" name="dir"required>
	      </div>
	    </div>
	    <div class="form-group col-md-5">
	      <label for="inputAddress">Lugar de origen</label>
	      <?php 
	      	$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
	      	$query = "SELECT DISTINCT origen, ido FROM costos";
			$result = pg_query($query) or die('Query failed: ' . pg_last_error());
			echo "<select class='form-control col-md-3' name='origen' required>";
	 				echo "<option value='' disabled selected";
	 				echo ">Origen del paquete</option>";
					while ($row = pg_fetch_row($result)){
			 			echo "<option value='$row[1]'";
			 			if($row[0]==$origen){
			 				echo "selected";
			 			}
			 			echo ">$row[0]</option>";
			 		}
				echo "</select>
					<div class='col-lg-2'></div>";
	      ?>
	    </div>
	    <div class="form-group col-md-5">
	      <label for="inputAddress">Lugar de destino</label>
	      <?php 
	      	$query2 = "SELECT DISTINCT destino, idd FROM costos";
			$result1 = pg_query($query2) or die('Query failed: ' . pg_last_error());
			echo "<select class='form-control col-md-3' name='dest' required>";
	 			echo "<option value='' disabled selected >Destino del paquete</option>";
				while ($row = pg_fetch_row($result1)){
		 			echo "<option value='$row[1]'";
		 			if($row[0]==$destino){
		 				echo "selected";
		 			}
		 			echo ">$row[0]</option>";
			 	}
	 		echo "</select>";
	      ?>
	    </div>
	    <div class="col-md-3"></div>	    
	    <div class="col-md-12"></div>
	    <div class="col-md-4"></div>
	    <button type="submit" class="btn btn-primary col-md-3" name="submit">Crear orden</button>
	</form>
	



	<div class="divcenter2">
		<table>
		  <thead>
			<tr>	
			  <th>Orden</th>
			  <th>Destinatario</th>
			  <th>Dirección</th>
			  <th>Destino</th>
			  <th>Origen</th>
			  <th>Precio</th>
			  <th>Tienda</th>
			</tr>
		  </thead>
		  <tbody>
			<?php
		  		$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
				$query = "SELECT * FROM ordenes ORDER BY tienda,orden DESC";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error()); 
				while ($row = pg_fetch_row($result)){
					// Obtengo el origen de la tienda
					// echo $row[8];
					$query3 = "SELECT ido FROM tienda WHERE nombre='$row[8]'";
					$result3 = pg_query($query3) or die('Query failed: ' . pg_last_error()); 
					$row3=pg_fetch_row($result3);
					// echo $row3[0];
					// Obtengo el precio de la orden
					$query2 = "SELECT precio FROM costos WHERE idd='$row[5]' AND ido='$row3[0]'";
					$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error()); 
					$row2=pg_fetch_row($result2);
				    echo "<tr>
				      <th scope=\"row\">$row[0]</th>
				      <td>$row[1]</td>
				      <td>$row[2]</td>
				      <td>$row[3]</td>
				      <td>$row[4]</td>
				      <td>$row2[0]</td>
				      <td>$row[8]</td>
				    </tr>";
				}
		  	?>
		  	
		  </tbody>
		</table>
	</div>

</body>
</html>