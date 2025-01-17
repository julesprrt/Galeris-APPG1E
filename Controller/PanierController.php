<?php

require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/panier.php');
class PanierController extends Controller
{

    public function panier(Database $db)
    {
        session_start();

        if (!isset($_SESSION["usersessionID"])) {
            header('Location: ./connexion');
            exit;
        }

        $_SESSION["livraison"] = "panier";

        $expose = new Exposition(null,null,null,null,null,null,null);
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres_list = $oeuvre->getAllOeuvre($db);
        $exposes_list = $expose->getExposes($db);
        $user = new User(null,null,null,null,null,null,null,null,null,null);
        $users = $user->getAllUsers($db);


        $panier = new Panier();
        $result = $panier->getAllPanier($db);
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $this->render('panier', ["connectUser" => isset($_SESSION["usersessionID"]), "userRole" => $role, "panier" => $result["result"], "total" => $result["total"], "exposes_barre" => $exposes_list, "users" => $users, "oeuvres" => $oeuvres_list]);
    }

    public function ajoutPanier(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            http_response_code(400);
            echo json_encode(["redirection" => "redirection"]);
            exit();
        }

        $panier = new Panier();
        $result = $panier->ajoutPanier($db);
        if ($result === 200) {
            http_response_code($result);
            echo json_encode(["panier" => "Produit ajouté au panier"]);
        } else {
            http_response_code($result);
            echo json_encode(["panier" => "Erreur panier"]);
        }

    }

    public function retirerPanierId(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            http_response_code(400);
            echo json_encode(["redirection" => "redirection"]);
            exit();
        }
        
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        $panier = new Panier();
        $result = $panier->retirerPanierID($db, $data["id"]);
        if ($result === 200) {
            http_response_code($result);
            echo json_encode(["panier" => "Produit retiré du panier"]);
        } else {
            http_response_code($result);
            echo json_encode(["panier" => "Erreur panier"]);
        }

    }

    public function retirerPanier(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }

        $panier = new Panier();
        $result = $panier->retirerPanier($db);
        if ($result === 200) {
            http_response_code($result);
            echo json_encode(["panier" => "Produit retiré du panier"]);
        } else {
            http_response_code($result);
            echo json_encode(["panier" => "Erreur panier"]);
        }

    }
}
