<?php
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
                    return true;
                }
            }
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
            else
            {
                echo "No existe el proveedor";
            }
        }

        public function array_guardar($array, $dir)
        {
            foreach ($array as $pedido) 
            {
                $pedido->guardar($dir);
            }
        }

        public static function leer($pedidos, $proveedores)
        {
            $f_pedidos = fopen($pedidos, "r");
            $f_proveedores = fopen($proveedores, "r");
            $salida = "";
            while (!feof($f_pedidos)) 
            {
                $pedido = fgets($f_pedidos);
                $csv_pedido = explode(";", $pedido);
                //$salida = $salida.$pedido;
                while (!feof($f_proveedores)) 
                {
                    $proveedor = fgets($f_proveedores);
                    $csv_proveedor = explode(";", $proveedor);
                    var_dump($csv_proveedor);
                    if ($csv_pedido[2] == $csv_proveedor[0])
                    {
                        $salida = $salida.$pedido.$csv_proveedor[0].PHP_EOL;
                        break;
                    }
                }
            }
            fclose($f_pedidos);
            fclose($f_proveedores);
            return $salida;
        }
    }
?>