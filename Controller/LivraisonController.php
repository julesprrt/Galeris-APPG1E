<?php
require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/livraison.php');
class LivraisonController extends Controller
{ //Controlleur accueil

    public function livraison(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }

        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $livraison = new Livraison(null,null,null,null,null,null);
        $result = $livraison->getLivraison($db);
        $this->render('livraison', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "livraison" => $_SESSION["livraison"], "livraisonres" => $result]);
    }

    public function validerlivraison(Database $db){
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }
        
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['nom']) && isset($data['prenom']) && isset($data['pays']) && isset($data['adresse']) && isset($data['postale']) && isset($data['ville'])) {
            $livraison = new Livraison($data['nom'], $data['prenom'],$data['pays'], $data['adresse'], $data['postale'], $data['ville']);
            $statut = $livraison->saveLivraison($db);
            if($statut === 200){
                http_response_code(200);
                echo json_encode(["Success" => "Données bien enregistré"]);
            }
            else if($statut === 401){
                http_response_code(401);
                echo json_encode(["Error" => "Erreur nom"]);
            }
            else if($statut === 402){
                http_response_code(402);
                echo json_encode(["Error" => "Erreur prénom"]);
            }
            else if($statut === 403){
                http_response_code(403);
                echo json_encode(["Error" => "Erreur pays"]);
            }
            else if($statut === 404){
                http_response_code(404);
                echo json_encode(["Error" => "Erreur ville"]);
            }
        } 
        else {
            http_response_code(400);
            echo json_encode(["Error" => "Veuillez remplir l'ensemble des champs du formulaire"]);
        }
    }
}
