<?php

require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/panier.php');
class PanierController extends Controller
{ 

    public function ajoutPanier(Database $db)
    { 
        $panier = new Panier();
        $result = $panier->ajoutPanier($db);
        if($result === 200){
            http_response_code($result);
            echo json_encode(["panier" => "Produit ajouté au panier"]);
        }
        else{
            http_response_code($result);
            echo json_encode(["panier" => "Erreur panier"]);
        }
        
    }

    public function retirerPanier(Database $db)
    { 
        $panier = new Panier();
        $result = $panier->retirerPanier($db);
        if($result === 200){
            http_response_code($result);
            echo json_encode(["panier" => "Produit retirer du panier"]);
        }
        else{
            http_response_code($result);
            echo json_encode(["panier" => "Erreur panier"]);
        }
        
    }
}
