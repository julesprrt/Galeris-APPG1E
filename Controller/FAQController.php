<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class FAQController extends Controller{//Controlleur accueil
    
    public function faq() {
        $this->render('FAQ', []);
        
    }
}