<?php

require_once("./Router.php");
require_once("./Controller/UserController.php");
require_once("./Controller/HomeController.php");
require 'vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$router = new Router();

$router->addRoute('/', HomeController::class, action: 'home');
$router->addRoute('/inscription', UserController::class, action: 'inscription');



$router->dispatch($uri);
