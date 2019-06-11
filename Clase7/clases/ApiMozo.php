<?php
require_once "Mozo.php";

class ApiMozo extends Mozo
{
	public function traerTodos($request, $response)
	{
		return $response->getBody()->write("traerTodos");
	}

	public function traerUno($request, $response, $args)
	{
		return $response->getBody()->write("traerUno: ".$args['id']);
	}

	public function cargar($request, $response)
	{
		return $response->getBody()->write("cargar");
	}

	public function modificar($request, $response)
	{
		return $response->getBody()->write("modificar");
	}

	public function borrar($request, $response)
	{
		return $response->getBody()->write("borrar");		
	}
}
?>