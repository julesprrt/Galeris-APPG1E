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
        
    }
