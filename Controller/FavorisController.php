<?php


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
}
