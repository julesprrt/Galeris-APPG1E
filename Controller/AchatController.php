<?php
require_once('Model/oeuvre.php');
require_once('Model/oeuvre.php');
require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/panier.php');

class AchatController extends Controller
{
    // Méthode pour afficher les détails d'une œuvre
    public function achat(Database $db)
    {
        // Récupérer l'œuvre depuis le modèle
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = [], $prix_actuel = null, $id_offreur = null);
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $id =  $_SESSION['oeuvre_id'];
        $oeuvreid = $oeuvre->getOeuvreById($id, $db);

        $panier = new Panier();
        $panierExist = $panier->existPanier($db);

        // Vérifier si l'œuvre existe
        if (!$oeuvre) {
            http_response_code(404);
            echo "L'œuvre demandée est introuvable.";
            //echo "<script>alert('Oeuvre n\'existe pas');</script>"; A tester si ça fonctionne
            header('Location: /Galeris-APPG1E/');
            exit();
        }

        $type =  $_SESSION['oeuvre_typevente'];
        if ($type === "Vente") {
            $this->render('achat', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role,'oeuvre' => $oeuvreid,"panier" => $panierExist]);
        }
        else {
            $encheres = $oeuvre->getAllEnchere($id, $db);
            $this->render('enchere', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role,'oeuvre' => $oeuvreid, 'encheres' => $encheres]);
        }
    }

    public function saveid(Database $db)
    {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['id'])) {
            session_start();
            $_SESSION['oeuvre_id'] = (int)$data['id'];
            $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
            $oeuvreid = $oeuvre->getOeuvreById((int)$data['id'], $db);
            $_SESSION['oeuvre_typevente']= $oeuvreid['type_vente'];
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode(['Error' => "ID incorrect"]);
        }
    }

    public function verifierEnchere(Database $db){
        session_start();
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $result = $oeuvre->verifyEnchere($db);
        if($result === 401){
            http_response_code(401);
            echo json_encode(['Error' => "Veuillez renseigner votre adresse de livraison sur la page d'édition de profil avant d'enchérir sur une oeuvre"]);
        }
        else{
            http_response_code(200);
            echo json_encode(['Success' => "Si vous remportez l'enchère votre commande sera livré à l'adresse suivante : " . $result["adresse"], 'prix' => number_format($result["prixCourant"], 2, '.', '')]);
        }
    }

    public function encherir(Database $db){
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        session_start();
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $result = $oeuvre->enchere($db, $data["prix"]);
        if($result["statut"] === 401){
            http_response_code(401);
            echo json_encode(['Error' => "Le prix ne doit pas être inférieur à " . $result["prixCourant"] . " €", 'prix' => number_format($result["prixCourant"], 2, '.', '')]);
        }
        else{
            http_response_code(200);
            echo json_encode(["payment" => $result["url"]]);
        }
    }
  
}

