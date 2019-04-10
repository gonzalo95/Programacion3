<?php
	require ".\alumno.php";
	$alumnos = array();

	$consulta = getenv('REQUEST_METHOD');

	switch ($consulta) {
		case 'GET':
            //$alumnos = alumno.traer_alumnos();

            //$archivo = $_GET['archivo'];
            //$f = fopen($archivo, 'a');
            //$alumnos = fread($f, filesize($archivo))
            //fclose($f);
			break;
		
		case 'POST':
			//alumno.insertar_alumno();

			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$dni = $_POST["dni"];
			$legajo = $_POST["legajo"];

			$alumno = new Alumno($nombre, $apellido, $dni, $legajo);
            $archivo = $_POST['archivo'];
            $json = json_encode($alumno);
            $f = fopen($archivo, 'a');
            fwrite($f, $json);
            fclose($f);

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

			break;

		case 'PUT':
			
			break;

		case 'DELETE':
			
			break;

		default:
			echo("Opcion invalida");
			break;
	}
?>