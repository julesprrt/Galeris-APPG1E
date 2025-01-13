<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
class MentionsLegalesController extends Controller
{//Controlleur accueil

    public function mentionslegales()
    {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $this->render('MentionsLegales', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role]);

    }
}