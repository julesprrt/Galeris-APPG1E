<?php


class NewsController {
    public function controller() {
        $viewPath = __DIR__ . '/../Vue/html/news.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(404);
            echo "La page News est introuvable.";
        }
    }
}
