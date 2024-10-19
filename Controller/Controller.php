<?php

class Controller {
    protected function render($view, $data = []) {
        extract($data);//Recupération des données envoyé
        include "Vue/html/$view.php";//Affichage de la vue 
    }
}
    