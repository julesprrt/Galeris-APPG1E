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
require_once("./Controller/GalerisController.php");
require_once("./Controller/AdminController.php");
require_once("./Controller/PaymentController.php");
require_once("./Controller/PanierController.php");
require_once("./controller/livraisonController.php");

$uri = $_SERVER['REQUEST_URI']; //Recupération de l'uri (la route)
$router = new Router();


//Les routes avec le controller associé et la méthode associé 
$router->addRoute('/Galeris-APPG1E/', HomeController::class, action: 'home');
$router->addRoute('/Galeris-APPG1E/inscription', UserController::class, action: 'inscription');
$router->addRoute('/Galeris-APPG1E/connexion', UserController::class, 'connexion');
$router->addRoute('/Galeris-APPG1E/contact', ContactController::class, 'contact');
$router->addRoute('/Galeris-APPG1E/achat', AchatController::class, 'achat');
$router->addRoute('/Galeris-APPG1E/enchere', AchatController::class, 'achat');
$router->addRoute('/Galeris-APPG1E/faq', FAQController::class, 'faq');
$router->addRoute('/Galeris-APPG1E/cgu', CGUController::class, 'cgu');
$router->addRoute('/Galeris-APPG1E/achat', AchatController::class, 'achat');
$router->addRoute('/Galeris-APPG1E/motdepasse', UserController::class, 'password');
$router->addRoute('/Galeris-APPG1E/codeunique', UserController::class, 'code');
$router->addRoute('/Galeris-APPG1E/galeris', GalerisController::class, 'controller');
$router->addRoute('/Galeris-APPG1E/galeris', GalerisController::class, 'controller');
$router->addRoute('/Galeris-APPG1E/vente', VenteController::class, 'vente');
$router->addRoute('/Galeris-APPG1E/createvente', VenteController::class, 'createvente');
$router->addRoute('/Galeris-APPG1E/profil', UserController::class, 'profil');
$router->addRoute('/Galeris-APPG1E/editionprofil', UserController::class, 'editionprofil');
$router->addRoute('/Galeris-APPG1E/process-edition', UserController::class, 'processEdition');
$router->addRoute('/Galeris-APPG1E/exposition', ExpositionController::class, 'exposition');
$router->addRoute('/Galeris-APPG1E/createexposition', ExpositionController::class, 'createexposition');
$router->addRoute('/Galeris-APPG1E/renvoiecode', UserController::class, 'resendcode');
$router->addRoute('/Galeris-APPG1E/saveid', AchatController::class, 'saveid');
$router->addRoute('/Galeris-APPG1E/deconnexion', UserController::class, 'deconnexion');
$router->addRoute('/Galeris-APPG1E/listeoeuvreattente', ListeAttenteAdminController::class, 'listeattenteoeuvre');
$router->addRoute('/Galeris-APPG1E/attenteoeuvre', AdminController::class, 'attenteoeuvre');
$router->addRoute('/Galeris-APPG1E/statutoeuvre', AdminController::class, 'acceptoeuvre');
$router->addRoute('/Galeris-APPG1E/statutexpose', AdminController::class, 'acceptexpose');
$router->addRoute('/Galeris-APPG1E/listeexposeattente', ListeAttenteAdminController::class, 'listeattenteexpose');
$router->addRoute('/Galeris-APPG1E/saveidexpose', ExpositionController::class, 'saveidexpose');
$router->addRoute('/Galeris-APPG1E/attenteexpose', AdminController::class, 'attenteexpose');
$router->addRoute('/Galeris-APPG1E/send-verification-code', UserController::class, 'sendVerificationCode');
$router->addRoute('/Galeris-APPG1E/confirmationmdp', UserController::class, 'confirmationMDP');
$router->addRoute('/Galeris-APPG1E/verifyMail', UserController::class, 'PässwordMail');
$router->addRoute('/Galeris-APPG1E/exposes', ExpositionController::class, 'listeExpose');
$router->addRoute('/Galeris-APPG1E/expose', ExpositionController::class, 'exposeByID');
$router->addRoute('/Galeris-APPG1E/ventes', VenteController::class, 'listeVente');
$router->addRoute('/Galeris-APPG1E/paiement', PaymentController::class, 'payment');
$router->addRoute('/Galeris-APPG1E/success', PaymentController::class, 'successPayment');
$router->addRoute('/Galeris-APPG1E/cancel', PaymentController::class, 'cancelPayment');
$router->addRoute('/Galeris-APPG1E/ajoutpanier', PanierController::class, 'ajoutPanier');
$router->addRoute('/Galeris-APPG1E/retirerpanier', PanierController::class, 'retirerPanier');
$router->addRoute('/Galeris-APPG1E/retirerpanierid', PanierController::class, 'retirerPanierId');
$router->addRoute('/Galeris-APPG1E/verifyenchere', AchatController::class, 'verifierEnchere');
$router->addRoute('/Galeris-APPG1E/encherir', AchatController::class, 'encherir');
$router->addRoute('/Galeris-APPG1E/createenchere', AchatController::class, 'createEnchere');
$router->addRoute('/Galeris-APPG1E/panier', PanierController::class, 'panier');
$router->addRoute('/Galeris-APPG1E/livraison', LivraisonController::class, 'livraison');
$router->addRoute('/Galeris-APPG1E/validerlivraison', LivraisonController::class, 'validerlivraison');
$router->addRoute('/Galeris-APPG1E/supprimeroeuvre', AchatController::class, 'supprimeroeuvre');

if ($uri !== null) {
    $router->dispatch($uri); //Appel a la méthode du controller dedié
}

