<?php
require_once('Database/Database.php');
require_once('Controller.php');
Class VenteController extends Controller{//Controlleur accueil
    
    public function vente() {
        $this->render('vente', []);
        
    }
}