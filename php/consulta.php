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

	$query = "SELECT * FROM costos WHERE idd='$destinov' AND ido = '01000'";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	$count = pg_num_rows($result);
	if($count==0){

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

			$xml = "<consultaprecio>\n";
			$xml = $xml . "\t<courrier>" . $courrierv . "</courrier>\n";
			$xml = $xml . "\t<destino>" . $destinov . "</destino>\n";
			$xml = $xml . "\t<cobertura>" . $coberturav . "</cobertura>\n";
			$xml = $xml . "\t<costo>" . $costov . "</costo>\n";
			$xml = $xml . "</consultaprecio>";

			echo $xml;

		} else if($formato=='json'){
			$json = "{\"consultaprecio\" :\n";
			$json = $json . "\t{\"courrier\" : \"". $courrierv ."\" ,\n";
			$json = $json . "\t \"destino\" : \"". $destinov ."\" ,\n";
			$json = $json . "\t \"cobertura\" : \"".$coberturav."\" ,\n\t \"costo\" : \"".$costov."\"\n\t}\n}";

			echo $json;
		}

	} else {
		$coberturav="TRUE";
		$row = pg_fetch_row($result);
		$costov = $row[4];

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

			$xml = "<consultaprecio>\n";
			$xml = $xml . "\t<courrier>" . $courrierv . "</courrier>\n";
			$xml = $xml . "\t<destino>" . $destinov . "</destino>\n";
			$xml = $xml . "\t<cobertura>" . $coberturav . "</cobertura>\n";
			$xml = $xml . "\t<costo>" . $costov . "</costo>\n";
			$xml = $xml . "</consultaprecio>";

			echo $xml;

		} else if($formato=='json'){

			$json = "{\"consultaprecio\" :\n";
			$json = $json . "\t{\"courrier\" : \"". $courrierv ."\" ,\n";
			$json = $json . "\t \"destino\" : \"". $destinov ."\" ,\n";
			$json = $json . "\t \"cobertura\" : \"".$coberturav."\" ,\n\t \"costo\" : \"".$costov."\"\n\t}\n}";

			echo $json;

		}

	}
	
	
	

	
?>