<?php
	include_once "vehiculo.php";
	include_once "servicio.php";

	class Turno
	{
		public $fecha;
		public $patente;
		public $marca;
		public $modelo;
		public $precio;
		public $tipo;

		public function __construct($fecha, $patente, $marca, $modelo, $precio, $tipo)
		{
			$this->fecha = $fecha;
			$this->patente = $patente;
			$this->marca = $marca;
			$this->modelo = $modelo;
			$this->precio = $precio;
			$this->tipo = $tipo;
		}

		public function toCsv()
		{
			$csv = $this->fecha.';'.$this->patente.';'.$this->marca.';'.$this->modelo.';'.$this->precio.';'.$this->tipo;
			return $csv;
		}

		public static function guardarTurno($dir, $obj)
		{
			$f = fopen($dir, 'a');
			$string = $obj->toCsv().PHP_EOL;
			fwrite($f, $string);
			fclose($f);
		}

		public static function sacarTurno($dirVehiculos, $dirServicios, $dirTurnos, $patente, $fecha, $tipo)
		{
			$arrayVehiculos = Vehiculo::leerArray($dirVehiculos);
			$arrayServicios = Servicio::leerArray($dirServicios);

			foreach ($arrayVehiculos as $vehiculo) 
			{
				if ($vehiculo->patente == $patente) 
				{
					foreach ($arrayServicios as $servicio) 
					{
						if ($servicio->tipo == $tipo) 
						{
							Turno::guardarTurno($dirTurnos, new Turno($fecha, $patente, $vehiculo->marca, $vehiculo->modelo, $servicio->precio, $tipo));
						}
					}
				}
			}
		}

		public static function leerArray($dir)
		{
			if (file_exists($dir)) 
			{
	            $f = fopen($dir, "r");
	            $array = array();
	            while (!feof($f)) 
	            {
	                $turno = trim(fgets($f));
	                if ($turno != "") 
	                {
	                    $turno = explode(';', $turno);
	                    array_push($array, new Turno($turno[0], $turno[1], $turno[2], $turno[3], $turno[4], $turno[5]));
	                }
	            }
	            fclose($f);
	            return $array;
        	}
		}

		public static function mostrarTurnos($dir)
		{
			$turnos = "";
			$array = Turno::leerArray($dir);
			foreach ($array as $turno) 
			{
				$turnos .= $turno->toCsv().PHP_EOL;
			}
			return $turnos;
		}

		public static function mostrarInscripciones($dir, $parametro)
		{
			$turnos = "";
			$array = Turno::leerArray($dir);
			foreach ($array as $turno) 
			{
				if ($turno->tipo == $parametro || $turno->fecha == $parametro) 
				{
					$turnos .= $turno->toCsv().PHP_EOL;
				}
			}
			return $turnos;
		}
	}
?>