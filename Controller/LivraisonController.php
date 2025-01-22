<?php
require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/livraison.php');
require_once('Model/Oeuvre.php');
require_once('Model/user.php');
require_once('Model/exposition.php');
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

        $expose = new Exposition(null,null,null,null,null,null,null);
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres_list = $oeuvre->getAllOeuvre($db);
        $exposes_list = $expose->getExposes($db);
        $user = new User(null,null,null,null,null,null,null,null,null,null);
        $users = $user->getAllUsers($db);

        $this->render('livraison', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "livraison" => $_SESSION["livraison"], "livraisonres" => $result, "exposes_barre" => $exposes_list, "users" => $users, "oeuvres" => $oeuvres_list]);
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
                echo json_encode(["Success" => "Vos données de livraison ont bien été enregistrées."]);
            }
            else if($statut === 401){
                http_response_code(401);
                echo json_encode(["Error" => "Le nom ne doit contenir que des lettres."]);
            }
            else if($statut === 402){
                http_response_code(402);
                echo json_encode(["Error" => "Le prénom ne doit contenir que des lettres."]);
            }
            else if($statut === 403){
                http_response_code(403);
                echo json_encode(["Error" => "Le nom du pays ne doit contenir que des lettres."]);
            }
            else if($statut === 404){
                http_response_code(404);
                echo json_encode(["Error" => "Le nom de la ville ne doit contenir que des lettres."]);
            }
        } 
        else {
            http_response_code(400);
            echo json_encode(["Error" => "Veuillez remplir l'ensemble des champs du formulaire."]);
        }
    }
}
