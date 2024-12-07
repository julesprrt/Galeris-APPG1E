<?php


Class Utils {
    public function __construct() {//Constructeur -> Initialisation des données

    }

    /**
     * *
     * @param mixed $email
     * @return mixed
     * Composition du mail via le filtre proposé par PHP
     */
    public function emailComposition($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
}
