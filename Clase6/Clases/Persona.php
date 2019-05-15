<?php
    require "Humano.php";

    class Persona extends Humano {
        public $dni;

        public function __construct($nombre = "", $apellido = "", $dni = 0){
            parent::__construct($nombre, $apellido);
            $this->dni = $dni;
        }
    }
?>