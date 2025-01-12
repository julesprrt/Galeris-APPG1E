<?php
require_once('Model/Oeuvre.php');
require_once('Model/exposition.php');
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
class AdminController extends Controller
{ //Controlleur accueil

    public function attenteoeuvre(Database $db)
    { 
        // Récupérer l'œuvre depuis le modèle
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = [], null,null);
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;

        if (!$role) {
            http_response_code(404);
            header('Location: ./');
            exit();
        }
        
        $id =  $_SESSION['oeuvre_id'];
        $oeuvreid = $oeuvre->getOeuvreById($id, $db);


        // Vérifier si l'œuvre existe
        if (!$oeuvreid) {
            http_response_code(404);
            echo "L'œuvre demandée est introuvable.";
            //echo "<script>alert('Oeuvre n\'existe pas');</script>"; A tester si ça fonctionne
            header('Location: ./');
            exit();
        }

        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres = $oeuvre->getAllOeuvre($db);
        $expose = new Exposition(null,null,null,null,null,null,null);
        $exposes = $expose->getExposes($db);
        $user = new User(null,null,null,null,null,null,null,null,null,null);
        $users = $user->getAllUsers($db);

        // Transmettre les données à la vue
        $this->render('oeuvreattente', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role,'oeuvre' => $oeuvreid, "oeuvres" => $oeuvres, "exposes" => $exposes, "users" => $users]);
        
    }

    public function attenteexpose(Database $db)
    { 
        // Récupérer l'œuvre depuis le modèle
        $expose = new Exposition(null,null,null,null,null,null,null);
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;

        if (!$role) {
            http_response_code(404);
            header('Location: ./');
            exit();
        }

        $id =  $_SESSION['expose_id'];
        
        $exposeid = $expose->getExposeById($id, $db);


        // Vérifier si l'œuvre existe
        if (!$exposeid) {
            http_response_code(404);
            echo "L'œuvre demandée est introuvable.";
            //echo "<script>alert('Oeuvre n\'existe pas');</script>"; A tester si ça fonctionne
            header('Location: ./');
            exit();
        }

        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres = $oeuvre->getAllOeuvre($db);
        $expose = new Exposition(null,null,null,null,null,null,null);
        $exposes = $expose->getExposes($db);
        $user = new User(null,null,null,null,null,null,null,null,null,null);
        $users = $user->getAllUsers($db);

        // Transmettre les données à la vue
        $this->render('exposeattente', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role,'expose' => $exposeid, "oeuvres" => $oeuvres, "exposes" => $exposes, "users" => $users]);
        
    }

    public function acceptoeuvre(Database $db){
        session_start();

        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;

        if (!$role) {
            http_response_code(404);
            header('Location: ./');
            exit();
        }

        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['id']) && isset($data['accept'])) {
            $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = [],null,null);
            $oeuvre->updateStatut($db,$data['accept'],$data['id']);
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode(['Error' => "ID incorrect"]);
        }
    }

    public function acceptexpose(Database $db){
        session_start();

        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        
        if (!$role) {
            http_response_code(404);
            header('Location: ./');
            exit();
        }

        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['id']) && isset($data['accept'])) {
            $expose = new Exposition(null,null,null,null,null,null,null);
            $expose->updateStatut($db,$data['accept'],$data['id']);
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode(['Error' => "ID incorrect"]);
        }
    }
    public function supprimerOeuvre(Database $db)
    {
        session_start();

        // Vérifier rôle admin
        if (!isset($_SESSION["usersessionRole"]) || $_SESSION["usersessionRole"] !== "Admin") {
            http_response_code(403);
            echo json_encode(["Error" => "Accès refusé : vous n'êtes pas admin."]);
            return;
        }

        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);

        if (!isset($data['oeuvre_id'])) {
            http_response_code(400);
            echo json_encode(["Error" => "Paramètre 'oeuvre_id' manquant."]);
            return;
        }

        require_once('Model/Oeuvre.php');

        $idOeuvre = (int)$data['oeuvre_id'];
        
        $oeuvreModel = new Oeuvre(null, null, null, null, null, null, null, null, null, null, null, null, null, null, [], null, null);
        $result = $oeuvreModel->supprimerOeuvreParId($db, $idOeuvre);

        if ($result === 200) {
            http_response_code(200);
            echo json_encode(["Success" => "Œuvre supprimée avec succès."]);
        } else {
            http_response_code(500);
            echo json_encode(["Error" => "Erreur lors de la suppression de l'œuvre."]);
        }
    }
}
