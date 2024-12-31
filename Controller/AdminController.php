<?php
require_once('Model/oeuvre.php');
require_once('Model/exposition.php');
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
        $id =  $_SESSION['oeuvre_id'];
        $oeuvreid = $oeuvre->getOeuvreById($id, $db);


        // Vérifier si l'œuvre existe
        if (!$oeuvreid) {
            http_response_code(404);
            echo "L'œuvre demandée est introuvable.";
            //echo "<script>alert('Oeuvre n\'existe pas');</script>"; A tester si ça fonctionne
            header('Location: /Galeris-APPG1E/');
            exit();
        }

        // Transmettre les données à la vue
        $this->render('oeuvreattente', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role,'oeuvre' => $oeuvreid]);
        
    }

    public function attenteexpose(Database $db)
    { 
        // Récupérer l'œuvre depuis le modèle
        $expose = new Exposition(null,null,null,null,null,null,null);
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $id =  $_SESSION['expose_id'];
        
        $exposeid = $expose->getExposeById($id, $db);


        // Vérifier si l'œuvre existe
        if (!$exposeid) {
            http_response_code(404);
            echo "L'œuvre demandée est introuvable.";
            //echo "<script>alert('Oeuvre n\'existe pas');</script>"; A tester si ça fonctionne
            header('Location: /Galeris-APPG1E/');
            exit();
        }

        // Transmettre les données à la vue
        $this->render('exposeattente', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role,'expose' => $exposeid]);
        
    }

    public function acceptoeuvre(Database $db){
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
}
