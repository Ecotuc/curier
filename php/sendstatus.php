<?php

	error_reporting(0);

	$orden = $_GET['orden'];
	$tienda = $_GET['tienda'];
	$formato = $_GET['formato'];
	$inTouch = isset($formato);
	if($inTouch==TRUE){
		$formato = strtolower($formato);
	}
	$courrier = "DHL";

	$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

	$query = "SELECT status FROM ordenes WHERE orden='$orden' AND tienda='$tienda'";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	$row = pg_fetch_row($result);

	$status = $row[0];

	if(($formato=='xml')||($inTouch==FALSE)){
		//$xml= new DomDocument('1.0');
		//$xml->formatOutput=true;

		//$consulta=$xml->createElement("consultaprecio");
		//$xml->appendChild($consulta);

		//$courrier=$xml->createElement("courrier", $courrierv);
		//$consulta->appendChild($courrier);

		//$destino=$xml->createElement("destino", $destinov);
		//$consulta->appendChild($destino);

		//$cobertura=$xml->createElement("cobertura", $coberturav);
		//$consulta->appendChild($cobertura);

		//$costo=$xml->createElement("costo",$costov);
		//$consulta->appendChild($costo);

		//echo "<xmp>".$xml->saveXML()."</xmp>";

		$xml = "<orden>\n";
		$xml = $xml . "\t<courrier>" . $courrier . "</courrier>\n";
		$xml = $xml . "\t<orden>" . $orden . "</orden>\n";
		$xml = $xml . "\t<status>" . $status . "</status>\n";
		$xml = $xml . "</orden>";

		echo $xml;

	} else if($formato=='json'){
		$json = "{\"orden\" :\n";
		$json = $json . "\t{\"courrier\" : \"". $courrier ."\" ,\n";
		$json = $json . "\t \"orden\" : \"". $orden ."\" ,\n";
		$json = $json . "\t \"status\" : \"".$status."\" ,\n\t \"costo\" : \"".$costov."\"\n\t}\n}";

		echo $json;

	}
	
?>