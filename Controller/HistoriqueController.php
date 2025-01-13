<?php
require_once('Model/historique.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class HistoriqueController extends Controller{
    
    public function historique(Database $db) {
        session_start();

        if (!isset($_SESSION["usersessionID"])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit;
        }

        $historique = new Historique();
        $historiqueResult = $historique->getAllHistorique($db);
        $achat = new Historique();
        $achatResult = $achat->getAllAchat($db);
        $role = isset($_SESSION["usersessionRole"]) && $_SESSION["usersessionRole"] === "Admin";
        $this->render('historique', ["connectUser" => isset($_SESSION["usersessionID"]), "userRole" => $role, "historique" => $historiqueResult, "achat" => $achatResult]);

    }

    public function saveidhistorique(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }

        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['id'])) {
            $_SESSION['oeuvre_id'] = (int)$data['id'];
            $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
            $oeuvreid = $oeuvre->getOeuvreById((int)$data['id'], $db);
            $_SESSION['oeuvre_typevente']= $oeuvreid['type_vente'];
            http_response_code(200);
            echo json_encode(['estVendu' => $oeuvreid["est_vendu"], 'datefin' => $oeuvreid["Date_fin"]]);
        } else {
            http_response_code(400);
            echo json_encode(['Error' => "ID incorrect"]);
        }
    }
        
    }
