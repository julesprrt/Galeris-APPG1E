<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class CGUController extends Controller{//Controlleur accueil
    
    public function cgu() {
        $this->render('cgu', []);
        
    }
}