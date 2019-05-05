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
				case 'consultarVehiculo':
					echo Vehiculo::consultarVehiculo($csvVehiculos, $_GET['parametro']);
					break;
				
				case 'sacarTurno':
					Turno::sacarTurno($csvVehiculos, $csvServicios, $csvTurnos, $_GET['patente'], $_GET['fecha'], $_GET['tipoServicio']);
					break;

				case 'turnos':
					echo Turno::mostrarTurnos($csvTurnos);
					break;

				case 'inscripciones':
					echo Turno::mostrarInscripciones($csvTurnos, $_GET['parametro']);
					break;

				case 'vehiculos':
					echo Vehiculo::mostrar($csvVehiculos);
					break;

				default:
					echo "Caso invalido";
					break;
			}
			break;
		
		case 'POST':
			switch ($_POST['caso']) 
			{
				case 'cargarVehiculo':
					$vehiculo = new Vehiculo($_POST['marca'], $_POST['modelo'], $_POST['patente'], $_POST['precio']);
					Vehiculo::guardar($csvVehiculos, $vehiculo);
					break;
				
				case 'cargarTipoServicio':
					$servicio = new Servicio($_POST['id'], $_POST['tipo'], $_POST['precio'], $_POST['demora']);
					Servicio::cargarServicio($csvServicios, $servicio);
					break;

				case 'modificarVehiculo':
					Vehiculo::modificar($csvVehiculos, $_POST['patente'], $_POST['marca'], $_POST['modelo'], $_POST['precio']);
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