<!DOCTYPE html>
<html>
<head>
	<title>DHL Guatemala | Ingreso de tiendas</title>
	<?php include 'navbar.php' ?>
	<link href="../css/et.css" rel="stylesheet" type="text/css">
<body class="fondo3">
  <div class="tabla">
	  <form class="form-register-tiendas" method="POST" action="validar_tienda.php">
		    <div class="form-row">
		      <div class="form-group col-md-6">
		        <label for="inputname">Nombre</label>
		        <input type="text" class="form-control" id="inputname" placeholder="Nombre de la tienda" name="nombre" required>
		      </div>
		      <div class="form-group col-md-6">
		      <label for="inputAddress">Departamento al que pertenece</label>
		      <select id="inputmunicipio" class="form-control col-md-3" name="dest">
		      	<option value="Guatemala" selected>Guatemala</option>
		        <option value="Chimaltenango">Chimaltenango</option>
		        <option value="Sacatepequez">Sacatepequez</option>
		        <option value="Escuintla">Escuintla</option>
		        <option value="Retahuleu">Retahuleu</option>
		        <option value="San Marcos">San Marcos</option>
		        <option value="Suchitepequez">Suchitepequez</option>
		      </select>
		    </div>
		    </div>
		    <div class="form-group col-md-6">
		        <label for="inputAddress">Dirección</label>
		        <input type="text" class="form-control" id="inputAddress" placeholder="10a Calle 10-30 Z17" name="dir" required>
		    </div>
		    <div class="form-group col-md-6">
		    	<label for="inputAddress">Origen</label>
		        <input type="text" class="form-control" id="inputAddress" placeholder="Ej: 01001" name="ido" required>
		    </div>	    
		    <div class="col-md-12"></div>
		    <div class="form-group col-md-4">
		    	<button type="submit" class="btn btn-primary" name="submit">Agregar nueva tienda</button>
		    </div>
	  </form>
	  <div>
	  <table>
			<thead>
			  <tr>	
			   <th>Tienda</th>
			   <th>Dirección</th>
			   <th>Código Origen</th>
			   <th>Origen</th>
			  </tr>
			</thead>
			<tbody>
			  <?php
			  	$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
				$query = "SELECT * FROM tienda";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error()); 
				while ($row = pg_fetch_row($result)){
				    echo "<tr>
				      <th scope=\"row\">$row[0]</th>
				      <td>$row[1]</td>
				      <td>$row[2]</td>
				      <td>$row[3]</td>
				    </tr>";
				}
			  ?> 	
			</tbody>
	  </table>
  </div>


</body>
</html>