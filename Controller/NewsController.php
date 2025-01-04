<?php
require_once('Database/Database.php');
require_once('Controller.php');
class NewsController extends Controller
{ //Controlleur accueil

    public function news(Database $db)
    { 
            session_start();
            $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
            $this->render('news', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role]);
        
    }
}
