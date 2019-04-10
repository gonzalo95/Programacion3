<?php
    require "persona.php";
    
    class Alumno extends Persona 
    {
        public $legajo;
        public function __construct($nombre = "", $apellido = "", $dni = 0, $legajo = 0)
        {
            parent::__construct($nombre, $apellido, $dni);
            $this->legajo = $legajo; 
        }
        public function to_csv()
        {
        	$csv = $this->nombre.";".$this->apellido.";".$this->dni.";".$this->legajo;
        	return $csv;
        }
        public function to_json()
        {
        	return json_encode($this);
        }

        public static function insertar_alumno()
        {
            $alumno = new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["dni"], $_POST["legajo"]);
            $archivo = $_POST['archivo'];
            $json = json_encode($alumno);
            $f = fopen($archivo, 'a');
            fwrite($f, $json);
            fclose($f);
        }

        public static function traer_alumnos()
        {
            //$alumnos = array();
            //$archivo = $_GET['archivo'];
            //$f = fopen($archivo, 'a');
            //$alumnos = fread($f, filesize($archivo))
            //fclose($f);
            //return $alumnos;
        }
    }
?>