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

		
			if (!empty($ordenv)) {
				echo "<orden>";
				echo "\t<courrier>",$courrier,"</courrier>";
				echo "\t<orden>",$ordenv,"</orden>";
				echo "\t<status>",$statusv,"</status>";
				echo "</orden>";
			}else{
				echo "Archivo vacio";
			}
			// Header('Content-type: text/xml');
			// print($xml->asXML());

	} else if($formato=='json'){
		$json = "{\"orden\" :\n";
		$json = $json . "\t{\"courrier\" : \"". $courrierv ."\" ,\n";
		$json = $json . "\t \"orden\" : \"". $ordenv ."\" ,\n";
		$json = $json . "\t \"status\" : \"".$statusv."\"\n\t}\n}";
		echo $json;

	}
	
?>