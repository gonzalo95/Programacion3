<?php
    require_once ".\proveedor.php";

    class Pedido
    {
        public $producto;
        public $cantidad;
        public $proveedor;

        public function __construct($producto, $cantidad, $proveedor)
        {
            $this->producto = $producto;
            $this->cantidad = $cantidad;
            $this->proveedor = $proveedor;
        }

        public function to_csv()
        {
        	$csv = $this->producto.";".$this->cantidad.";".$this->proveedor;
        	return $csv;
        }

        public function validar_proveedor($proveedores)
        {
            $f = fopen($proveedores, "r");
            while (!feof($f)) 
            {
                $leido = fgets($f);
                $csv = explode(";", $leido);
                if ($csv[0] == $this->proveedor)
                {
                    fclose($f);
                    return true;
                }
            }
            fclose($f);
            return false;
        }

        public function guardar($dir, $proveedores)
        {
            if ($this->validar_proveedor($proveedores))
            {
                $f = fopen($dir, "a");
                fwrite($f, $this->to_csv().PHP_EOL);
                fclose($f);
            }
        }

        public function array_guardar($array, $dir)
        {
            foreach ($array as $pedido) 
            {
                $pedido->guardar($dir);
            }
        }

        public static function array_leer($dir)
        {
            $f = fopen($dir, "r");
            $array = array();
            while (!feof($f)) 
            {
                $pedido = trim(fgets($f));
                if ($pedido != "") 
                {
                    $pedido = explode(';', $pedido);
                    array_push($array, new Pedido($pedido[0], $pedido[1], $pedido[2]));
                }
            }
            fclose($f);
            return $array;
        }

        public static function leer($pedidos, $proveedores)
        {
            $array_pedidos = Pedido::array_leer($pedidos);
            $array_proveedores = Proveedor::array_leer($proveedores);
            $salida = "";

            foreach ($array_pedidos as $pedido) 
            {
                foreach ($array_proveedores as $proveedor) 
                {
                    if ($pedido->proveedor == $proveedor->id) 
                    {
                        $salida .= $pedido->to_csv();
                        $salida .=  ";" . $proveedor->nombre . PHP_EOL;
                    }
                }
            }
            return $salida;
        }

        public static function listarPorProveedor($pedidos, $id)
        {
            $array_pedidos = Pedido::array_leer($pedidos);
            $salida = "";

            foreach ($array_pedidos as $pedido) 
            {
                if ($pedido->proveedor == $id)
                {
                    $salida .= $pedido->to_csv();
                }
            }
            return $salida;
        }
    }
?>