<?php
    class Proveedor
    {
        public $id;
        public $nombre;
        public $email;
        public $foto;

        public function __construct($id, $nombre, $email, $foto)
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->email = $email;
            $this->foto = $foto; 
        }

        public function to_csv()
        {
        	$csv = $this->id.";".$this->nombre.";".$this->email.";".$this->foto;
        	return $csv;
        }

        public function guardar($dir)
        {
            $f = fopen($dir, "a");
            fwrite($f, $this->to_csv().PHP_EOL);
            fclose($f);
        }

        public function array_guardar($array, $dir)
        {
            foreach ($array as $proveedor) 
            {
                $proveedor->guardar($dir);
            }
        }

        public static function leer($dir)
        {
            $f = fopen($dir, "r");
            $salida = "";
            while (!feof($f)) 
            {
                $salida = $salida.fgets($f);	
            }
            fclose($f);
            return $salida;
        }

        public static function buscar($nombre, $dir)
        {
            $salida = "";
            $f = fopen($dir, "r");
            while (!feof($f)) 
            {
                $leido = fgets($f);
                $csv = explode(";", $leido);
                var_dump($csv);
                if ( !feof($f) && strtolower($csv[1]) == strtolower($nombre))
                {
                    $salida = $salida.$leido;
                }
            }
            if ($salida == "")
            {
                $salida = "No existe proveedor ".$nombre;
            }
            fclose($f);
            return $salida;
        }
    }
?>