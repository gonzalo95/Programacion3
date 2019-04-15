<?php
    require ".\Clases\Alumno.php";
    $alumnos = array();

    //echo $_server['REQUEST_METHOD']
    
    switch (getenv('REQUEST_METHOD')) 
    {
        case 'GET':
        	$archivo = $_GET['archivo'];
        	$f = fopen($archivo, 'r');
            $leido = fread($f, filesize($archivo));
            $alumnos = json_decode($leido, true);
            fclose($f);
            var_dump($alumnos);
            break;

        case 'POST':
            $alumno = new Alumno($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['legajo']);
            array_push($alumnos, $alumno);
            $archivo = $_POST['archivo'];
            $json = json_encode($alumnos);
            $f = fopen($archivo, 'a');
            fwrite($f, $json);
            fclose($f);
            break;

        case 'PUT':

            break;

        case 'DELETE':
            # code...
            break;
                
        default:
            echo "Error";
            break;
    }
?>