<?php
require_once('Model/achat.php');
require_once('Database/Database.php');
require_once('Controller.php');

class AchatController extends Controller
{
    // Méthode pour afficher les détails d'une œuvre
    public function achat(Database $db)
    {
        // Récupérer l'œuvre depuis le modèle
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null);
        session_start();
        $id =  $_SESSION['oeuvre_id'];
        $oeuvreid = $oeuvre->getOeuvreById($id, $db);

        // Vérifier si l'œuvre existe
        if (!$oeuvre) {
            http_response_code(404);
            echo "L'œuvre demandée est introuvable.";
            //echo "<script>alert('Oeuvre n\'existe pas');</script>"; A tester si ça fonctionne
            header('Location: /Galeris-APPG1E/accueil');
            exit();
        }

        // Transmettre les données à la vue
        $this->render('achat', ['oeuvre' => $oeuvreid]);
    }

    public function saveid(Database $db)
    {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['id'])) {
            session_start();
            $_SESSION['oeuvre_id'] = (int)$data['id'];
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode(['Error' => "ID incorrect"]);
        }
    }


  
    public function enchere(Database $db) {
        // Instanciation du modèle
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null);
        session_start();
        // Récupérer l'ID de l'œuvre depuis la session
        
        $id_oeuvre = $_SESSION['oeuvre_id'];
    
        // Récupérer les données de l'œuvre
        $oeuvreData = $oeuvre->getOeuvreById($id_oeuvre,$db);
    
        // Vérifier si l'œuvre existe
        if (!$oeuvreData) {
            http_response_code(404);
            echo "L'œuvre demandée est introuvable.";
            header('Location: /Galeris-APPG1E/accueil');
            exit();
        }
    
        // Récupérer les images associées à l'œuvre
        $oeuvreImages = $oeuvre->getImagesByOeuvreId($id_oeuvre,$db);
    
        // Passer les données à la vue
        $this->render('enchere', [
            'oeuvre' => $oeuvreData,
            'images' => $oeuvreImages
        ]);
    }
}    

