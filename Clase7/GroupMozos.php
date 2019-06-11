<?php
require "./vendor/autoload.php";
require_once "./clases/Mozo.php";
require_once "./clases/ApiMozo.php";

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

/*
ABM de mozos y listado de todos y de uno.
GET => Listar
POST => Cargar
PUT => Modificar
DELETE => Eliminar
*/
$app->group('/mozos', function()
{
  $this->get('/', \ApiMozo::class . ':traerTodos');
  $this->get('/{id}', \ApiMozo::class . ':traerUno');
  $this->post('/', \ApiMozo::class . ':cargar'); //No lleva parametros porque van en el cuerpo
  $this->delete('/', \ApiMozo::class . ':borrar');
  $this->put('/', \ApiMozo::class . ':modificar');
});

$app->run();
?>