<?php
    require "Persona.php";
    
    class Alumno extends Persona {
        public $legajo;

        public function __construct($nombre = "", $apellido = "", $dni = 0, $legajo = 0){
            parent::__construct($nombre, $apellido, $dni);
            $this->legajo = $legajo; 
        }
    }
?>