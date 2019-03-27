<?php
	$array_leidos = array();
	if (!empty($_GET)) 
	{
	$escritura = $_GET["escribir"];
	$f = fopen("archivo.txt", "a");
	fwrite($f, $escritura.PHP_EOL);
	fclose($f);
	}

	$f = fopen("archivo.txt", "r");
	echo "En archivo:".PHP_EOL;
	while (!feof($f)) 
	{
		$leido = fgets($f);
		echo $leido;
		array_push($array_leidos, $leido);
		$csv = explode(";", $array_leidos[0]);	
	}
	fclose($f);

	echo "Nombre: ".$csv[0].PHP_EOL;
	echo "Apellido: ".$csv[1].PHP_EOL;
	echo "DNI: ".$csv[2].PHP_EOL;
	echo "Legajo: ".$csv[3].PHP_EOL;
/*
	echo "En array:".PHP_EOL;
	foreach ($array_leidos as $item) 
	{
		echo $item;
	}

	$array_leidos[0] = "4321".PHP_EOL;

	echo "Modificado:".PHP_EOL;
	foreach ($array_leidos as $item) 
	{
		echo $item;
	}

	$f = fopen("archivo.txt", "w");
	foreach ($array_leidos as $item) 
	{
		fwrite($f, $item.PHP_EOL);
	}
	fclose($f);
*/


?>