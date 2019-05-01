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
            $f = fopen($dir, 'a');
            fwrite($f, $this->to_csv().PHP_EOL);
            fclose($f);
        }

        public static function array_guardar($array, $dir)
        {
            $f = fopen($dir, 'w');
            foreach ($array as $proveedor) 
            {
                fwrite($f, $proveedor->to_csv().PHP_EOL);
            }
            fclose($f);
        }

        public static function array_leer($dir)
        {
            $f = fopen($dir, "r");
            $array = array();
            while (!feof($f)) 
            {
                $proveedor = trim(fgets($f));
                if ($proveedor != "") 
                {
                    $proveedor = explode(';', $proveedor);
                    array_push($array, new Proveedor($proveedor[0], $proveedor[1], $proveedor[2], $proveedor[3]));
                }
            }
            fclose($f);
            return $array;
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

        public static function buscar($nombre, $dir) // Usar array_leer
        {
            $salida = "";
            $f = fopen($dir, "r");
            while (!feof($f)) 
            {
                $leido = fgets($f);
                $csv = explode(";", $leido);
                if ( $leido != "" && strtolower($csv[1]) == strtolower($nombre))
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

        public static function modificar($dir, $id)
        {
            $array_proveedores = Proveedor::array_leer($dir);

            foreach ($array_proveedores as $proveedor) 
            {      
                if ($proveedor->id == $id) 
                {
                    if (file_exists('fotos/'.$proveedor->foto))
                    {
                        rename ('fotos/'.$proveedor->foto,"backUpFotos/".$proveedor->id.'_'.date("d-m-y", time()).'.'.pathinfo($proveedor->foto, PATHINFO_EXTENSION));
                    }
                    
                    $proveedor->nombre = $_POST['nombre'];
                    $proveedor->email = $_POST['email'];
                    $proveedor->foto = $_FILES['foto']['name'];
                    move_uploaded_file($_FILES["foto"]["tmp_name"], "fotos/".$_FILES['foto']['name']);

                    Proveedor::array_guardar($array_proveedores, $dir);
                }               
            }
        }

        public static function FotosBack($dir)
        {
            $archivos = scandir("backUpFotos");
            $array_proveedores = Proveedor::array_leer($dir);
            $salida = "";

            foreach($archivos as $archivo)
            {
                $id = explode("_",$archivo);
                foreach($array_proveedores as $proveedor)
                {
                    if($proveedor->id == $id[0])
                    {
                        $salida .= $proveedor->nombre;
                        $salida .= " -- ";
                        $salida .= explode('.', $id[1])[0].PHP_EOL;
                    }
                }
            }
            return $salida;
        }
    }
?>