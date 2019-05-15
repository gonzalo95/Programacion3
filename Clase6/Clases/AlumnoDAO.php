<?php
	include_once "Alumno.php";

	Class AlumnoDAO
	{
		public static function guardarAlumno($obj)
		{
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO alumnos (nombre, apellido, dni, legajo)"
	                                                    . "VALUES(:nombre, :apellido, :dni, :legajo)");
	        
	        $consulta->bindValue(':nombre', $obj->nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':apellido', $obj->apellido, PDO::PARAM_STR);
	        $consulta->bindValue(':dni', $obj->dni, PDO::PARAM_INT);
	        $consulta->bindValue(':legajo', $obj->legajo, PDO::PARAM_INT);

	        $consulta->execute();
		}

		public static function eliminarAlumno($legajo)
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM alumnos WHERE legajo = :legajo");
	        
	        $consulta->bindValue(':legajo', $legajo, PDO::PARAM_INT);

	        return $consulta->execute();
	    }

	    public static function modificarAlumno($nombre, $apellido, $dni, $legajo)
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE alumnos SET nombre = :nombre, apellido = :apellido, 
	                                                        dni = :dni WHERE legajo = :legajo");
	        
	        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':apellido', $apellido, PDO::PARAM_STR);
	        $consulta->bindValue(':dni', $dni, PDO::PARAM_INT);
	        $consulta->bindValue(':legajo', $legajo, PDO::PARAM_INT);

	        return $consulta->execute();
	    }

	    public static function traerTodosAlumnos()
	    {
	    	/*
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM alumnos");

	        $consulta->execute();

	        return $consulta->fetchAll(PDO::FETCH_NUM);
	        */

	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM alumnos");

	        $consulta->execute();

	        return $consulta->fetchAll(PDO::FETCH_CLASS, "Alumno");	        
	    }

	    public static function traerAlumno($legajo)
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM alumnos WHERE legajo = :legajo");

	        $consulta->bindValue(':legajo', $legajo, PDO::PARAM_INT);

	        $consulta->execute();

	        return $consulta->fetchAll(PDO::FETCH_NUM);
	    }
	}
?>