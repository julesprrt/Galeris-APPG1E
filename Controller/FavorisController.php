<?php
require_once __DIR__ . '/../Model/Favoris.php'; 
require_once __DIR__ . '/../Database/Database.php';

class FavorisController {
  
    public function controller() {
        $viewPath = __DIR__ . '/../Vue/html/favoris.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(404);
            echo "La page Galeris est introuvable.";
        }
    }

  
    public function addFavoris(Database $db)
    {
        session_start();
      
        if (!isset($_SESSION['usersessionID'])) {
            http_response_code(401);
            echo json_encode(["error"=>"Veuillez vous connecter."]);
            return;
        }

     
        $postData = json_decode(file_get_contents('php://input'), true);
        if (!isset($postData["id_oeuvre"])) {
            http_response_code(400);
            echo json_encode(["error"=>"Paramètre 'id_oeuvre' manquant."]);
            return;
        }
        $idOeuvre = (int) $postData["id_oeuvre"];
        $idUser = (int) $_SESSION['usersessionID'];

        
        $favorisModel = new Favoris();
        $favorisModel->addFavoris($idUser, $idOeuvre, $db);

       
        http_response_code(200);
        echo json_encode(["message"=>"Œuvre ajoutée aux favoris !"]);
    }

   
    public function removeFavoris(Database $db)
    {
        session_start();
        if (!isset($_SESSION['usersessionID'])) {
            http_response_code(401);
            echo json_encode(["error"=>"Veuillez vous connecter."]);
            return;
        }

        $postData = json_decode(file_get_contents('php://input'), true);
        if (!isset($postData["id_oeuvre"])) {
            http_response_code(400);
            echo json_encode(["error"=>"Paramètre 'id_oeuvre' manquant."]);
            return;
        }
        $idOeuvre = (int) $postData["id_oeuvre"];
        $idUser = (int) $_SESSION['usersessionID'];

        $favorisModel = new Favoris();
        $favorisModel->removeFavoris($idUser, $idOeuvre, $db);

        http_response_code(200);
        echo json_encode(["message"=>"Œuvre retirée des favoris !"]);
    }
}
