<?php

require_once('Model/exposition.php');
require_once('Model/Oeuvre.php');
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class ListeAttenteAdminController extends Controller{//Controlleur accueil
    
    public function listeattenteoeuvre(Database $db) {
        session_start();

        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;

        if (!$role) {
            http_response_code(404);
            header('Location: ./');
            exit();
        }

        $oeuvre = new Oeuvre(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
        $oeuvres = $oeuvre->getOeuvresEnAttente($db);


        $expose = new Exposition(null,null,null,null,null,null,null);
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres_list = $oeuvre->getAllOeuvre($db);
        $exposes_list = $expose->getExposes($db);
        $user = new User(null,null,null,null,null,null,null,null,null,null);
        $users = $user->getAllUsers($db);

        $this->render('listeattenteoeuvre', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "oeuvres" => $oeuvres, "oeuvres_barre" => $oeuvres_list, "exposes_barre" => $exposes_list, "users" => $users]);
        
    }

    public function listeattenteexpose(Database $db) {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        
        if (!$role) {
            http_response_code(404);
            header('Location: ./');
            exit();
        }
        
        $expose = new Exposition(null,null,null,null,null,null,null);
        $exposes = $expose->getExposesEnAttente($db);
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres = $oeuvre->getAllOeuvre($db);
        $exposes_list = $expose->getExposes($db);
        $user = new User(null,null,null,null,null,null,null,null,null,null);
        $users = $user->getAllUsers($db);

        $this->render('listeattentexpose', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "exposes" => $exposes, "oeuvres" => $oeuvres, "exposes_barre" => $exposes_list, "users" => $users]);
        
    }
}