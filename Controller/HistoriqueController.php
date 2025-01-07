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
        $result = $historique->getAllHistorique($db);
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $this->render('historique', ["connectUser" => isset($_SESSION["usersessionID"]), "userRole" => $role, "historique" => $result]);
    }
        
    }
