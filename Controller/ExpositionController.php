<?php
require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/exposition.php');
require_once('Model/oeuvre.php');
require_once('Model/user.php');

class ExpositionController extends Controller{ 
    public function exposition(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }

        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres = $oeuvre->getAllOeuvre($db);
        $expose = new Exposition(null,null,null,null,null,null,null);
        $exposes = $expose->getExposes($db);
        $user = new User(null,null,null,null,null,null,null,null,null,null);
        $users = $user->getAllUsers($db);
        
        $this->render('exposition', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "oeuvres" => $oeuvres, "exposes" => $exposes, "users" => $users]);
    }
    public function createexposition(Database $db){
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }

        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if(isset($data['titre'])&& isset($data['date_debut'])&& isset($data['date_fin'])){
            $exposition=new Exposition($data['titre'],$data['date_debut'],$data['date_fin'],$data['description'], $data['image1'], $data['image2'], $data['image3']);
            $result = $exposition->VerifyAndSaveExposition($db);
            if($result===200){
                http_response_code(200);
                echo json_encode(['Success' => "Votre demande est bien pris en compte, votre demande est mise en attente"]);
            }
            else if($result===401){
                http_response_code(401);
                echo json_encode(['Error' => "Le titre est obligatoire et doit contenir moins de 50 caractères."]);
            }
            else if($result===402){
                http_response_code(402);
                echo json_encode(['Error'=> "La date de début est requise et doit être ultérieure à la date actuelle."]);
            }
            else if($result===403){
                http_response_code(403);
                echo json_encode(['Error'=> "La date de fin est requise."]);
            }
            else if($result === 404){
                http_response_code(404);
                echo json_encode(['Error'=> "La durée maximale est de 14 jours maximum."]);
            }
            else if($result === 405){
                http_response_code(405);
                echo json_encode(['Error'=> "La description est obligatoire et doit contenir plus de 50 caractères."]);
            }
            else if($result === 406){
                http_response_code(406);
                echo json_encode(['Error'=> "Une image obligatoire"]);
            }
            else if($result === 407){
                http_response_code(407);
                echo json_encode(['Error'=> "Type de fichier autorisé : image"]);
            }
            else if($result === 408){
                http_response_code(408);
                echo json_encode(['Error'=> "Fichier trop lourd, 1 MB maximum"]);
            }
        }
        else{
            http_response_code(400);
            echo json_encode(['Error' => "Votre demande d'exposition à bien été pris en compte"]);
        }
    }

    public function saveidexpose(Database $db)
    {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['id'])) {
            session_start();

            if (!isset($_SESSION['usersessionID'])) {
                header('Location: ./connexion');
                exit();
            }

            $_SESSION['expose_id'] = (int)$data['id'];
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode(['Error' => "ID incorrect"]);
        }
    }

    public function listeExpose(Database $db) {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        
        $expose = new Exposition(null,null,null,null,null,null,null);
        $exposes = $expose->getExposes($db);

        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres = $oeuvre->getAllOeuvre($db);
        $exposes_list = $expose->getExposes($db);
        $user = new User(null,null,null,null,null,null,null,null,null,null);
        $users = $user->getAllUsers($db);

        $this->render('expositions', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "exposes" => $exposes, "oeuvres" => $oeuvres, "exposes_barre" => $exposes_list, "users" => $users]);
        
    }

    public function exposeByID(Database $db)
    { 
        // Récupérer l'œuvre depuis le modèle
        $expose = new Exposition(null,null,null,null,null,null,null);
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
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
        $this->render('expose', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role,'expose' => $exposeid, "oeuvres" => $oeuvres, "exposes" => $exposes, "users" => $users]);
        
    }
}