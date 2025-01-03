<?php
require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/categorie.php');
require_once('Model/Utils.php');
require_once('Model/Vente.php');

Class VenteController extends Controller{//Controlleur accueil
    
    public function vente(Database $db) {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $categorie = new Categorie();
        $result = $categorie->getAllCategorie($db);
        $this->render('vente', ["result" => $result, "connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role]);   
    }

    public function createvente(Database $db){
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if(isset($data["titre"]) && isset($data["type"]) && isset($data["prix"]) && isset($data["nbJours"]) && isset($data["auteurs"]) && isset($data["description"]) && isset($data["categorie"]) && isset($data["image1"]) && isset($data["image2"]) && isset($data["image3"])){
            $vente = new Vente($data["titre"], $data["auteurs"], $data["categorie"], $data["type"], $data["prix"], $data["nbJours"], $data["description"], $data["image1"], $data["image2"], $data["image3"]);
            $result = $vente->VerifyAndSaveProduct($db);
            if($result === 200){
                http_response_code($result);
                echo json_encode(['Success' => "Votre demande est bien pris en compte, votre demande est mise en attente"]);
            }
            else{
                http_response_code(400);
                echo json_encode(['Error' => $result]);
            }
        }
        else{
            http_response_code(400);
            echo json_encode(['Error' => "Erreur"]);
        }
    }

    public function listeVente(Database $db)
    { 
            session_start();
            $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null,null,null);
            $oeuvres = $oeuvre->getAllOeuvre($db);
            $categorie = new Categorie();
            $categories = $categorie->getAllCategorie($db);
            $utils = new Utils();
            $prices = $utils->getMaxAndMinPriceFromMySQL($oeuvres);
            $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
            $this->render('listeVente', ["connectUser" =>  isset($_SESSION["usersessionID"]), "oeuvres" => $oeuvres, "userRole" => $role, "categories" => $categories, 'prices' => $prices]);
    }
    
    public function signalerOeuvre(Database $db)
    {
        // Récupération des données POST (JSON)
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);

        if (isset($data['oeuvre_id']) && isset($data['raison']) && trim($data['raison']) !== '') {
            $oeuvreId = (int)$data['oeuvre_id'];
            $raison = strip_tags($data['raison']);
            require_once('Model/mailSender.php');
            $mailSender = new MailSender();

            // Service destinataire
            $to = "service@galeris.com";  
            $subject = "[Signalement Œuvre #$oeuvreId]";
            $message = "Un utilisateur a signalé l'œuvre #$oeuvreId pour la raison suivante :<br><b>$raison</b>";
            // L'expéditeur peut être un no-reply ou l'email du user
            $from = "no-reply@galeris.com";

            $sent = $mailSender->sendMail($to, $subject, $message, $from);

            if ($sent) {
                // (Optionnel) Enregistrer le signalement en BDD
                // $conn = $db->connect();
                // $sql = "INSERT INTO signalements (id_oeuvre, raison, date_signalement, id_utilisateur) VALUES (?, ?, NOW(), ?)";
                // $stmt = $conn->prepare($sql);
                // $userId = $_SESSION["usersessionID"] ?? null; // si besoin
                // $stmt->bind_param("isi", $oeuvreId, $raison, $userId);
                // $stmt->execute();
                // $stmt->close();
                // $conn->close();

                http_response_code(200);
                echo json_encode(['Success' => 'Signalement envoyé avec succès.']);
            } else {
                http_response_code(500);
                echo json_encode(['Error' => "Impossible d'envoyer l'email de signalement."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['Error' => "Données invalides pour le signalement (oeuvre_id, raison)."]);
        }
    }
}