<?php

	$destinov = $_GET['destino'];
	$formato = $_GET['formato'];
	$formato = strtolower($formato);
	$courrierv = "DHL";
	$coberturav = "FALSE";
	$costov = "0";

		$xml= new DomDocument('1.0');
		$xml->formatOutput=true;

		$consulta=$xml->createElement("consultaprecio");
		$xml->appendChild($consulta);

		$courier=$xml->createElement("courier", $courrierv);
		$consulta->appendChild($courier);

		$destino=$xml->createElement("destino", $destinov);
		$consulta->appendChild($destino);

		$cobertura=$xml->createElement("cobertura", $coberturav);
		$consulta->appendChild($cobertura);

		$costo=$xml->createElement("costo",$costov);
		$consulta->appendChild($costo);

		echo "<xmp>".$xml->saveXML()."</xmp>";
?>