<?php

	error_reporting(0);

	$ordenv = $_GET['orden'];
	$tiendav = $_GET['tienda'];
	$tiendav = strtolower($tiendav);
	$formato = $_GET['formato'];
	$inTouch = isset($formato);
	if($inTouch==TRUE){
		$formato = strtolower($formato);
	}
	$courrierv = "DHL";

	$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

	$query = "SELECT status FROM ordenes WHERE orden='$ordenv' AND tienda='$tiendav'";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	$row = pg_fetch_row($result);

	$statusv = $row[0];

	if(($formato=='xml')||($inTouch==FALSE)){
		$xml= new DomDocument('1.0');
		$xml->formatOutput=true;

		$orden=$xml->createElement("orden");
		$xml->appendChild($orden);

		$courrier=$xml->createElement("courrier", $courrierv);
		$orden->appendChild($courrier);

		$numero=$xml->createElement("orden", $ordenv);
		$orden->appendChild($numero);

		$status=$xml->createElement("status", $statusv);
		$orden->appendChild($status);

		echo "<xmp>".$xml->saveXML()."</xmp>";

	} else if($formato=='json'){
		$json = "{\"orden\" :\n";
		$json = $json . "\t{\"courrier\" : \"". $courrier ."\" ,\n";
		$json = $json . "\t \"orden\" : \"". $orden ."\" ,\n";
		$json = $json . "\t \"status\" : \"".$status."\"\n\t}\n}";

		echo $json;

	}
	
?>