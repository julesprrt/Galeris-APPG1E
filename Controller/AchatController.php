<?php
require_once('Model/Oeuvre.php');
require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/panier.php');

class AchatController extends Controller
{
    // Méthode pour afficher les détails d'une œuvre
    public function achat(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }
        // Récupérer l'œuvre depuis le modèle
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = [], $prix_actuel = null, $id_offreur = null, $id_vente = null, $prix = null, $Date_vente = null);
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $id =  $_SESSION['oeuvre_id'];
        $oeuvreid = $oeuvre->getOeuvreById($id, $db);

        $panier = new Panier();
        $panierExist = $panier->existPanier($db);
        $favoris = new Favoris();
        $favorisExist = $favoris->existFavoris($db);
    

        // Vérifier si l'œuvre existe
        if (!$oeuvre) {
            http_response_code(404);
            echo "L'œuvre demandée est introuvable.";
            //echo "<script>alert('Oeuvre n\'existe pas');</script>"; A tester si ça fonctionne
            header('Location: ./');
            exit();
        }

        $oeuvres = $oeuvre->getAllOeuvre($db);
        $expose = new Exposition(null,null,null,null,null,null,null);
        $exposes = $expose->getExposes($db);
        $user = new User(null,null,null,null,null,null,null,null,null,null);
        $users = $user->getAllUsers($db);

        $user = $_SESSION["usersessionID"] === $oeuvreid["id_utilisateur"];

        $type =  $_SESSION['oeuvre_typevente'];
        if ($type === "Vente") {
            $this->render('achat', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, 'oeuvre' => $oeuvreid, "panier" => $panierExist, "favoris" => $favorisExist, "user" => $user, "oeuvres" => $oeuvres, "exposes" => $exposes, "users" => $users]);
        } else {
            $encheres = $oeuvre->getAllEnchere($id, $db);
            $this->render('enchere', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, 'oeuvre' => $oeuvreid, 'encheres' => $encheres, "user" => $user,"favoris" => $favorisExist, "oeuvres" => $oeuvres, "exposes" => $exposes, "users" => $users]);
        }
    }


   

    public function saveid(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }

        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['id'])) {
            $_SESSION['oeuvre_id'] = (int)$data['id'];
            $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null, $id_vente = null, $prix = null, $Date_vente = null);
            $oeuvreid = $oeuvre->getOeuvreById((int)$data['id'], $db);
            $_SESSION['oeuvre_typevente'] = $oeuvreid['type_vente'];
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode(['Error' => "ID incorrect"]);
        }
    }

    public function verifierEnchere(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }

        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null, $id_vente = null, $prix = null, $Date_vente = null);
        $result = $oeuvre->verifyEnchere($db);
        if ($result === 401) {
            http_response_code(401);
            echo json_encode(['Error' => "Veuillez renseigner vos données de livraison sur la page livraison avant d'enchérir sur une oeuvre"]);
        } else {
            http_response_code(200);
            echo json_encode(['Success' => "Si vous remportez l'enchère votre commande sera livré à l'adresse suivante : " . $result["adresse"] . " " . $result["codepostale"] . ", " . $result["ville"] . " " . $result["pays"], 'prix' => number_format($result["prixCourant"], 2, '.', '')]);
        }
    }

    public function encherir(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }

        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null, $id_vente = null, $prix = null, $Date_vente = null);
        $result = $oeuvre->enchere($db, $data["prix"]);

        
        if($result["statut"] === 401){
            http_response_code(401);
            echo json_encode(['Error' => "Le prix ne doit pas être inférieur à " . $result["prixCourant"] . " €", 'prix' => number_format($result["prixCourant"], 2, '.', '')]);
        } else {
            http_response_code(200);
            echo json_encode(["payment" => $result["url"]]);
        }
    }

    public function createEnchere(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }

        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null, $id_vente = null, $prix = null, $Date_vente = null);
        $oeuvre->CreateSaveEnchere($db);
        return;
    }

    public function supprimeroeuvre(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }

        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null, $id_vente = null, $prix = null, $Date_vente = null);
        $oeuvre->supprimerOeuvre($db);
        http_response_code(200);
        echo json_encode(["Success" => "Oeuvre supprimé"]);
    }
}
