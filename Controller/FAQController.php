<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class FAQController extends Controller{//Controlleur accueil
    
    public function faq() {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $this->render('FAQ', ["connectUser" =>  isset($_SESSION["usersessionID"]),  "userRole" => $role]);
        
    }
}