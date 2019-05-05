<?php
	class Vehiculo
	{
		public $marca;
		public $modelo;
		public $patente;
		public $precio;

		public function __construct($marca, $modelo, $patente, $precio)
		{
			$this->marca = $marca;
			$this->modelo = $modelo;
			$this->patente = $patente;
			$this->precio = $precio;
		}

		public function toCsv()
		{
			$csv = $this->marca.';'.$this->modelo.';'.$this->patente.';'.$this->precio;
			return $csv;
		}

		public static function guardar($dir, $obj)
		{
			if (Vehiculo::validarPatente($dir, $obj->patente)) 
			{
				$f = fopen($dir, 'a');
				$string = $obj->toCsv().PHP_EOL;
				fwrite($f, $string);
				fclose($f);
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
	                $vehiculo = trim(fgets($f));
	                if ($vehiculo != "") 
	                {
	                    $vehiculo = explode(';', $vehiculo);
	                    array_push($array, new Vehiculo($vehiculo[0], $vehiculo[1], $vehiculo[2], $vehiculo[3]));
	                }
	            }
	            fclose($f);
	            return $array;
        	}
		}

		public static function guardarArray($dir, $array)
		{
			$f = fopen($dir, 'w');
			foreach ($array as $vehiculo) 
			{
				fwrite($f, $vehiculo->toCsv().PHP_EOL);
			}
			fclose($f);
		}

		private static function validarPatente($dir, $patente)
		{
			$array = Vehiculo::leerArray($dir);
			foreach ($array as $vehiculo) 
			{
				if ($vehiculo->patente == $patente) 
				{
					return false;
				}
			}
			return true;
		}

		public static function consultarVehiculo($dir, $parametro)
		{
			$array = Vehiculo::leerArray($dir);
			$ocurrencias = '';
			foreach ($array as $vehiculo) 
			{
				if (strcasecmp($parametro, $vehiculo->marca) == 0 ||
					strcasecmp($parametro, $vehiculo->modelo) == 0 ||
					strcasecmp($parametro, $vehiculo->patente) == 0) 
				{
					$ocurrencias .= $vehiculo->toCsv().PHP_EOL;
				}
			}
			return $ocurrencias;
		}

		public static function modificar($dir, $patente, $marca, $modelo, $precio)
		{
			$array = Vehiculo::leerArray($dir);
			foreach ($array as $vehiculo) 
			{
				if ($vehiculo->patente == $patente) 
				{
					$vehiculo->marca = $marca;
					$vehiculo->modelo = $modelo;
					$vehiculo->precio = $precio;
					Vehiculo::buscarFoto($dir, $patente);
					move_uploaded_file($_FILES["foto"]["tmp_name"], "fotos/".$vehiculo->patente.'.'.date("d-m-y", time()).'.'.pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
					Vehiculo::guardarArray($dir, $array);
					break;
				}
			}
		}

		public static function buscarFoto($dir, $patente)
		{
			$fotos = scandir("fotos");
            $array = Vehiculo::leerArray($dir);
            foreach ($fotos as $foto) 
            {
            	$nombreParticionado = explode('.', $foto);
            	$id = $nombreParticionado[0];
            	if ($id == $patente) 
            	{
            		rename ('fotos/'.$foto,"backUpFotos/".$foto);
            	}
            }
		}

		public static function mostrar($dir)
		{
			$vehiculos = "";
			$array = Vehiculo::leerArray($dir);
			foreach ($array as $vehiculo) 
			{
				$vehiculos .= $vehiculo->toCsv().PHP_EOL;
			}
			return $vehiculos;
		}
	}
?>