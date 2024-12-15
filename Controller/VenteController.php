<?php
require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/categorie.php');
require_once('Model/Oeuvre.php');
Class VenteController extends Controller{//Controlleur accueil
    
    public function vente(Database $db) {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $categorie = new Categorie();
        $result = $categorie->getAllCategorie($db);
        $this->render('vente', ["result" => $result, "connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role]);   
    }

    public function createvente(Database $db){
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if(isset($data["titre"]) && isset($data["type"]) && isset($data["prix"]) && isset($data["nbJours"]) && isset($data["auteurs"]) && isset($data["description"]) && isset($data["categorie"]) && isset($data["image1"]) && isset($data["image2"]) && isset($data["image3"])){
            $vente = new Oeuvre($data["titre"], $data["auteurs"], $data["categorie"], $data["type"], $data["prix"], $data["nbJours"], $data["description"], $data["image1"], $data["image2"], $data["image3"]);
            $result = $vente->VerifyAndSaveProduct($db);
            if($result === 200){
                http_response_code($result);
                echo json_encode(['Success' => "Votre demande est bien pris en compte, votre demande est mise en attente"]);
            }
            else{
                http_response_code(400);
                echo json_encode(['Error' => $result]);
            }
        }
        else{
            http_response_code(400);
            echo json_encode(['Error' => "Erreur"]);
        }
    }
}