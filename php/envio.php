<?php

	error_reporting(0);

	$orden = $_GET['orden'];
	$destinatario = $_GET['destinatario'];
	$idd = $_GET['destino'];
	$direccion = $_GET['direccion'];
	$tienda = $_GET['tienda'];

	$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

	$query0 = "SELECT * FROM tienda WHERE tienda='$tienda'";
	$result0 = pg_query($query0) or die ('Query failed: ' . pg_last_error());
	$row = pg_fetch_row($result0);
	$origen = $row[1];
	$ido = $row[2];

	$query1 = "SELECT destino FROM costos WHERE idd ='$idd'";
	$result1 = pg_query($query1) or die ('Query failed: ' . pg_last_error());
	$row1 = pg_fetch_row($result1);
	$destino = $row[0];

	$query = "INSERT INTO ordenes(orden, destinatario, direccion, destino, origen, idd, ido, status, tienda) VALUES ('$orden', '$destinatario', '$direccion', '$destino', '$origen', '$idd'. '$ido', '1', '$tienda')";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	
?>