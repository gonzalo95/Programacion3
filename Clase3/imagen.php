<?php
	var_dump($_FILES);

	$origen = $_FILES['imagen']['tmp_name'];
	$destino = "miimagen.jpeg";
	move_uploaded_file($origen, $destino);
?>