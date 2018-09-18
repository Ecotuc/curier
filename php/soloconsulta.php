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

	if($formato=='json'){
		$json = "{\"consultaprecio\" :\n";
		$json = $json . "\t{\"courrier\" : \"FeDex\" ,\n";
		$json = $json . "\t \"destino\" : \"". $destino ."\" ,\n";
		$json = $json . "\t \"cobertura\" : \"TRUE\" ,\n\t \"costo\" : \"".$costo."\"\n\t}\n}";
	}

	echo $json;
?>