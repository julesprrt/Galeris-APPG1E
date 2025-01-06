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
            header('Location: /Galeris-APPG1E/connexion');
            exit;
        }

        $_SESSION["livraison"] = "panier";

        $panier = new Panier();
        $result = $panier->getAllPanier($db);
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $this->render('panier', ["connectUser" => isset($_SESSION["usersessionID"]), "userRole" => $role, "panier" => $result["result"], "total" => $result["total"]]);
    }

    public function ajoutPanier(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
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
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }
        
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        $panier = new Panier();
        $result = $panier->retirerPanierID($db, $data["id"]);
        if ($result === 200) {
            http_response_code($result);
            echo json_encode(["panier" => "Produit retirer du panier"]);
        } else {
            http_response_code($result);
            echo json_encode(["panier" => "Erreur panier"]);
        }

    }

    public function retirerPanier(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }

        $panier = new Panier();
        $result = $panier->retirerPanier($db);
        if ($result === 200) {
            http_response_code($result);
            echo json_encode(["panier" => "Produit retirer du panier"]);
        } else {
            http_response_code($result);
            echo json_encode(["panier" => "Erreur panier"]);
        }

    }
}
