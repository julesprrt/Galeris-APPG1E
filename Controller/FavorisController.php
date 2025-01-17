<?php

require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/Favoris.php');
require_once('Model/user.php');
require_once('Model/Oeuvre.php');
require_once('Model/exposition.php');
class FavorisController extends Controller
{ 

    public function favoris(Database $db){
        
        session_start();

        if(!isset($_SESSION["usersessionID"])){
            header('Location: ./connexion');
            exit;
        }

        $_SESSION["livraison"] = "favoris";

        $favoris = new Favoris();
        $result = $favoris->getAllFavoris($db);
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres = $oeuvre->getAllOeuvre($db);
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $expose = new Exposition(null, null, null, null, null, null, null);
        $exposes = $expose->getExposes($db);
        $user = new User(null, null, null, null, null, null, null, null, null, null);
        $users = $user->getAllUsers($db);
        $this->render('favoris', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "favoris" => $result["result"], "total" =>$result["total"],"oeuvres" => $oeuvres, "exposes" => $exposes, "users" => $users]);
    }

    public function ajoutFavoris(Database $db)
    { 
        session_start();
        if(!isset($_SESSION["usersessionID"])){
            http_response_code(400);
            echo json_encode(["redirection" => "redirection"]);
            exit();
        }

        $favoris = new Favoris();
        $result = $favoris->ajoutFavoris($db);
        if($result === 200){
            http_response_code($result);
            echo json_encode(["favoris" => "Produit ajouté au favoris"]);
        }
        else{
            http_response_code($result);
            echo json_encode(["favoris" => "Erreur favoris"]);
        }
        
    }


    public function retirerFavoris(Database $db)
    {   
        session_start();
        if(!isset($_SESSION["usersessionID"])){
            http_response_code(400);
            echo json_encode(["redirection" => "redirection"]);
            exit();
        }
        
        $favoris = new Favoris();
        $result = $favoris->retirerFavoris($db);
        if($result === 200){
            http_response_code($result);
            echo json_encode(["favoris" => "Produit retirer du favoris"]);
        }
        else{
            http_response_code($result);
            echo json_encode(["favoris" => "Erreur favoris"]);
        }
        
    }
    public function retirerFavorisId(Database $db)
    { 
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        $favoris = new Favoris();
        $result = $favoris->retirerFavorisId($db, $data["id"]);
        if($result === 200){
            http_response_code($result);
            echo json_encode(["favoris" => "Produit retirer du favoris"]);
        }
        else{
            http_response_code($result);
            echo json_encode(["favoris" => "Erreur favoris"]);
        }
        
    }
}
