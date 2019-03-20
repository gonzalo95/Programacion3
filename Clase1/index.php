<?php
    require ".\Clases\Alumno.php";

    $nombre = "Gonzalo";
    $legajo = 111;
    $lista = array(9, 1, 2, 3, 4, 5, 6);
    // $heroes = array(1, 2, 3, 4);
    // $heroes[] = 22;
    // $heroes[22] = 22;
    
    $heroes = array("nombre" => "batman", "superpoder" => "batimobil");    
    $heroes["superman"] = "volar";
    $heroes["acuaman"] = "nadar";
    
    echo "$nombre $legajo<br>";
    echo "Hola php<br>";

    var_dump($heroes);

    foreach($heroes as $item){
        echo "<br>";
        echo $item;
    }


    if($_GET["orden"] == 1){
        sort($lista);
    }
    else if ($_GET["orden"] == 0){
        shuffle($lista);
    }

    foreach($lista as $valor){
        echo "<br>";
        echo $valor;
    }

    echo "<br>";

    //var_dump($_GET);
    //var_dump($_POST);

    $persona = array("name" => "pepe");
    var_dump($persona);
    echo $persona["name"];
    echo "<br>";
    $persona0 = (object)$persona;
    var_dump($persona0);
    $persona0->name = "Gonzalo";
    $personaSTD = new stdclass();
    $personaSTD-> name = "Gonzalo";
    echo "<br>";
    var_dump($personaSTD);
    
    echo "<br>";
    echo "<br>";

    $alumno = new Alumno($_GET["nombre"], $_GET["apellido"], $_GET["dni"], $_GET["legajo"]);
    var_dump($alumno);

?>