<?php
require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/news.php');
require_once('Model/exposition.php');
require_once('Model/Oeuvre.php');
require_once('Model/user.php');
class NewsController extends Controller
{ //Controlleur accueil

    public function news(Database $db)
    { 
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;

        if (!$role) {
            header('Location: ./connexion');
            exit();
        }

        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres = $oeuvre->getAllOeuvre($db);
        $expose = new Exposition(null, null, null, null, null, null, null);
        $exposes = $expose->getExposes($db);
        $user = new User(null, null, null, null, null, null, null, null, null, null);
        $users = $user->getAllUsers($db);

        $this->render('news', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "oeuvres" => $oeuvres, "exposes" => $exposes, "users" => $users]);
    }

    public function createNews(Database $db){
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }

        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if(isset($data['titre']) && $data['description']){
            $news=new News($data['titre'],$data['description'], $data['image1'], $data['image2'], $data['image3']);
            $result = $news->VerifyAndSaveNews($db);
            if($result===200){
                http_response_code(200);
                echo json_encode(['Success' => "Votre actualité a bien été ajoutée."]);
            }
            else if($result===401){
                http_response_code(401);
                echo json_encode(['Error' => "Le titre est obligatoire et doit contenir moins de 50 caractères."]);
            }
            else if($result === 402){
                http_response_code(402);
                echo json_encode(['Error'=> "La description est obligatoire et doit contenir plus de 50 caractères."]);
            }
            else if($result === 403){
                http_response_code(403);
                echo json_encode(['Error'=> "Votre actualité doit contenir au moin une image."]);
            }
            else if($result === 404){
                http_response_code(404);
                echo json_encode(['Error'=> "Les seuls type de fichier autorisé sont les images (JPG, PNG ...)."]);
            }
            else if($result === 405){
                http_response_code(405);
                echo json_encode(['Error'=> "Vos image sont trop lourd, uniquement 2 MB autorisées."]);
            }
        }
        else{
            http_response_code(400);
            echo json_encode(['Error' => "Actualité non ajoutée"]);
        }
    }

    public function listeNews(Database $db) {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        
        $news = new news(null,null,null,null,null);
        $news = $news->getNews($db);

        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres = $oeuvre->getAllOeuvre($db);
        $expose = new Exposition(null, null, null, null, null, null, null);
        $exposes = $expose->getExposes($db);
        $user = new User(null, null, null, null, null, null, null, null, null, null);
        $users = $user->getAllUsers($db);

        $this->render('listenews', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "listenews" => $news, "oeuvres" => $oeuvres, "exposes" => $exposes, "users" => $users]);
        
    }

    public function saveidnews()
    {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['id'])) {
            session_start();
            $_SESSION['news_id'] = (int)$data['id'];
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode(['Error' => "ID incorrect"]);
        }
    }

    public function newsByID(Database $db)
    { 
        // Récupérer l'œuvre depuis le modèle
        $news = new News(null,null,null,null,null);
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $id =  $_SESSION['news_id'];
        
        $newsByID = $news->getNewsByID($id, $db);


        // Vérifier si l'œuvre existe
        if (!$newsByID) {
            http_response_code(404);
            echo "L'œuvre demandée est introuvable.";
            //echo "<script>alert('Oeuvre n\'existe pas');</script>"; A tester si ça fonctionne
            header('Location: ./');
            exit();
        }

        $expose = new Exposition(null,null,null,null,null,null,null);
        $oeuvre = new Oeuvre($Titre = null, $Description = null, $eco_responsable = null, $Date_debut = null, $Date_fin = null, $Prix = null, $type_vente = null, $est_vendu = null, $auteur = null, $id_utilisateur = null, $id_categorie = null, $status = null, $nomvendeur = null, $prenomvendeur = null, $chemin_image = null, $prix_actuel = null, $id_offreur = null);
        $oeuvres_list = $oeuvre->getAllOeuvre($db);
        $exposes_list = $expose->getExposes($db);
        $user = new User(null,null,null,null,null,null,null,null,null,null);
        $users = $user->getAllUsers($db);

        // Transmettre les données à la vue
        $this->render('newspage', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role,'news' => $newsByID, "exposes_barre" => $exposes_list, "users" => $users, "oeuvres" => $oeuvres_list]);
        
    }
}
