<?php
require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/news.php');
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

        $this->render('news', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role]);
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
                echo json_encode(['Success' => "Actualité ajouté"]);
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
                echo json_encode(['Error'=> "Une image obligatoire"]);
            }
            else if($result === 404){
                http_response_code(404);
                echo json_encode(['Error'=> "Type de fichier autorisé : image"]);
            }
            else if($result === 405){
                http_response_code(405);
                echo json_encode(['Error'=> "Fichier trop lourd, 1 MB maximum"]);
            }
        }
        else{
            http_response_code(400);
            echo json_encode(['Error' => "Actualité non ajouté"]);
        }
    }

    public function listeNews(Database $db) {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        
        $news = new news(null,null,null,null,null);
        $news = $news->getNews($db);

        $this->render('listenews', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "listenews" => $news]);
        
    }

    public function saveidnews()
    {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['id'])) {
            session_start();

            if (!isset($_SESSION['usersessionID'])) {
                header('Location: ./connexion');
                exit();
            }

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

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: ./connexion');
            exit();
        }
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

        // Transmettre les données à la vue
        $this->render('newspage', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role,'news' => $newsByID]);
        
    }
}
