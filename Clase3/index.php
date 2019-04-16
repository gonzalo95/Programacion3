<?php
	require ".\alumno.php";

    $ext = $_FILES['imagen']['name'];

    $ext = explode('.', $ext);

    var_dump($ext);

    $indice = count($ext) - 1;

    $origen = $_FILES['imagen']['tmp_name'];
	$destino = $apellido.$legajo;
	
	if (file_exists('.\fotos\\'.$destino.'.'.$ext[$indice])) 
	{
		$contador = 1;
		while (file_exists('.\backup\\'.$destino.'bkup'.$contador.'.'.$ext[$indice])) 
		{
			$contador++;
		}
		move_uploaded_file($origen, '.\backup\\'.$destino.'bkup'.$contador.'.'.$ext[$indice]);
	}

	move_uploaded_file($origen, '.\fotos\\'.$destino.'.'.$ext[$indice]);


	/*
	$estampa = imagecreatefrompng('marca_de_agua.png');
	$im = imagecreatefromjpeg('foto.jpg');
	
	$margen_dcho = 10;
	$margen_inf = 10;
	$sx = imagesx($estampa);
	$sy = imagesy($estampa);

	imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));

	header('Content-type: image/png');
	imagepng($im);
	imagedestroy($im);
	*/
?>