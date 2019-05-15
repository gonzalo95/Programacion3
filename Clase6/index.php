<?php
	include_once "Clases/Alumno.php";
	include_once "Clases/AlumnoDAO.php";
	include_once "Clases/AccesoDatos.php";

	$request = $_SERVER['REQUEST_METHOD'];

	switch ($request) 
	{
		case 'POST':
			switch ($_POST['caso']) 
			{
				case 'alta':
					$alumno = new Alumno($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['legajo']);
					$alumno->guardar();
					break;

				case 'baja':
				Alumno::eliminar($_POST['legajo']);
					break;

				case 'modificar':
					Alumno::modificar($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['legajo']);
					break;

				case 'traer uno':
					var_dump( Alumno::traerUno($_POST['legajo']) );
					break;

				case 'traer todos':
					var_dump( Alumno::traerTodos() );
					break;

				default:
					echo "Caso invalido";
					break;
			}
			break;
	}
?>