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
require_once("./Controller/FavorisController.php");
require_once("./Controller/AdminController.php");
require_once("./Controller/PaymentController.php");
require_once("./Controller/PanierController.php");
require_once("./Controller/LivraisonController.php");
require_once("./Controller/NewsController.php");
require_once("./Controller/NovArtController.php");
require_once("./Controller/MentionsLegalesController.php");


require_once("./Controller/DashBoardController.php");

$uri = $_SERVER['REQUEST_URI']; //Recupération de l'uri (la route)
$router = new Router();


//Les routes avec le controller associé et la méthode associé 
$router->addRoute('/', HomeController::class, action: 'home');
$router->addRoute('/inscription', UserController::class, action: 'inscription');
$router->addRoute('/connexion', UserController::class, 'connexion');
$router->addRoute('/contact', ContactController::class, 'contact');
$router->addRoute('/achat', AchatController::class, 'achat');
$router->addRoute('/enchere', AchatController::class, 'achat');
$router->addRoute('/faq', FAQController::class, 'faq');
$router->addRoute('/cgu', CGUController::class, 'cgu');
$router->addRoute('/motdepasse', UserController::class, 'password');
$router->addRoute('/codeunique', UserController::class, 'code');
$router->addRoute('/galeris', GalerisController::class, 'controller');
$router->addRoute('/favoris', FavorisController::class, 'controller');
$router->addRoute('/vente', VenteController::class, 'vente');
$router->addRoute('/createvente', VenteController::class, 'createvente');
$router->addRoute('/profil', UserController::class, 'profil');
$router->addRoute('/editionprofil', UserController::class, 'editionprofil');
$router->addRoute('/process-edition', UserController::class, 'processEdition');
$router->addRoute('/exposition', ExpositionController::class, 'exposition');
$router->addRoute('/createexposition', ExpositionController::class, 'createexposition');
$router->addRoute('/renvoiecode', UserController::class, 'resendcode');
$router->addRoute('/saveid', AchatController::class, 'saveid');
$router->addRoute('/deconnexion', UserController::class, 'deconnexion');
$router->addRoute('/listeoeuvreattente', ListeAttenteAdminController::class, 'listeattenteoeuvre');
$router->addRoute('/attenteoeuvre', AdminController::class, 'attenteoeuvre');
$router->addRoute('/statutoeuvre', AdminController::class, 'acceptoeuvre');
$router->addRoute('/statutexpose', AdminController::class, 'acceptexpose');
$router->addRoute('/listeexposeattente', ListeAttenteAdminController::class, 'listeattenteexpose');
$router->addRoute('/saveidexpose', ExpositionController::class, 'saveidexpose');
$router->addRoute('/attenteexpose', AdminController::class, 'attenteexpose');
$router->addRoute('/confirmationmdp', UserController::class, 'confirmationMDP');
$router->addRoute('/verifyMail', UserController::class, 'PässwordMail');
$router->addRoute('/exposes', ExpositionController::class, 'listeExpose');
$router->addRoute('/expose', ExpositionController::class, 'exposeByID');
$router->addRoute('/ventes', VenteController::class, 'listeVente');
$router->addRoute('/paiement', PaymentController::class, 'payment');
$router->addRoute('/success', PaymentController::class, 'successPayment');
$router->addRoute('/cancel', PaymentController::class, 'cancelPayment');
$router->addRoute('/ajoutpanier', PanierController::class, 'ajoutPanier');
$router->addRoute('/retirerpanier', PanierController::class, 'retirerPanier');
$router->addRoute('/retirerpanierid', PanierController::class, 'retirerPanierId');
$router->addRoute('/verifyenchere', AchatController::class, 'verifierEnchere');
$router->addRoute('/encherir', AchatController::class, 'encherir');
$router->addRoute('/createenchere', AchatController::class, 'createEnchere');
$router->addRoute('/panier', PanierController::class, 'panier');
$router->addRoute('/livraison', LivraisonController::class, 'livraison');
$router->addRoute('/validerlivraison', LivraisonController::class, 'validerlivraison');
$router->addRoute('/supprimeroeuvre', AchatController::class, 'supprimeroeuvre');
$router->addRoute('/solde', UserController::class, 'solde');
$router->addRoute('/envoiesolde', UserController::class, 'envoiesolde');
$router->addRoute('/signaleroeuvre', UserController::class, 'signalerOeuvre');
$router->addRoute('/news', NewsController::class, 'news');
$router->addRoute('/createnews', NewsController::class, 'createNews');
$router->addRoute('/listenews', NewsController::class, 'listeNews');
$router->addRoute('/saveidnews', NewsController::class, 'saveidnews');
$router->addRoute('/newsactu', NewsController::class, 'newsByID');
$router->addRoute('/ajoutfavoris', FavorisController::class, 'ajoutFavoris');
$router->addRoute('/retirerfavoris', FavorisController::class, 'retirerFavoris');
$router->addRoute('/favoris', FavorisController::class, 'favoris');
$router->addRoute('/retirerfavorisid', FavorisController::class, 'retirerFavorisId');
$router->addRoute('/saveiduser', UserController::class, 'consultation');
$router->addRoute('/utilisateur', UserController::class, 'profil_consultation');

$router->addRoute('/novart', NovArtController::class, 'novart');
$router->addRoute('/mentionslegales', MentionsLegalesController::class, 'mentionslegales');

$router->addRoute('/dashboard', DashBoardController::class, 'dashboard');

if ($uri !== null) {
    $router->dispatch($uri); //Appel a la méthode du controller dedié
}
