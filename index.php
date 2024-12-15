<?php

require_once("./Router.php");
require_once("./Controller/UserController.php");
require_once("./Controller/HomeController.php");
require_once("./Controller/ContactController.php");
require_once("./Controller/FAQController.php");
require_once("./Controller/CGUController.php");
require_once("./Controller/AchatController.php");
require_once("./Controller/ExpositionController.php");
require_once("./Controller/VenteController.php");
require_once("./Controller/ListeAttenteAdminController.php");


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
$router->addRoute('/Galeris-APPG1E/vente', VenteController::class, 'vente');
$router->addRoute('/Galeris-APPG1E/createvente', VenteController::class, 'createvente');
$router->addRoute('/Galeris-APPG1E/profil', UserController::class, 'profil');
$router->addRoute('/Galeris-APPG1E/editionprofil', UserController::class, 'editionprofil');
$router->addRoute('/Galeris-APPG1E/process-edition', UserController::class, 'processEdition');
$router->addRoute('/Galeris-APPG1E/exposition', ExpositionController::class, 'exposition');
$router->addRoute('/Galeris-APPG1E/createexposition', ExpositionController::class, 'createexposition');
$router->addRoute('/Galeris-APPG1E/renvoiecode', UserController::class, 'resendcode');
$router->addRoute('/Galeris-APPG1E/deconnexion', UserController::class, 'deconnexion');
$router->addRoute('/Galeris-APPG1E/listeoeuvreattente', ListeAttenteAdminController::class, 'listeattenteoeuvre');

if($uri !== null){
    $router->dispatch($uri);//Appel a la méthode du controller dedié
}