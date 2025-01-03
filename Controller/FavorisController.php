<?php
require_once __DIR__ . '/../Model/Favoris.php';  // 引入刚才写的Model
require_once __DIR__ . '/../Database/Database.php';

class FavorisController {
    /**
     * 原有方法，访问 /favoris 时展示favoris页面
     */
    public function controller() {
        $viewPath = __DIR__ . '/../Vue/html/favoris.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(404);
            echo "La page Galeris est introuvable.";
        }
    }

    /**
     * 处理Ajax - 添加收藏
     */
    public function addFavoris(Database $db)
    {
        session_start();
        // 判断用户是否登录
        if (!isset($_SESSION['usersessionID'])) {
            http_response_code(401);
            echo json_encode(["error"=>"Veuillez vous connecter."]);
            return;
        }

        // 接收并解析JSON
        $postData = json_decode(file_get_contents('php://input'), true);
        if (!isset($postData["id_oeuvre"])) {
            http_response_code(400);
            echo json_encode(["error"=>"Paramètre 'id_oeuvre' manquant."]);
            return;
        }
        $idOeuvre = (int) $postData["id_oeuvre"];
        $idUser = (int) $_SESSION['usersessionID'];

        // 调用Model
        $favorisModel = new Favoris();
        $favorisModel->addFavoris($idUser, $idOeuvre, $db);

        // 返回结果
        http_response_code(200);
        echo json_encode(["message"=>"Œuvre ajoutée aux favoris !"]);
    }

    /**
     * 处理Ajax - 移除收藏
     */
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
