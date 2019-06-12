<?php
namespace Firebase\JWT;
require "./vendor/autoload.php";

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->post('/loggin/{usuario}/{clave}', function ($request, $response, $args){
	$datos = $request->getParsedBody();

	//Accedo a db y compruebo que la clave y el usuario sean correctos

	if ($args['usuario'] == "gonzalo" && $args['clave'] == "1234")
	{
		$payload = array(
			'data' => $datos,
			'app' => "API REST 2019"
		);

		$token = JWT::encode($payload, "clave");

		return $response->withJson($token, 200);
	}
	else
	{
		$response->getBody()->write("Error de autenticacion");
		return $response;
	}
});

$app->post('/verificarToken/{token}', function($request, $response, $args){
 $token = $args['token'];
 try{
	 $decodificado = JWT::decode(
		 $token,
		 "clave",
		 ['HS256']
	 );
 }
 catch (Exception $e){
	 throw new Exception("Token no valido: ".$e.getMessage());
 }
 return "Token OK!";
});

$app->post('/verificarToken[/]', function($request, $response){
	$parametro = $request->getHeader("token");
	$token = $parametro[0];
	try{
		$decodificado = JWT::decode(
			$token,
			//$parametro,
			"clave",
			['HS256']
		);
	}
	catch (Exception $e){
		throw new Exception("Token no valido: ".$e.getMessage());
	}
	return "Token OK!";
   });

$app->run();
?>