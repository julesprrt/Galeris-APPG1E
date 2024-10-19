<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class HomeController extends Controller{
    
    public function home() {
        $this->render('accueil', []);
        
    }
}