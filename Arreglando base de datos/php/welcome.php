<!DOCTYPE html>
<html>
<head>
	<title>DHL | Guatemala </title>
	<?php include 'navbar.php' ?>
<body class="fondo2">
	
	<form class="form-register" method="POST" action="validar_orden.php">
	    <div class="form-row">
	      <div class="form-group col-md-6">
	        <label for="inputname">Destinatario</label>
	        <input type="text" class="form-control" id="inputname" placeholder="Nombre de quien recibe" name="destin">
	      </div>
	      <div class="form-group col-md-6">
	        <label for="inputAddress">Dirección</label>
	        <input type="text" class="form-control" id="inputAddress" placeholder="10a Calle 10-30 Z17" name="dir">
	      </div>
	    </div>
	    <!-- <div class="col-md-3"></div> -->
	    <div class="form-group col-md-6">
	      <label for="inputAddress">Lugar de destino</label>
	      <select id="inputmunicipio" class="form-control col-md-3" name="dest">
	      	<option value="01000" selected>Guatemala</option>
	        <option value="04000">Chimaltenango</option>
	        <option value="03000">Sacatepequez</option>
	        <option value="05000">Escuintla</option>
	        <option value="11000">Retahuleu</option>
	        <option value="12000">San Marcos</option>
	        <option value="10000">Suchitepequez</option>
	      </select>
	    </div>
	    <div class="col-md-3"></div>	    
	    <div class="col-md-12"></div>
	    <div class="col-md-4"></div>
	    <button type="submit" class="btn btn-primary col-md-3" name="submit">Crear orden</button>
	</form>

</body>
</html>