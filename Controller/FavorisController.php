<?php

require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/Favoris.php');
class FavorisController extends Controller
{ 

    public function favoris(Database $db){
        
        session_start();

        if(!isset($_SESSION["usersessionID"])){
            header('Location: /Galeris-APPG1E/connexion');
            exit;
        }

        $_SESSION["livraison"] = "favoris";

        $favoris = new Favoris();
        $result = $favoris->getAllFavoris($db);
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $this->render('favoris', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "favoris" => $result["result"], "total" =>$result["total"]]);
    }

    public function ajoutFavoris(Database $db)
    { 
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
