<?php
    require ".\Clases\Alumno.php";
    //$_server
    $alumnos = array();
    $alumno = new Alumno($_GET["nombre"], $_GET["apellido"], $_GET["dni"], $_GET["legajo"]);
    array_push($alumnos, $alumno);

    var_dump($alumnos);

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