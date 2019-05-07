<?php
	include_once "vehiculo.php";
	include_once "servicio.php";
	include_once "turno.php";

	$csvVehiculos = "vehiculos.txt";
	$csvServicios = "tiposServicio.txt";
	$csvTurnos = "turnos.txt";

	$request = $_SERVER['REQUEST_METHOD'];

	switch ($request) 
	{
		case 'GET':
			switch ($_GET['caso'])
			{
				case '':
					break;

				default:
					echo "Caso invalido";
					break;
			}
			break;
		
		case 'POST':
			switch ($_POST['caso']) 
			{
				case '':
					break;

				default:
					echo "Caso invalido";
					break;
			}
			break;
		
		default:
			echo "Request invalida";
			break;
	}

?>