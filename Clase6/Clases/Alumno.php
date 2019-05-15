<?php
    require "Persona.php";
    include_once "AlumnoDAO.php";

    class Alumno 
    {
        public $legajo;
        public $dni;
        public $nombre;
        public $apellido;

/*
        public function __construct($nombre = "", $apellido = "", $dni = 0, $legajo = 0)
        {
            parent::__construct($nombre, $apellido, $dni);
            $this->legajo = $legajo; 
        }
*/
        public function to_csv()
        {
        	$csv = $this->nombre.";".$this->apellido.";".$this->dni.";".$this->legajo;
        	return $csv;
        }

        public function to_json()
        {
        	return json_encode($this);
        }

        public function guardar()
        {
            AlumnoDAO::guardarAlumno($this);
        }

        public static function eliminar($legajo)
        {
            AlumnoDAO::eliminarAlumno($legajo);
        }

        public static function modificar($nombre, $apellido, $dni, $legajo)
        {
            AlumnoDAO::modificarAlumno($nombre, $apellido, $dni, $legajo);
        }

        public static function traerTodos()
        {
            return AlumnoDAO::traerTodosAlumnos();
        }

        public static function traerUno($legajo)
        {
           return AlumnoDAO::traerAlumno($legajo);
        }
    }
?>