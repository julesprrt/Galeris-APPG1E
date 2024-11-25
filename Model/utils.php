<?php
require 'vendor/autoload.php';

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

    public function verifyCaptcha($response){
        $secretKey = "6Lf0tIkqAAAAAAATTCwNZELpV0tpppZAjBwAXBoc";
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($response);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        if($responseKeys["success"]) {
            return true;
        } else {
            return false;
        }
    }
    
}
