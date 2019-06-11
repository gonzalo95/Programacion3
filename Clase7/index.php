<?php
require "./vendor/autoload.php";

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->get('/saludo[/]', function ($request, $response){
	$response->getBody()->write("Hola mundo");
	return $response;
});

$app->map(['GET', 'POST'], '/saludo/{nombre}[/]', function ($request, $response, $args){
	$response->getBody()->write("Hola ".$args['nombre']);
	return $response;
});

$app->get('/productos/{id}', function ($request, $response, $args){
	return $response->withJson(array('id' => $args['id']), 404);
});

$app->post('/productos[/]', function ($request, $response){
	$parametro = $request->getParsedBody();
	//var_dump($parametro);
	return $response->withJson(array('nombre' => $parametro['nombre']));
});

$app->group('/grupos', function(){
	$this->get('[/]', function($request, $response){
		$response->getBody()->write("Get agrupado");
		return $response;
	});

	$this->post('/{parametro}', function($request, $response, $args){
		$response->getBody()->write("Post agrupado con parametro: ".$args['parametro']);
		return $response;
	});
});

$app->run();
?>