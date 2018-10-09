<!DOCTYPE html>
<html>
<head>
	<title>DHL Guatemala | Ingreso de costos</title>
	<?php include 'navbar.php' ?>
</head>	
<body class="fondo6">
	<form class="form-register-costos" method="POST" action="validar_costos.php">
		    <div class="form-row">
		      <div class="form-group col-md-6">
		        <label style="color:white;" for="inputname">Origen</label>
		        <input type="text" class="form-control" id="inputname" placeholder="Nombre del departamento origen" name="origen" required>
		      </div>
		      <div class="form-group col-md-6">
		      	<label style="color:white;" for="inputAddress">Código del departamento</label>
		      	<input type="text" class="form-control" id="inputname" placeholder="Código del departamento origen" name="idd" required>
		      </div>
		    </div>
	     	<div class="form-group col-md-6">
	        	<label style="color:white;" for="inputAddress">Destino</label>
	        	<input type="text" class="form-control" id="inputAddress" placeholder="Nombre del departamento destino" name="destino" required>
	      	</div>
	      	<div class="form-group col-md-6">
	        	<label style="color:white;" for="inputAddress">Código del departamento</label>
	        	<input type="text" class="form-control" id="inputAddress" placeholder="Código del departamento destino" name="ido" required>
	      	</div>

	      	<div class="form-group col-md-6">
		      	<input type="text" class="form-control" id="inputAddress" placeholder="Precio en dos cifras" name="precio" required>
		    </div>
		    <div class="col-md-1"></div>
		    <button type="submit" class="btn btn-primary col-md-4" name="submit">Agregar un nuevo costo</button>
	  </form>
</body>
</html>