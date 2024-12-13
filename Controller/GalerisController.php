<?php

class GalerisController {
    public function controller() {
        $viewPath = __DIR__ . '/../Vue/html/galeris.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(404);
            echo "La page Galeris est introuvable.";
        }
    }
}
