<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class PanierController extends Controller{//Controlleur accueil
    
    public function panier() {
        $this->render('panier', []);
        
    }
}