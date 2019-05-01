<?php
    require_once ".\proveedor.php";
    require_once ".\pedido.php";

    $proveedores = "proveedores.txt";
    $pedidos = "pedidos.txt";
    
    switch (getenv('REQUEST_METHOD')) 
    {
        case 'GET':
            if($_GET['caso'] == "consultarProveedor")
            {
                echo Proveedor::buscar($_GET['nombre'], $proveedores);
            }
            elseif ($_GET['caso'] == "listarPedidos") 
            {
                echo Pedido::leer($pedidos, $proveedores);
            }
            elseif ($_GET['caso'] == "listarPedidosProveedor") 
            {
            	echo Pedido::listarPorProveedor($pedidos, $_GET['id']);
            }
            elseif ($_GET['caso'] == "fotosBack") 
            {
            	echo Proveedor::FotosBack($proveedores);
            }
            break;

        case 'POST':
            if($_POST['caso'] == "cargarProveedor")
            {
            	$foto = $_FILES['foto']['name'];
            	/*
				$origen = $_FILES["foto"]["tmp_name"];
	            $array_nombre_archivo = explode(".", $foto);
	            $nombre_archivo = ($_POST["id"]).".".($_POST["nombre"]).".";
	            $nombre_archivo .= $array_nombre_archivo[sizeof($array_nombre_archivo)-1];
	            $destino = "fotos/".$nombre_archivo;
	            move_uploaded_file($origen, $destino);
	            */
	            $origen = $_FILES["foto"]["tmp_name"];
	            move_uploaded_file($origen, "fotos/".$foto);

                $proveedor = new Proveedor($_POST['id'], $_POST['nombre'], $_POST['email'], $foto);
                $proveedor->guardar($proveedores);
            }
            elseif ($_POST['caso'] == "proveedores")
            {
               echo Proveedor::leer($proveedores);
            }
            elseif ($_POST['caso'] == "hacerPedido") 
            {
                $pedido = new Pedido($_POST['producto'], $_POST['cantidad'], $_POST['proveedor']);
                $pedido->guardar($pedidos, $proveedores);
            }
            elseif ($_POST['caso'] == "modificarProveedor") 
            {
            	Proveedor::modificar($proveedores, $_POST['id']);
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