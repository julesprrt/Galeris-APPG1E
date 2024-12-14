<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class HomeController extends Controller{//Controlleur accueil
    
    public function home() {
        session_start();
        $this->render('accueil', ["connectUser" =>  isset($_SESSION["user_id"])]);
        
    }
}