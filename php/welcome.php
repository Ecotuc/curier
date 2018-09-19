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
	    <div class="form-group col-md-6">
	      <label for="inputAddress">Lugar de destino</label>
	      <select id="inputmunicipio" class="form-control col-md-3" name="dest">
	      	<option value="01001" selected>Guatemala</option>
	        <option value="04001">Chimaltenango</option>
	        <option value="03001">Sacatepequez</option>
	        <option value="05001">Escuintla</option>
	        <option value="11001">Retahuleu</option>
	        <option value="12001">San Marcos</option>
	        <option value="10001">Suchitepequez</option>
	      </select>
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
			</tr>
		  </thead>
		  <tbody>
			<?php
		  		$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
				$query = "SELECT * FROM ordenes ORDER BY orden DESC";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error()); 
				while ($row = pg_fetch_row($result)){
				    echo "<tr>
				      <th scope=\"row\">$row[0]</th>
				      <td>$row[1]</td>
				      <td>$row[2]</td>
				      <td>$row[3]</td>
				      <td>$row[4]</td>
				    </tr>";
				}
		  	?>
		  	
		  </tbody>
		</table>
	</div>

</body>
</html>