<?php
    require ".\Clases\Alumno.php";
    $alumnos = array();

    //echo $_server['REQUEST_METHOD']
    
    switch (getenv('REQUEST_METHOD')) 
    {
        case 'GET':
            $alumno = new Alumno($_GET["nombre"], $_GET["apellido"], $_GET["dni"], $_GET["legajo"]);
            array_push($alumnos, $alumno);
            break;

        case 'POST':
            # code...
            break;

        case 'PUT':
            $archivo = $_PUT['archivo'];
            $json = json_encode($alumnos);
            $f = fopen($archivo, 'a');
            fwrite($f, $json);
            fclose($f);
            break;

        case 'DELETE':
            # code...
            break;
                
        default:
            echo "Error";
            break;
    }

    //var_dump($alumnos);

    $f = fopen("data.json", "a");
	fwrite($f,json_encode($alumnos));
	fclose($f);
    
    /*
    echo $alumno->to_csv();
    echo "<br>";
    echo $alumno->to_json();
    
    var_dump($alumno);
    $datos = array($alumno->nombre, $alumno->apellido, $alumno->dni, $alumno->legajo);
    echo join(";", $datos);
    echo $alumno->nombre.";".$alumno->apellido.";".$alumno->dni.";".$alumno->legajo;
    */
?>