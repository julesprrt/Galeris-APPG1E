<?php
require_once('Model/user.php');
require_once('Model/Oeuvre.php');
require_once('Database/Database.php');
require_once('Controller.php');
class HomeController extends Controller
{ //Controlleur accueil

    public function home(Database $db)
    { 
            session_start();
            $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
            $oeuvres = $oeuvre->getAllOeuvre($db);
            $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
            $this->render('accueil', ["connectUser" =>  isset($_SESSION["usersessionID"]), "oeuvres" => $oeuvres, "userRole" => $role]);
        
    }
}
