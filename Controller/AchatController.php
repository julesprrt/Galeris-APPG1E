<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class AchatController extends Controller{//Controlleur accueil
    
    public function achat() {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $this->render('achat', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role]);
        
    }
}