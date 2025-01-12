<?php
require_once('Controller.php');
require_once('Model/user.php');
require_once('Model/Oeuvre.php');
require_once('Model/exposition.php');
class FavorisController extends Controller{
    public function controller(Database $db) {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres = $oeuvre->getAllOeuvre($db);
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $expose = new Exposition(null, null, null, null, null, null, null);
        $exposes = $expose->getExposes($db);
        $user = new User(null, null, null, null, null, null, null, null, null, null);
        $users = $user->getAllUsers($db);

        $this->render('favoris', ["connectUser" => isset($_SESSION["usersessionID"]), "userRole" => $role,"oeuvres" => $oeuvres, "exposes" => $exposes, "users" => $users]);
    }
}
