<?php

require_once("./Router.php");
require_once("./Controller/UserController.php");
require_once("./Controller/HomeController.php");
require 'vendor/autoload.php';


$uri = $_SERVER['REQUEST_URI'];//Recupération de l'uri (la route)
$router = new Router();


//Les routes avec le controller associé et la méthode associé 
$router->addRoute('/', HomeController::class, action: 'home');
$router->addRoute('/inscription', UserController::class, action: 'inscription');



$router->dispatch($uri);//Appel a la méthode du controller dedié
