<?php

	error_reporting(0);

	$destinov = $_GET['destino'];
	$formato = $_GET['formato'];
	$inTouch = isset($formato);
	if($inTouch==TRUE){
		$formato = strtolower($formato);
	}
	$courrierv = "DHL";
	$coberturav = "FALSE";
	$costov = "0";

	$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

	$query = "SELECT * FROM costos WHERE idd='$destino' AND ido = '01000'";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	$count = pg_num_rows($result);
	if($count==0){

		if(($formato=='xml')||($inTouch==FALSE)){
			$xml= new DomDocument('1.0');
			$xml->formatOutput=true;

			$consulta=$xml->createElement("consultaprecio");
			$xml->appendChild($consulta);

			$courrier=$xml->createElement("courrier", $courrierv);
			$consulta->appendChild($courrier);

			$destino=$xml->createElement("destino", $destinov);
			$consulta->appendChild($destino);

			$cobertura=$xml->createElement("cobertura", $coberturav);
			$consulta->appendChild($cobertura);

			$costo=$xml->createElement("costo",$costov);
			$consulta->appendChild($costo);

			echo "<xmp>".$xml->saveXML()."</xmp>";
		} else if($formato=='json'){
			
		}

	} else {
		$coberturav="TRUE";
		$row = pg_fetch_row($result);
		$costov = $row[4];

		if(($formato=='xml')||($inTouch==FALSE)){
			$xml= new DomDocument('1.0');
			$xml->formatOutput=true;

			$consulta=$xml->createElement("consultaprecio");
			$xml->appendChild($consulta);

			$courrier=$xml->createElement("courrier", $courrierv);
			$consulta->appendChild($courrier);

			$destino=$xml->createElement("destino", $destinov);
			$consulta->appendChild($destino);

			$cobertura=$xml->createElement("cobertura", $coberturav);
			$consulta->appendChild($cobertura);

			$costo=$xml->createElement("costo",$costov);
			$consulta->appendChild($costo);

			echo "<xmp>".$xml->saveXML()."</xmp>";
		} else if($formato=='json'){

		}

	}
	
	
	

	
?>