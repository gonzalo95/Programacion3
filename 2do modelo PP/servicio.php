<?php
	class Servicio
	{
		public $id;
		public $tipo;
		public $precio;
		public $demora;

		public function __construct($id, $tipo, $precio, $demora)
		{
			$this->id = $id;
			$this->tipo = $tipo;
			$this->precio = $precio;
			$this->demora = $demora;
		}

		public function toCsv()
		{
			$csv = $this->id.';'.$this->tipo.';'.$this->precio.';'.$this->demora;
			return $csv;
		}


		public static function cargarServicio($dir, $obj)
		{
			if (Servicio::validarTipo($obj->tipo)) 
			{
				$f = fopen($dir, 'a');
				$string = $obj->toCsv().PHP_EOL;
				fwrite($f, $string);
				fclose($f);
			}
		}

		private static function validarTipo($tipo)
		{
			$tiposPermitidos = array("10.000km", "15.000km", "50.000km");
			return in_array($tipo, $tiposPermitidos);
		}

		public static function leerArray($dir)
		{
			if (file_exists($dir)) 
			{
	            $f = fopen($dir, "r");
	            $array = array();
	            while (!feof($f)) 
	            {
	                $servicio = trim(fgets($f));
	                if ($servicio != "") 
	                {
	                    $servicio = explode(';', $servicio);
	                    array_push($array, new Servicio($servicio[0], $servicio[1], $servicio[2], $servicio[3]));
	                }
	            }
	            fclose($f);
	            return $array;
        	}
		}
	}
?>