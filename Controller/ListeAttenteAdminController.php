<?php

require_once('Model/exposition.php');
require_once('Model/oeuvre.php');
require_once('Database/Database.php');
require_once('Controller.php');
class ListeAttenteAdminController extends Controller
{ //Controlleur accueil

    public function listeattenteoeuvre(Database $db)
    {
        session_start();

        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;

        if (!$role) {
            http_response_code(404);
            header('Location: /Galeris-APPG1E/');
            exit();
        }

        $oeuvre = new Oeuvre(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $oeuvres = $oeuvre->getOeuvresEnAttente($db);
        $this->render('listeattenteoeuvre', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "oeuvres" => $oeuvres]);
    }

    public function listeattenteexpose(Database $db)
    {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;

        if (!$role) {
            http_response_code(404);
            header('Location: /Galeris-APPG1E/');
            exit();
        }

        $expose = new Exposition(null, null, null, null, null, null, null);
        $exposes = $expose->getExposesEnAttente($db);

        $this->render('listeattentexpose', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "exposes" => $exposes]);
    }
}
