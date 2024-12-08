<?php

require_once("./Router.php");
require_once("./Controller/UserController.php");
require_once("./Controller/HomeController.php");
require_once("./Controller/ContactController.php");
require_once("./Controller/FAQController.php");
require_once("./Controller/CGUController.php");
require_once("./Controller/AchatController.php");
require 'vendor/autoload.php';


$uri = $_SERVER['REQUEST_URI']; //Recupération de l'uri (la route)
$router = new Router();


//Les routes avec le controller associé et la méthode associé 
$router->addRoute('/Galeris-APPG1E/', HomeController::class, action: 'home');
$router->addRoute('/Galeris-APPG1E/inscription', UserController::class, action: 'inscription');
$router->addRoute('/Galeris-APPG1E/connexion', UserController::class, 'connexion');
$router->addRoute('/Galeris-APPG1E/contact', ContactController::class, 'contact');
$router->addRoute('/Galeris-APPG1E/faq', FAQController::class, 'faq');
$router->addRoute('/Galeris-APPG1E/cgu', CGUController::class, 'cgu');
$router->addRoute('/Galeris-APPG1E/achat', AchatController::class, 'achat');
$router->addRoute('/Galeris-APPG1E/motdepasse', UserController::class, 'password');
$router->addRoute('/Galeris-APPG1E/codeunique', UserController::class, 'code');
$router->addRoute('/Galeris-APPG1E/profil', UserController::class, 'profil');


$router->dispatch($uri);//Appel a la méthode du controller dedié
