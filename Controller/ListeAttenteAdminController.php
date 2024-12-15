<?php

require_once('Model/Oeuvre.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class ListeAttenteAdminController extends Controller{//Controlleur accueil
    
    public function listeattenteoeuvre(Database $db) {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $oeuvre = new Oeuvre(null,null,null,null,null,null,null,null,null,null);
        $oeuvres = $oeuvre->getOeuvresEnAttente($db);
        foreach($oeuvres as $row) {
            //printf ("%s \n", $row['username']);
        }
        $this->render('listeattenteoeuvre', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "oeuvres" => $oeuvres]);
        
    }
}