<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class NovArtController extends Controller{//Controlleur accueil
    
    public function novart() {
        $this->render('NovArt', []);
        
    }
}