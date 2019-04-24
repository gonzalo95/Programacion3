<?php
    require ".\proveedor.php";
    require ".\pedido.php";

    $proveedores = "proveedores.txt";
    $pedidos = "pedidos.txt";
    
    switch (getenv('REQUEST_METHOD')) 
    {
        case 'GET':
            if($_GET['caso'] == "consultarProveedor")
            {
                echo Proveedor::buscar($_GET['nombre'], $proveedores);
            }
            else if ($_GET['caso'] == "listarPedidos") 
            {
                echo Pedido::leer($pedidos, $proveedores);
            }
            break;

        case 'POST':
            if($_POST['caso'] == "cargarProveedor")
            {
                $proveedor = new Proveedor($_POST['id'], $_POST['nombre'], $_POST['email'], $_POST['foto']);
                $proveedor->guardar($proveedores);
            }
            else if ($_POST['caso'] == "proveedores")
            {
               echo Proveedor::leer($proveedores);
            }
            else if ($_POST['caso'] == "hacerPedido") 
            {
                $pedido = new Pedido($_POST['producto'], $_POST['cantidad'], $_POST['proveedor']);
                $pedido->guardar($pedidos, $proveedores);
            }
            break;

        case 'PUT':

            break;

        case 'DELETE':
            # code...
            break;
                
        default:
            echo "Error";
            break;
    }
?>